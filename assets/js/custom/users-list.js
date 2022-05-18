$(function () {
	

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
					title: 'Users List',
					exportOptions: {
						columns: [0, 1, 2]
					}
				},
				

				
			  ],
			  
            "ajax":{
                     "url": conf.users_list.url,
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
									return row.name;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.email;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.role;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									var html='';
									html +='<a href="add-users.php?id='+row.id+'" class="ti-pencil"></a> ';
									
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