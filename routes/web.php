<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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
Route::get('/', function() {
    return redirect('/home');
});

Route::post('/logout', 'LoginController@logout')->name('logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/medicine', 'HomeController@medicineDetail')->name('home.getMedicineDetail');

Route::get('/product','MedicineController@front_index')->middleware('auth');

Route::get('/cart','MedicineController@cart')->name('medicine_cart');

Route::get('/add-to-cart/{id}','MedicineController@addToCart')->name('add_medicine_to_cart')->middleware('auth');

Route::get('submit_checkout','TransactionController@submit_cart')->name('submitcheckout')->middleware('auth');

Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard')->middleware('auth');

// Route::get('coba1','MedicineController@coba1');

Route::resource('categories','CategoryController')->middleware(['auth']);
Route::get('report/listmedicine/{id}','CategoryController@showlist');

Route::get('report/listExpensiveMedicine','MedicineController@showMaxMedicine');
Route::post('report/history/medicine','TransactionController@showHistoryMedicine')->name('transaction.history');

// Route::get('/ceklayout', function () {
//     return view('layout.conquer');
// });

Route::post('/medicines/showInfo','MedicineController@showInfo')->name('medicines.showInfo');

Route::post('/category/showProducts','CategoryController@showProducts')->name('category.showProducts');

Route::middleware(['auth'])->group(function(){
    Route::resource('transaction','TransactionController');

    Route::get('/admin/transaction/detail','TransactionController@previewTransaction')->name('transaction.admin');

    Route::post('transaction/showDetail','TransactionController@showAjax')->name('transaction.showAjax');

    Route::post('transaction/changeAmount','TransactionController@UpdateAmount')->name('transaction.changeAmount');

    Route::post('transaction/delete','TransactionController@deleteMedicine')->name('transaction.deleteItems');

    Route::get('report/print', 'TransactionController@exportToPdf')->name('report.pdf');
});

Route::middleware(['auth'])->group(function(){
    Route::resource('supplier','SupplierController');

    Route::post('supplier/getEditForm','SupplierController@getEditForm')->name('supplier.getEditForm');
    
    Route::post('supplier/getEditForm2','SupplierController@getEditForm2')->name('supplier.getEditForm2');
    
    Route::post('supplier/saveData','SupplierController@saveData')->name('supplier.saveData');
    
    Route::post('supplier/deleteData','SupplierController@deleteData')->name('supplier.deleteData');
    
});
Route::middleware(['auth'])->group(function(){
    Route::resource('medicines','MedicineController');

    Route::post('medicines/getEditForm','MedicineController@getEditForm')->name('medicines.getEditForm');

    Route::post('medicines/getEditForm2','MedicineController@getEditForm2')->name('medicines.getEditForm2');

    Route::post('medicines/saveData','MedicineController@saveData')->name('medicines.saveData');

    Route::post('medicines/deleteData','MedicineController@deleteData')->name('medicines.deleteData');
});