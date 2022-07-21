<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductVerticalModelController;
use App\Http\Controllers\API\ProcductCategoryController;
use App\Http\Controllers\API\ProductSubcategoryController;
use App\Http\Controllers\API\ProcductFormController;
use App\Http\Controllers\API\ProjectMiniCategoryController;
use App\Http\Controllers\API\RolesController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\LeadsController;
use App\Http\Controllers\API\ProgramsController;
use App\Http\Controllers\API\Payments;
use App\Http\Controllers\API\CronController;
use App\Http\Controllers\API\FormController;
//use App\Http\Controllers\API\QuickbookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::post('forgot-password', [RegisterController::class,'forgotPassword']);
Route::post('reset-password', [RegisterController::class,'resetPassword']);
   
Route::middleware('auth:api')->group( function () {
    Route::get('logout', [RegisterController::class, 'logout']);
	Route::post('change-password', [RegisterController::class,'changePassword']);
    Route::get('dashboard', [DashboardController::class,'index']);
    Route::resource('product_vertical', ProductVerticalModelController::class);
    Route::post('updateProjectVerticalStatus', [ProductVerticalModelController::class,'updateProjectVerticalStatus']);
    Route::post('getProjectVerticalStatusHistory', [ProductVerticalModelController::class,'getProjectVerticalStatusHistory']);
    Route::get('approved_product_vertical', [ProductVerticalModelController::class,'getVertical']);
    Route::resource('product_category', ProcductCategoryController::class);
    Route::post('updateProjectCategoryStatus', [ProcductCategoryController::class,'updateProjectCategoryStatus']);
    Route::post('getProjectCategoryStatusHistory', [ProcductCategoryController::class,'getProjectCategoryStatusHistory']);
    Route::get('approved_product_categories', [ProcductCategoryController::class,'getCategory']);
    Route::resource('product_subcategory', ProductSubcategoryController::class);
    Route::post('updateProjectSubCategoryStatus', [ProductSubcategoryController::class,'updateProjectSubCategoryStatus']);
    Route::get('approved_product_subcategory', [ProductSubcategoryController::class,'approved_product_subcategory']);
    Route::post('getProjectSubCategoryStatusHistory', [ProductSubcategoryController::class,'getProjectSubCategoryStatusHistory']);
    Route::resource('product_form', ProcductFormController::class);
    Route::post('updateProjectFormStatus', [ProcductFormController::class,'updateProjectFormStatus']);
    Route::post('getProjectFormStatusHistory', [ProcductFormController::class,'getProjectFormStatusHistory']);
    Route::get('approved_products_form', [ProcductFormController::class,'getProductForm']);
    Route::resource('product_mini_category', ProjectMiniCategoryController::class);
    Route::post('updateProjectMiniCategoryStatus', [ProjectMiniCategoryController::class,'updateProjectMiniCategoryStatus']);
    Route::post('getProjectMiniCategoryStatusHistory', [ProjectMiniCategoryController::class,'getProjectMiniCategoryStatusHistory']);
    Route::resource('roles', RolesController::class);
    Route::get('role-list', [RolesController::class,'getRoleList']);
    Route::get('permissions_list', [RolesController::class,'getPermissionsList']);
    Route::post('save_role_permissions', [RolesController::class,'savePermissions']);
    Route::get('get-role-permissions/{id}', [RolesController::class,'getRolePermission']);
    Route::resource('users', UsersController::class);
    Route::post('fetchRoleUsers', [UsersController::class,'fetchRoleUsers']);
	
    Route::get('notification/mark-all-read', [NotificationController::class,'markAllRead'])->name('notification-read');
    Route::get('notification/count', [NotificationController::class,'getNotificationCount'])->name('notification-count');
    Route::apiResource('notification', NotificationController::class);
    Route::apiResource('programs', ProgramsController::class);
    Route::apiResource('payments', Payments::class);
    Route::post('payments-installment', [Payments::class,'paymentInstallment']);
    Route::get('getPrograms', [ProgramsController::class,'getProgram']);
    Route::get('leadPaymentDetails/{id}', [Payments::class,'leadPaymentDetails']);
    Route::post('remove_installment', [Payments::class,'remove_installment']);
    Route::post('import-leads', [LeadsController::class,'importLeads']);
    Route::apiResource('forms', FormController::class);
    Route::get('getQuestionsList/{id}', [FormController::class,'getQuestionsList']);
    Route::get('forms_filed_list', [FormController::class,'forms_filed_list']);
    Route::post('addFormsAnswer', [FormController::class,'addFormsAnswer']);
    Route::get('answers_view/{id}', [FormController::class,'answers_view']);
    Route::get('forms_list', [FormController::class,'forms_list']);
    
});
Route::apiResource('cron', CronController::class);
Route::post('send-email', [UsersController::class,'sendEmail']);
Route::apiResource('leads', LeadsController::class);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
