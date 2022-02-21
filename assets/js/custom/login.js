/*
------------------------------------------------------------------------------------
|   This code block is used to submit data on login
|   and test that session have values or not
------------------------------------------------------------------------------------
*/
var key;

var IV = '1234567890123412';

function encryptWithKey(str,encKey) {
    key = CryptoJS.enc.Utf8.parse(encKey);
    var iv= CryptoJS.enc.Utf8.parse(IV);
    var encrypted = CryptoJS.AES.encrypt(str, key, { iv: iv, mode: CryptoJS.mode.CBC, padding: CryptoJS.pad.Pkcs7});
    return encrypted.toString();
}

function makeid(l)
{
    var text = "";
    var char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for(var i=0; i < l; i++ )
    {  
        text += char_list.charAt(Math.floor(Math.random() * char_list.length));
    }
    return text;
}

$(function () {
    login();
    checkAuthentication();
    bodyLoad();
    var pathname = window.location.pathname;
    var server_type = pathname.split('/');
    
});


checkAuthentication = () => {
    
    var authUser= TRIFED.getLocalStorageItem();

    if(authUser && authUser.token){
        window.location.href = 'dashboard.php';
    }
}

function bodyLoad()
{
	setMaxDigits(262);
	key = new RSAKeyPair(
    "10001",
    "10001",
    "A119BDB6286E2C4F6B8550BBA459C74C5255B851790CA816E3B054CA0262EF39C60C7A2F450CF84D6A53BA4A97206A0689BE04412E5207C5E37DD7188131AC89908B5D088A89865EDF587EFC51A94996F2AE5D6A8BFF981898BF111BD8F21F425D6AB8E49966DD5CF5DD5B473C10A86289CED21BB42CB2DE8336B7C425AD633F2975E60DD362FBA65551037C4F264EC742267F368BAC96E9ED48595E8806549E50AB486B8490EFB87364F590324B79148A071B36E0BBB11AC91E317123681FA2865F1EA43EC07D816904BFD153FC01675BFAEA632334ECB2785B2F781FC0EBC3D99C1B70FDBCF90B788DC9A247A7D6951F1E2F3AF603B482318C5CBCA6F8DB23",
    2048
  );
}

function stringEncrypt(plainString)
{
	var ciphertext = encryptedString(key, plainString,
		RSAAPP.PKCS1Padding, RSAAPP.RawEncoding);
	return ciphertext;
}


login = () => {
    $('#formID').on('submit', function(e) {
        e.preventDefault();
        
        var url = conf.login.url;
        var method = conf.login.method;
        var data = {};

        
        data.email = $('#username').val().trim();
        data.password = $('#password').val();
       
        if(data.username != "" && data.password != ""){
            $.ajax({
                method: method,
                url: url,
                data: data,
                contentType: 'application/x-www-form-urlencoded',
                dataType: 'json',
                
                statusCode: {
                    404: function (response) {
						$('#password').val('');
                        TRIFED.showError('error', response.responseJSON.message);
						
                    },
					422: function (response) {
						$('#password').val('');
                        TRIFED.showError('error', response.responseJSON.message);
						
                    },
                    429: function (response) {
                        $('#password').val('');
                        TRIFED.showError('error', 'Too many attempts .Please try after one minute');
                        
                    },
                }
            }).done(function (response) {
                if (TRIFED.checkStatus(response) == true) {
                    setToken(response);
                    window.location.href = "dashboard.php";
                }
            });
        }else{
            TRIFED.showError('error', 'Username and Password fields are required.');
        }    
    });
}

/*
------------------------------------------------------------------------------------
|   This code block is used to perform action on response data
|   and to store session values in local storage
------------------------------------------------------------------------------------
*/
function setToken(response) {
    var auth = {};
    auth.token = response.data['token'];
    auth.name = response.data['name'];
    auth.role_name = response.data['role_name'];
    
    auth.permissions = response.data['permissions'];
    auth.role = response.data["role"];
    localStorage.setItem('authUser', JSON.stringify(auth));
}

function checkMaxLength(th) {
    if (th.value.length > 30) {
        TRIFED.showError('error', 'Max character limit exceeded');
        th.value = th.value.slice(0, -1);
        return false;
    } else {
        return true;
    }
}

