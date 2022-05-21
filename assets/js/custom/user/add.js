
const edit_id = TRIFED.getUrlParameters().id;
$(function () {
	fetchRoleList();
	$('#doj').datepicker(
	{
		dateFormat: 'yy-mm-dd'
	}
	);
	if(edit_id!= undefined)
	{
		getUser(edit_id)
	}
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
			
    		
			var url = conf.addUser.url;
			var method = conf.addUser.method;
			
			var form = $('#formID')[0];   
    		var data = new FormData(form);	
    		if (edit_id != undefined && edit_id != '') 
			{
				data.append('form_id', edit_id );
			}
			TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					
					TRIFED.showMessage('success', 'User saved successfully');
					setTimeout(function() { window.location = 'users-list.php'}, 3000);
				} else {
					TRIFED.showError('error', response.message);
				}
			});
	        return false;  //This doesn't prevent the form from submitting.
	    }
	});    
});


fetchRoleList = () => {
	var url = conf.getRoleList.url;
	var method = conf.getRoleList.method;
	var data = {};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			html='<option value="">Select Role</option>';
			response.data.forEach((row)=>{
				html +='<option value="'+row.id+'">'+row.title+'</option>'
			});
			$('#role').html(html);
		}
	});
}
getUser=(id=0)=>{
	var url = conf.getUser.url(id);
	var method = conf.getUser.method;
	var data = {};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			$('#name').val(response.data.name);
			$('#email').val(response.data.email);
			$('#official_contact_number').val(response.data.official_contact_number);
			$('#emergency_contact_number').val(response.data.emergency_contact_number);
			$('#relation_contact_number').val(response.data.relation_contact_number);
			$('#personal_email').val(response.data.personal_email);
			$('#role').val(response.data.role_id);
			$('#phone').val(response.data.phone);
			$('#emp_code').val(response.data.emp_code);
			$('#dept').val(response.data.dept);
			$('#designation').val(response.data.designation);
			$('#rm').val(response.data.rm);
			$('#perm_address').val(response.data.perm_address);
			$('#comm_address').val(response.data.comm_address);
			$('#aadhar').val(response.data.aadhar);
			$('#pan_number').val(response.data.pan_number);
		}
	});
}
