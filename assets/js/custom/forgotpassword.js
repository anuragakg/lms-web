$(function(){
	$('#formID').on('submit', function(e) {
        e.preventDefault();
        
        var url = conf.forgot_password.url;
        var method = conf.forgot_password.method;
        var data = {};

        
        data.email = $('#username').val().trim();
        
        if(data.username != ""){
            $.ajax({
                method: method,
                url: url,
                data: data,
                contentType: 'application/x-www-form-urlencoded',
                dataType: 'json',
                beforeSend:function(){
					$('#success_msg').html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');
				},
                statusCode: {
                    404: function (response) {
						TRIFED.showError('error', response.responseJSON.message);
						
                    },
					422: function (response) {
						TRIFED.showError('error', response.responseJSON.message);
						
                    },
                    429: function (response) {
                        TRIFED.showError('error', 'Too many attempts .Please try after one minute');
                        
                    },
                }
            }).done(function (response) {
                $('#success_msg').html(response.message)
            });
        }else{
            TRIFED.showError('error', 'Email  fields are required.');
        }    
    });
	
	$('#resetformID').on('submit', function(e) {
        e.preventDefault();
        const token = TRIFED.getUrlParameters().token;

        var url = conf.resetPassword.url;
        var method = conf.resetPassword.method;
        var data = {};

        
        data.token = token;
        data.password = $('#password').val();
        data.password_confirmation = $('#password_confirmation').val();
        
        
            $.ajax({
                method: method,
                url: url,
                data: data,
                contentType: 'application/x-www-form-urlencoded',
                dataType: 'json',
                beforeSend:function(){
					$('#success_msg').html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');
				},
                statusCode: {
                    404: function (response) {
						$('#success_msg').html('');
						TRIFED.showError('error', response.responseJSON.message);
						
                    },
					422: function (response) {
						$('#success_msg').html('');
						TRIFED.showError('error', response.responseJSON.message);
						
                    },
                    429: function (response) {
						$('#success_msg').html('');
                        TRIFED.showError('error', 'Too many attempts .Please try after one minute');
                        
                    },
                }
            }).done(function (response) {
				$('#success_msg').html('');
				TRIFED.showMessage('success', response.message);
				setTimeout(function() { window.location = 'index.php'}, 1500);
                $('#success_msg').html('');
            });
          
    });
	
})


