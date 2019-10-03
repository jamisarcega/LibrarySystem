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

// Auth
 Route::post('admin/logout', function(){
    // 'Auth\AdminLoginController@logout'
    Auth::guard('admin')->logout();
    Request::session()->flush();
    Request::session()->regenerate();
    return view('auth.admin.login');
 })->name('admin.logout');
Auth::routes();

Route::get('/admin/login' , 'Auth\AdminLoginController@adminLogin')->name('adminLogin');
Route::post('/admin/login' , 'Auth\AdminLoginController@adminLoginSubmit')->name('adminLoginSubmit');
 


Route::get('/home', 'HomeController@index')->name('home');


// admin route
Route::get('/admin/registered-users' , 'AdminController@getUsers')->name('admin.users');
Route::post('/admin/image' , 'AdminController@image')->name('admin.image');
Route::post('/admin/add-user' , 'AdminController@addUser')->name('admin.addUser');
Route::get('/admin/registered-users/view/user' , 'AdminController@viewUser')->name('admin.viewUser');
Route::patch('/admin/registered-users/view/user/{user}' , 'AdminController@updateUser')->name('admin.updateUser');
Route::patch('/admin/registered-users/view/user/reset-password/{user}' , 'AdminController@resetPassword')->name('admin.resetPassword');
Route::post('/admin/registered-users/download' , 'AdminController@csvUserDownload')->name('downloadUserCsv');
Route::post('/admin/book/borrow' , 'AdminController@borrow')->name('admin.borrow');
Route::post('/admin/registered-users/generate-tokens' , 'AdminController@tokens')->name('admin.token');
Route::post('/admin/book/return/{transaction}' , 'AdminController@return')->name('admin.return');
Route::delete('/admin/book/delete/{book}' , 'AdminController@deleteBook')->name('admin.deleteBook');
Route::delete('/admin/user/delete/{user}' , 'AdminController@deleteUser')->name('admin.deleteUser');
Route::get('/admin/book/' , 'AdminController@scanBook')->name('admin.scanBook');
Route::post('/admin/registered-users/upload' , 'AdminController@csvUserUpload')->name('uploadUserCsv');
Route::post('/admin/transaction/add-new' , 'AdminController@addTransaction')->name('admin.addTransaction');
Route::get('/admin/transactions' , 'AdminController@transactions')->name('admin.transactions');
Route::post('/admin/print','AdminController@downloadPDF')->name('admin.pdf');
Route::resource('/admin' , 'AdminController');


Route::get('/admin/view/book' , 'AdminController@viewBook')->name('viewBook');
Route::patch('/admin/view/book/update/{book}' , 'AdminController@updateBook')->name('admin.updateBook');
Route::post('/admin/add/book' , 'AdminController@addBook')->name('admin.addBook');
Route::post('/admin/download/book-csv' , 'AdminController@csvBookDownload')->name('downloadBookCsv');
Route::post('/admin/upload/book-csv' , 'AdminController@csvBookUpload')->name('uploadBookCsv');


// user
Route::get('/user/book' , 'HomeController@books')->name('user.books');
Route::get('/user/book/view-book' , 'HomeController@viewBook')->name('user.viewBook');
Route::post('/user/book/view-book/reserve' , 'HomeController@reserve')->name('user.reserve');
Route::delete('/user/book/view-book/reserve/delete/{reservation}' , 'HomeController@deleteReservation')->name('user.deleteReservation');
Route::get('/user/borrow-history' , 'HomeController@borrowHistory')->name('user.history');
Route::post('/user/account-details/update' , 'HomeController@userUpdate')->name('user.userUpdate');


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('auth.logout');
Route::post('/registration' , 'RegistrationController@userRegistration')->name('registration');
