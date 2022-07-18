var project_vertical_status = TRIFED.checkPermissions("project_vertical_status");

function getUrlVars() {
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for (var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	return vars;
}
const edit_id = TRIFED.getUrlParameters().id;
$(function () {
	var row=[];
	fetchRoleList();
	if(edit_id!= undefined)
	{
		fetchVertical(edit_id)
	}else{
		add_approver(row);
	}
 	var auth = TRIFED.getLocalStorageItem();
 	let listElement='#list';
	var oTable =$(listElement).DataTable({
          "processing": true,
          "serverSide": true,
          "order": [[0, "DESC"]],
		  "dom": 'lBfrtip',
		   oLanguage: {
				sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
			},
				
			"buttons": [

				{
					extend: 'excel',
					text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
					titleAttr: 'EXCEL',
					title: 'Product Vertical List',
					exportOptions: {
						columns: [0, 1, 2,3,4,5,6]
					}
				},
				

				
			  ],
			  
            "ajax":{
                     "url": conf.getProjectVertical.url,
                     "dataType": "json",
                     "type": "GET",
                     "headers": {
		                "Authorization": 'Bearer ' + auth.token
		            },
		            "data": function(d, settings){
				         var api = new $.fn.dataTable.Api(settings);
				         
				         d.page = api.page()+1;
				         d.status = $('#status').val();
				         
				      },
		            "dataSrc": function(json) {
		            		json.draw = json.data.draw;
								json.recordsTotal = json.data.recordsTotal;
								json.recordsFiltered = json.data.recordsFiltered;			
	       					return json.data.data;
	       						
	    				}
                   },
		            "columns": [
		                { 
		                	"render": function(data, type, full, meta) {
						        var PageInfo = $(listElement).DataTable().page.info();
						        return PageInfo.start+1+meta.row;
						        
						    }
						},
						{ 
							//"orderable": false,
							"render": function(data, type, row) {
									return row.title;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.added_by;
							}
							 
						},
						{ 
							//"orderable": false,
							"render": function(data, type, row) {
									return row.created_at;
							}
							 
						},
						
						{ 
							//"orderable": false,
							"render": function(data, type, row) {
									return row.approve_status_text;
							}
							 
						},
						{
							"orderable": false,
							"render": function(data, type, row) {
									var html='';
									
									if(row.status==0){
										text_class='text-warning';
										html += '<p class="'+text_class+'">'+row.pending_status_text+'</p><br>';
									}
									if(row.status==1){
										text_class='text-success';
										html += '<p class="'+text_class+'">Approved</p><br>';
									}
									if(row.status==2){
										text_class='text-danger';
										html += '<p class="'+text_class+'">'+row.rejected_status_text+'</p><br>';
									}
									if(row.can_approve == 1 && project_vertical_status)
									{
										if(row.status!=1 && row.status!=2){
											html += '<a class="btn btn-success" href="javascript:void(0)" onclick="updateStatus('+row.id+',1)">Approve</a> | ';
											html += '<a class="btn btn-danger" href="javascript:void(0)" onclick="updateStatus('+row.id+',2)">Reject</a>';				
										}
									}
									html+='<a title="View History" href="javascript:void(0)" onclick="showHistory('+row.id+')"><i class="fa fa-line-chart" aria-hidden="true"></i></a>';
									return html;
									
							}
						},
						{
							"orderable": false,
							"render": function(data, type, row) {
								var html='';
								html +='<a href="new-product-vertical.php?id='+row.id+'" class="ti-pencil"></a>  | ';
								html +='<a href="javascript:void(0)" onclick="deleteVertical('+row.id+')" class="ti-trash"></a> ';
								return html;
									
							}
						},

						
		               
		                
		            ]

      });

	$('#status').on('change',function () {
		oTable.ajax.reload();
	});


	$("#formID").submit(function(e) {
	    e.preventDefault();
	}).validate({
	    rules: {
            title:{
            	'required':true
            }
            
        },
        messages: {
            title:{
            	'required':'Please enter title',
            }
		},
	    submitHandler: function(form) { 
	        
			//const data=$('#formID').serializeArray();
			
    		
			var url = conf.addProjectVertical.url;
			var method = conf.addProjectVertical.method;
			
			var form = $('#formID')[0];   
    		var data = new FormData(form);	
    		if (edit_id != undefined && edit_id != '') 
			{
				data.append('form_id', edit_id );
			}
			TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					
					TRIFED.showMessage('success', 'Vertical name Successfully created and sent for approval');
					setTimeout(function() { window.location = 'new-product-vertical.php'}, 3000);
				} else {
					TRIFED.showError('error', response.message);
				}
			});
	        return false;  //This doesn't prevent the form from submitting.
	    }
	});    
});


fetchVertical = (id = 0) => {
	var url = conf.getProjectVerticalById.url(id);
	var method = conf.getProjectVerticalById.method;
	var data = {};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			$('#title').val(response.data.title);
			response.data.getStatus.forEach((row)=>{
				add_approver(row);
			});
			//fillDistrict(response.data);
		}
	});
}
deleteVertical=(id=0)=>{
	if(confirm('Are you sure you wish to delete vertical name?')){
		var url = conf.deleteProjectVerticalById.url(id);
		var method = conf.deleteProjectVerticalById.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				TRIFED.showMessage('success', 'Product Vertical deleted Successfully');
				setTimeout(function() { window.location = 'new-product-vertical.php'}, 3000);
			}
		});	
	}
	
}
updateStatus=(id,status)=>{
	if(status==1){
		status_text='Approve';
	}else{
		status_text='Reject';
	}
	var reason='';
	if(confirm(`Are you sure you wish to ${status_text} vertical name?`)){
		if(status==2){
			reason=prompt(`Please enter the reason for ${status_text}`);
			
		}
		
		var url = conf.updateProjectVerticalStatus.url;
		var method = conf.updateProjectVerticalStatus.method;
		var data = {
			id,
			status,
			reason
		};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				TRIFED.showMessage('success', 'Product Vertical Status Updated Successfully');
				setTimeout(function() { window.location = 'new-product-vertical.php'}, 3000);
			}
		});	
	}
}
showHistory=(id)=>{
	var url = conf.getProjectVerticalStatusHistory.url;
		var method = conf.getProjectVerticalStatusHistory.method;
		var data = {
			id
		};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				var html='';
				response.data.status.forEach((row)=>{
					html +='<tr>';
						html +='<td>'+row.role_name+'</td>';
						if(row.status==1){
							var text_class='text-success';	
						}
						if(row.status==2){
							var text_class='text-danger';	
						}
						if(row.status==0){
							var text_class='text-warning';	
						}
						html +='<td class="'+text_class+'">'+row.status_text+'</td>';
						html +='<td>'+row.approver_name+'</td>';
						html +='<td>'+row.approver_email+'</td>';
						html +='<td>'+row.approver_remarks+'</td>';
						
						if(row.status!=0){
							html +='<td>'+row.updated_at+'</td>';
						}else{
							html +='<td>-</td>';
						}
					html +='</tr>';
				});

				$('#status_data').html(html);			
				$('#myModal').modal('show');			
			}
		});
	
}