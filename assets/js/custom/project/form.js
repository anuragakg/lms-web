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
		fetchVertical(edit_id)
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
									return row.status_text;
									
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
					setTimeout(function() { window.location = 'new-product-vertical.php'}, 500);
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
			$('#title').val(response.data.title)
			//fillDistrict(response.data);
		}
	});
}
deleteVertical=(id=0)=>{
	if(confirm('Are you sure to delete this?')){
		var url = conf.deleteProjectVerticalById.url(id);
		var method = conf.deleteProjectVerticalById.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				TRIFED.showMessage('success', 'Product Vertical deleted Successfully');
				setTimeout(function() { window.location = 'new-product-vertical.php'}, 500);
			}
		});	
	}
	
}