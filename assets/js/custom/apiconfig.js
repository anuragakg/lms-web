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
    'getProjectForm': {
        url : function (id) {
            return endpoint + 'product_form/' + id;
        },
        'method' : 'GET'
    },
    'getProjectFormList': {
        url : endpoint + 'product_form',
        'method' : 'GET'
    },
    'deleteProject': {
        url : function (id) {
            return endpoint + 'product_form/' + id;
        },
        'method' : 'DELETE'
    },

    'approved_product_vertical': {
        url : endpoint + 'approved_product_vertical',
        'method' : 'GET'
    },
    'approved_product_categories': {
        url : endpoint + 'approved_product_categories',
        'method' : 'GET'
    },
    'approved_products_form': {
        url : endpoint + 'approved_products_form',
        'method' : 'GET'
    },
	'addProjectSubCategory': {
        'url': endpoint + 'product_subcategory',
        'method': 'POST',
    },
    'getProjectSubCategory': {
        url : function (id) {
            return endpoint + 'product_subcategory/' + id;
        },
        'method': 'GET',
    },
    'getProjectSubCategoryList': {
        'url': endpoint + 'product_subcategory',
        'method': 'GET',
    },
    'deleteSubCategory': {
        url : function (id) {
            return endpoint + 'product_subcategory/' + id;
        },
        'method' : 'DELETE'
    },
    'getFormControls':{
        url : function (id) {
            return endpoint + 'product_form/' + id;
        },
        'method' : 'GET'
    },
    'addProjectMiniCategory': {
        'url': endpoint + 'product_mini_category',
        'method': 'POST',
    },
    'getProjectMiniCategoryList': {
        'url': endpoint + 'product_mini_category',
        'method': 'GET',
    },
    'getProjectMiniCategory': {
        url : function (id) {
            return endpoint + 'product_mini_category/' + id;
        },
        'method': 'GET',
    },
    'getRolesList': {
        'url': endpoint + 'roles',
        'method': 'GET',
    },
    'getPermissionList': {
        'url': endpoint + 'permissions_list',
        'method': 'GET',
    },
    'getRole': {
        url : function (id) {
            return endpoint + 'roles/' + id;
        },
        'method': 'GET',
    },
    'addRolePermission': {
        url : endpoint + 'save_role_permissions',
        'method': 'POST',
    },
    'getRolePermission': {
        url : function (id) {
            return endpoint + 'get-role-permissions/' + id;
        },
        'method': 'GET',
    },
}
