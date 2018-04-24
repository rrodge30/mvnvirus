<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
|
*/
Auth::routes();
Route::get('/user/change/account', 'Auth\ChangeAccountController@index')->name('user.change.account');
Route::post('/user/change/account/submit', 'Auth\ChangeAccountController@changeAccount')->name('user.change.account.submit');
/*-----------------------------------------------------------------------*/


Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| List (HOME)
|--------------------------------------------------------------------------
|
*/
    //LIST
        
Route::get('/list/branch/change/{id}', 'HomeController@onChangeBranchValue')->name('list.branch.change');

Route::middleware('isadmin')->group(function(){ // ONLY ADMIN ALLOWED TO REQUEST THIS ACTIONS
    

    //BRANCH
    Route::get('/branch/add','BranchController@store')->name('branch.add');
    Route::get('/branch/delete/{id}','BranchController@destroy')->name('branch.delete');

    //ITEM
    Route::get('/item/add','ItemController@store')->name('item.add');
    Route::get('/item/delete','ItemController@destroy')->name('item.delete');
});

/*-----------------------------------------------------------------------*/

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
|
*/
Route::middleware('isadmin')->group(function(){ // ONLY ADMIN ALLOWED TO REQUEST THIS ACTIONS
    Route::get('/user/manage/delete/{id}', 'UserManageController@destroy')->name('user.manage.delete');
    //Route::post('/user/manage/register', 'UserManageController@store')->name('user.manage.register');
    Route::get('/user/manage', 'UserManageController@index')->name('user.manage');
});
/*-----------------------------------------------------------------------*/

/*
|--------------------------------------------------------------------------
| PDF
|--------------------------------------------------------------------------
|
*/
Route::middleware('auth')->group(function(){ 
    Route::get('/pdf/export/list', 'pdf\PdfController@pdfExportList')->name('pdf.export.list');
});
/*-----------------------------------------------------------------------*/
