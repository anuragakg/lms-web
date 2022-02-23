const edit_id = TRIFED.getUrlParameters().id;
$(function () {
	//fetchVertical();
	//fetchCategory();
	fetchProductForm();
	
	if(edit_id!= undefined)
	{
		fetchMiniCategory(edit_id)
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
					title: 'Product Mini Category List',
					exportOptions: {
						columns: [0, 1, 2,3,4,5,6]
					}
				},
				

				
			  ],
			  
            "ajax":{
                     "url": conf.getProjectMiniCategoryList.url,
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
									return row.product_form_data.title;
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
								html +='<a href="new-product-minicategory.php?id='+row.id+'" class="ti-pencil"></a>  | ';
								html +='<a href="javascript:void(0)" onclick="deleteCategory('+row.id+')" class="ti-trash"></a> ';
								return html;
									
							}
						},

						
		               
		                
		            ]

      });




	$("#formID").submit(function(e) {
	    e.preventDefault();
	}).validate({
	    rules: {
            
            
        },
        messages: {
            
		},
	    submitHandler: function(form) { 
	        
			//const data=$('#formID').serializeArray();
			
    		
			var url = conf.addProjectMiniCategory.url;
			var method = conf.addProjectMiniCategory.method;
			
			var form = $('#formID')[0];   
    		var data = new FormData(form);	
    		if (edit_id != undefined && edit_id != '') 
			{
				data.append('form_id', edit_id );
			}
			TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					
					TRIFED.showMessage('success', 'Product Category Successfully submitted and sent for approval');
					setTimeout(function() { window.location = 'product-mini-category-list.php'}, 500);
				} else {
					TRIFED.showError('error', response.message);
				}
			});
	        return false;  //This doesn't prevent the form from submitting.
	    }
	});    
});

fetchSubCategory=(id=0)=>{
	
	var url = conf.getProjectSubCategory.url(id);
	var method = conf.getProjectSubCategory.method;
	var data = {};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			$('#sub_category').val(response.data.sub_category);
			$('#category_id').val(response.data.category_id);
			$('#product_vertical_id').val(response.data.product_vertical_id);
			$('#product_form_mini_id').val(response.data.product_form_mini_id);
			$('#product_form_lead_id').val(response.data.product_form_lead_id);
		}
	});	

	
}
fetchMiniCategory=(id)=>{
	var url = conf.getProjectMiniCategory.url(id);
	var method = conf.getProjectMiniCategory.method;
	var data = {};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			$('#product_form_mini_id').val(response.data.product_form_mini_id).trigger('change');
			$('#title').val(response.data.title);
			$('#first_name').val(response.data.first_name);
			$('#last_name').val(response.data.last_name);
			$('#email').val(response.data.email);
			$('#phone').val(response.data.phone);
			$('#fax').val(response.data.fax);
			$('#whatsapp').val(response.data.whatsapp);
			$('#website').val(response.data.website);
			$('#speaks').val(response.data.speaks);
			$('#industry').val(response.data.industry);
			$('#notes').val(response.data.notes);
			$('#company_name').val(response.data.company_name);
			$('#process_status').val(response.data.process_status);
			$('#rating').val(response.data.rating);
			$('#lead_temp').val(response.data.lead_temp);
			$('#assigned').val(response.data.assigned);
			$('#status_field').val(response.data.status_field);
			$('#source').val(response.data.source);

		}
	});
}
fetchCategory = () => {
	var url = conf.approved_product_categories.url;
	var method = conf.approved_product_categories.method;
	var data = {};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			html='<option value="">Select Category</option>';
			response.data.forEach((row)=>{
				html +='<option value="'+row.id+'">'+row.title+'</option>'
			});
			$('#category_id').html(html);
		}
	});
}
fetchProductForm = () => {
	var url = conf.approved_products_form.url;
	var method = conf.approved_products_form.method;
	var data = {};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			mini_html='<option value="">Select Product Mini Category form</option>';
			response.data.mini.forEach((row)=>{
				mini_html +='<option value="'+row.id+'">'+row.title+'</option>'
			});
			$('#product_form_mini_id').html(mini_html);
			// lead_html='<option value="">Select Product Lead form</option>';
			// response.data.lead.forEach((row)=>{
			// 	lead_html +='<option value="'+row.id+'">'+row.title+'</option>'
			// });
			// $('#product_form_lead_id').html(lead_html);
		}
	});
}
fetchVertical = () => {
	var url = conf.approved_product_vertical.url;
	var method = conf.approved_product_vertical.method;
	var data = {};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			html='<option value="">Select Product Vertical</option>';
			response.data.forEach((row)=>{
				html +='<option value="'+row.id+'">'+row.title+'</option>'
			});
			$('#product_vertical_id').html(html);
		}
	});
}
getFormControls=()=>{
	let product_form_mini_id=$('#product_form_mini_id').val();
	if(product_form_mini_id!='')
	{
		var url = conf.getFormControls.url(product_form_mini_id);
		var method = conf.getFormControls.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				response.data.controls.forEach((row)=>{
					console.log(row.control + '-'+row.is_required)
					$('.'+row.control).show();
					if(row.is_required==1){
						$('#'+row.control).prop('required',true);	
						$('#'+row.control+'_required').html('*');	
					}
					
				})
			}
		});	
	}
}
deleteCategory=(id=0)=>{
	if(confirm('Are you sure to delete this?')){
		var url = conf.deleteSubCategory.url(id);
		var method = conf.deleteSubCategory.method;
		var data = {};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				TRIFED.showMessage('success', 'Product mini Category deleted Successfully');
				setTimeout(function() { window.location = 'product-mini-category-list.php'}, 500);
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
		var url = conf.updateProjectMiniCategoryStatus.url;
		var method = conf.updateProjectMiniCategoryStatus.method;
		var data = {
			id,
			status
		};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				TRIFED.showMessage('success', 'Product mini category Status Updated Successfully');
				setTimeout(function() { window.location = 'product-mini-category-list.php'}, 500);
			}
		});	
	}
}
showHistory=(id)=>{
	var url = conf.getProjectMiniCategoryStatusHistory.url;
		var method = conf.getProjectMiniCategoryStatusHistory.method;
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