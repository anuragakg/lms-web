const endpoint = 'http://127.0.0.1:8000/api/';  

var conf = {

    'generatePassword': {
        'url': endpoint + 'generate-password',
        'method': 'POST',
    },

    'forgotPassword': {
        'url': endpoint + 'forgot-password',
        'method': 'POST',
    },

    'resetPassword': {
        'url': endpoint + 'reset-password',
        'method': 'POST',
    },
    
    
    'login': {
        'url': endpoint + 'login',
        'method': 'POST',
    },

    'logout': {
        'url': endpoint + 'logout',
        'method': 'GET',
    },

    'changePassword': {
        'url': endpoint + 'change-password',
        'method': 'POST',
    },

    'addProjectVertical': {
        'url': endpoint + 'product_vertical',
        'method': 'POST',
    },
	'getProjectVertical': {
        'url': endpoint + 'product_vertical',
        'method': 'GET',
    },
	'getProjectVerticalById': {
        url : function (id) {
            return endpoint + 'product_vertical/' + id;
        },
        'method' : 'GET'
    },
	'updateProjectVertical': {
        url : function (id) {
            return endpoint + 'product_vertical/' + id;
        },
        'method' : 'PUT'
    },
	'deleteProjectVerticalById': {
        url : function (id) {
            return endpoint + 'product_vertical/' + id;
        },
        'method' : 'DELETE'
    },
    'addProjectCategory': {
        'url': endpoint + 'product_category',
        'method': 'POST',
    },
    'getProjectCategory': {
        'url': endpoint + 'product_category',
        'method': 'GET',
    },
    'getProjectCategoryById': {
        url : function (id) {
            return endpoint + 'product_category/' + id;
        },
        'method' : 'GET'
    },
    'updateProjectCategory': {
        url : function (id) {
            return endpoint + 'product_category/' + id;
        },
        'method' : 'PUT'
    },
    'deleteProjectCategoryById': {
        url : function (id) {
            return endpoint + 'product_category/' + id;
        },
        'method' : 'DELETE'
    },

    'addProjectForm': {
        'url': endpoint + 'product_form',
        'method': 'POST',
    },
	
}
