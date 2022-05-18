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
	
	if(edit_id!= undefined)
	{
		fetchFormData(edit_id)
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
					title: 'Product Form List',
					exportOptions: {
						columns: [0, 1, 2,3,4,5,6]
					}
				},
				

				
			  ],
			  
            "ajax":{
                     "url": conf.getProjectFormList.url,
                     "dataType": "json",
                     "type": "GET",
                     "headers": {
		                "Authorization": 'Bearer ' + auth.token
		            },
		            "data": function(d, settings){
				         var api = new $.fn.dataTable.Api(settings);
				         
				         d.page = api.page()+1;
				         
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
							"orderable": false,
							"render": function(data, type, row) {
									return row.title;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.type_text;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.added_by.name;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.created_at;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.updated_at;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.approved_by;
							}
							 
						},
						{
							"orderable": false,
							"render": function(data, type, row) {
									var html='';
									if(row.status==0){
										text_class='text-warning';
									}
									if(row.status==1){
										text_class='text-success';
									}
									if(row.status==2){
										text_class='text-danger';
									}
									html += '<p class="'+text_class+'">'+row.status_text+'</p><br>';
									if(auth.role ==2 || auth.role ==3 ||auth.role ==4)
									{
										if(row.current_usertype_status.status == 0 && row.status==0){
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
								html +='<a href="new-form.php?id='+row.id+'" class="ti-pencil"></a>  | ';
								html +='<a href="javascript:void(0)" onclick="deleteForm('+row.id+')" class="ti-trash"></a> ';
								return html;
									
							}
						},

						
		               
		                
		            ]

      });




	$("#formID").submit(function(e) {
	    e.preventDefault();
	}).validate({
	    rules: {
            title:{
            	'required':true
            },
            
        },
        messages: {
            title:{
            	'required':'Please enter title',
            }
		},
	    submitHandler: function(form) { 
	        
			//const data=$('#formID').serializeArray();
			
    		
			var url = conf.addProjectForm.url;
			var method = conf.addProjectForm.method;
			
			var form = $('#formID')[0];   
    		var data = new FormData(form);	
    		if (edit_id != undefined && edit_id != '') 
			{
				data.append('form_id', edit_id );
			}
			TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					
					TRIFED.showMessage('success', 'Product Form Successfully submitted and sent for approval');
					setTimeout(function() { window.location = 'new-form-list.php'}, 1500);
				} else {
					TRIFED.showError('error', response.message);
				}
			});
	        return false;  //This doesn't prevent the form from submitting.
	    }
	});    
});


fetchFormData = (id = 0) => {
	var url = conf.getProjectForm.url(id);
	var method = conf.getProjectForm.method;
	var data = {};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			$('#title').val(response.data.title);
			$('#type').val(response.data.type);
			response.data.controls.forEach((row)=>{
				element='contorls[element]['+row.control+'][input]';
				$('input[name="'+element+'"]').prop('checked',true);
				element_is_required='contorls[element]['+row.control+'][is_required]';
				if(row.is_required==1){
					checked=true;
				}else{
					checked=false;
				}
				$('input[name="'+element_is_required+'"]').prop('checked',checked);
			});
		}
	});
}
deleteForm=(id=0)=>{
	if(confirm('Are you sure to delete this?')){
		var url = conf.deleteProject.url(id);
		var method = conf.deleteProject.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				TRIFED.showMessage('success', 'Product Form deleted Successfully');
				setTimeout(function() { window.location = 'new-form-list.php'}, 1500);
			}
		});	
	}
	
}
updateStatus=(id,status)=>{
	if(status==1){
		status_text='approve';
	}else{
		status_text='reject';
	}
	if(confirm(`Are you sure to ${status_text} this?`)){
		var url = conf.updateProjectFormStatus.url;
		var method = conf.updateProjectFormStatus.method;
		var data = {
			id,
			status
		};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				TRIFED.showMessage('success', 'Product Form Status Updated Successfully');
				setTimeout(function() { window.location = 'new-form-list.php'}, 1500);
			}
		});	
	}
}
showHistory=(id)=>{
	var url = conf.getProjectFormStatusHistory.url;
		var method = conf.getProjectFormStatusHistory.method;
		var data = {
			id
		};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				var html='';
				response.data.status.forEach((row)=>{
					html +='<tr>';
						html +='<td>'+row.user_type+'</td>';
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