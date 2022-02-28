$(function () {
 	var auth = TRIFED.getLocalStorageItem();
 	
	$("#formID").submit(function(e) {
	    e.preventDefault();
	}).validate({
	    rules: {
			'old_password':{
				'required':true
			},
			'password':{
				'required':true
			},
			'password_confirmation':{
				'required':true,
				'equalTo': "#password"

			}			
            
        },
        messages: {
            
		},
	    submitHandler: function(form) { 
	        
			//const data=$('#formID').serializeArray();
			
    		
			var url = conf.changePassword.url;
			var method = conf.changePassword.method;
			
			var form = $('#formID')[0];   
    		var data = new FormData(form);	
    		TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					
					TRIFED.showMessage('success', response.message);
					setTimeout(function() { window.location = 'change-password.php'}, 500);
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
			$('#role').val(response.data.role_id);
		}
	});
}
