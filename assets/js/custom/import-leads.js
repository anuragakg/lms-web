const edit_id = TRIFED.getUrlParameters().id;
$(function () {
	
 	var auth = TRIFED.getLocalStorageItem();
 	
	$("#formID").submit(function(e) {
	    e.preventDefault();
	}).validate({
	    rules: {
            
            
        },
        messages: {
            
		},
	    submitHandler: function(form) { 
	        
			//const data=$('#formID').serializeArray();
			
    		
			var url = conf.import_leads.url;
			var method = conf.import_leads.method;
			
			var form = $('#formID')[0];   
    		var data = new FormData(form);	
    		
			TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					
					TRIFED.showMessage('success', 'Data imported successfully');
					setTimeout(function() { window.location = 'social_leads.php'}, 500);
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
updateStatus=(id,status)=>{
	if(status==1){
		status_text='approve';
	}else{
		status_text='reject';
	}
	if(confirm(`Are you sure to ${status_text} this?`)){
		var url = conf.updateProjectVerticalStatus.url;
		var method = conf.updateProjectVerticalStatus.method;
		var data = {
			id,
			status
		};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response) {
				TRIFED.showMessage('success', 'Product Vertical Status Updated Successfully');
				setTimeout(function() { window.location = 'new-product-vertical.php'}, 500);
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