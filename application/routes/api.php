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

   
Route::middleware('auth:api')->group( function () {
    Route::get('logout', [RegisterController::class, 'logout']);
    Route::resource('product_vertical', ProductVerticalModelController::class);
    Route::get('approved_product_vertical', [ProductVerticalModelController::class,'getVertical']);
    Route::resource('product_category', ProcductCategoryController::class);
    Route::get('approved_product_categories', [ProcductCategoryController::class,'getCategory']);
    Route::resource('product_subcategory', ProductSubcategoryController::class);
    Route::resource('product_form', ProcductFormController::class);
    Route::get('approved_products_form', [ProcductFormController::class,'getProductForm']);
    Route::resource('product_mini_category', ProjectMiniCategoryController::class);
    Route::resource('roles', RolesController::class);
    Route::get('permissions_list', [RolesController::class,'getPermissionsList']);
    Route::post('save_role_permissions', [RolesController::class,'savePermissions']);
    Route::get('get-role-permissions/{id}', [RolesController::class,'getRolePermission']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
