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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::get('/', function () {
	    return view('homescreen');
	});
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/unauthorized', 'HomeController@unauthorized')->name('unauthorized');
	Route::get('/not_found', 'HomeController@notfound')->name('not_found');

	Route::group(['middleware' => ['super_admin']], function () {
		Route::get('/folding_gates/', 'FoldingGatesController@index')->name('folding_gate');
		Route::get('/folding_gates/add', 'FoldingGatesController@getAdd')->name('folding_gate_add');
		Route::post('/folding_gates/add', 'FoldingGatesController@postAdd')->name('folding_gate_add_post');
		Route::get('/folding_gates/datatables', 'FoldingGatesController@getDatatables')->name('datatable_folding_gate');
		Route::get('/folding_gates/prices', 'FoldingGatesController@getPrices')->name('folding_gate_price');
		Route::get('/folding_gates/edit', 'FoldingGatesController@getEdit')->name('folding_gate_edit');
		Route::post('/folding_gates/edit', 'FoldingGatesController@postEdit')->name('folding_gate_edit_post');
		Route::get('/folding_gates/delete', 'FoldingGatesController@getDelete')->name('folding_gate_delete');
		Route::post('/folding_gates/delete', 'FoldingGatesController@postDelete')->name('folding_gate_delete_post');


		Route::get('/folding_gate_spareparts/', 'FoldingGateSparepartsController@index')->name('folding_gate_sparepart');
		Route::get('/folding_gate_spareparts/add', 'FoldingGateSparepartsController@getAdd')->name('folding_gate_sparepart_add');
		Route::post('/folding_gate_spareparts/add', 'FoldingGateSparepartsController@postAdd')->name('folding_gate_sparepart_add_post');
		Route::get('/folding_gate_spareparts/datatables', 'FoldingGateSparepartsController@getDatatables')->name('datatable_folding_gate_sparepart');
		Route::get('/folding_gate_spareparts/prices', 'FoldingGateSparepartsController@getPrices')->name('folding_gate_sparepart_price');
		Route::get('/folding_gate_spareparts/edit', 'FoldingGateSparepartsController@getEdit')->name('folding_gate_sparepart_edit');
		Route::post('/folding_gate_spareparts/edit', 'FoldingGateSparepartsController@postEdit')->name('folding_gate_sparepart_edit_post');
		Route::get('/folding_gate_spareparts/delete', 'FoldingGateSparepartsController@getDelete')->name('folding_gate_sparepart_delete');
		Route::post('/folding_gate_spareparts/delete', 'FoldingGateSparepartsController@postDelete')->name('folding_gate_sparepart_delete_post');

		Route::get('/rolling_doors/', 'RollingDoorsController@index')->name('rolling_door');
		Route::get('/rolling_doors/add', 'RollingDoorsController@getAdd')->name('rolling_door_add');
		Route::post('/rolling_doors/add', 'RollingDoorsController@postAdd')->name('rolling_door_add_post');
		Route::get('/rolling_doors/datatables', 'RollingDoorsController@getDatatables')->name('datatable_rolling_door');
		Route::get('/rolling_doors/prices', 'RollingDoorsController@getPrices')->name('rolling_door_price');
		Route::get('/rolling_doors/edit', 'RollingDoorsController@getEdit')->name('rolling_door_edit');
		Route::post('/rolling_doors/edit', 'RollingDoorsController@postEdit')->name('rolling_door_edit_post');
		Route::get('/rolling_doors/delete', 'RollingDoorsController@getDelete')->name('rolling_door_delete');
		Route::post('/rolling_doors/delete', 'RollingDoorsController@postDelete')->name('rolling_door_delete_post');


		Route::get('/rolling_door_spareparts/', 'RollingDoorSparepartsController@index')->name('rolling_door_sparepart');
		Route::get('/rolling_door_spareparts/add', 'RollingDoorSparepartsController@getAdd')->name('rolling_door_sparepart_add');
		Route::post('/rolling_door_spareparts/add', 'RollingDoorSparepartsController@postAdd')->name('rolling_door_sparepart_add_post');
		Route::get('/rolling_door_spareparts/datatables', 'RollingDoorSparepartsController@getDatatables')->name('datatable_rolling_door_sparepart');
		Route::get('/rolling_door_spareparts/prices', 'RollingDoorSparepartsController@getPrices')->name('rolling_door_sparepart_price');
		Route::get('/rolling_door_spareparts/edit', 'RollingDoorSparepartsController@getEdit')->name('rolling_door_sparepart_edit');
		Route::post('/rolling_door_spareparts/edit', 'RollingDoorSparepartsController@postEdit')->name('rolling_door_sparepart_edit_post');
		Route::get('/rolling_door_spareparts/delete', 'RollingDoorSparepartsController@getDelete')->name('rolling_door_sparepart_delete');
		Route::post('/rolling_door_spareparts/delete', 'RollingDoorSparepartsController@postDelete')->name('rolling_door_sparepart_delete_post');


		Route::get('/folding_gate_orders/edit', 'FoldingGateOrdersController@getEdit')->name('folding_gate_order_edit');
		Route::post('/folding_gate_orders/edit', 'FoldingGateOrdersController@postEdit')->name('folding_gate_order_edit_post');
		Route::get('/folding_gate_orders/delete', 'FoldingGateOrdersController@getDelete')->name('folding_gate_order_delete');
		Route::post('/folding_gate_orders/delete', 'FoldingGateOrdersController@postDelete')->name('folding_gate_order_delete_post');


		Route::get('/folding_gate_sparepart_orders/edit', 'FoldingGateSparepartOrdersController@getEdit')->name('folding_gate_sparepart_order_edit');
		Route::post('/folding_gate_sparepart_orders/edit', 'FoldingGateSparepartOrdersController@postEdit')->name('folding_gate_sparepart_order_edit_post');
		Route::get('/folding_gate_sparepart_orders/delete', 'FoldingGateSparepartOrdersController@getDelete')->name('folding_gate_sparepart_order_delete');
		Route::post('/folding_gate_sparepart_orders/delete', 'FoldingGateSparepartOrdersController@postDelete')->name('folding_gate_sparepart_order_delete_post');


		Route::get('/rolling_door_orders/edit', 'RollingDoorOrdersController@getEdit')->name('rolling_door_order_edit');
		Route::post('/rolling_door_orders/edit', 'RollingDoorOrdersController@postEdit')->name('rolling_door_order_edit_post');
		Route::get('/rolling_door_orders/delete', 'RollingDoorOrdersController@getDelete')->name('rolling_door_order_delete');
		Route::post('/rolling_door_orders/delete', 'RollingDoorOrdersController@postDelete')->name('rolling_door_order_delete_post');


		Route::get('/rolling_door_sparepart_orders/edit', 'RollingDoorSparepartOrdersController@getEdit')->name('rolling_door_sparepart_order_edit');
		Route::post('/rolling_door_sparepart_orders/edit', 'RollingDoorSparepartOrdersController@postEdit')->name('rolling_door_sparepart_order_edit_post');
		Route::get('/rolling_door_sparepart_orders/delete', 'RollingDoorSparepartOrdersController@getDelete')->name('rolling_door_sparepart_order_delete');
		Route::post('/rolling_door_sparepart_orders/delete', 'RollingDoorSparepartOrdersController@postDelete')->name('rolling_door_sparepart_order_delete_post');


		Route::get('/accounts/', 'AccountsController@index')->name('account');
		Route::get('/accounts/add', 'AccountsController@getAdd')->name('account_add');
		Route::post('/accounts/add', 'AccountsController@postAdd')->name('account_add_post');
		Route::get('/accounts/edit', 'AccountsController@getEdit')->name('account_edit');
		Route::post('/accounts/edit', 'AccountsController@postEdit')->name('account_edit_post');
		Route::get('/accounts/delete', 'AccountsController@getDelete')->name('account_delete');
		Route::post('/accounts/delete', 'AccountsController@postDelete')->name('account_delete_post');
		Route::get('/accounts/datatables', 'AccountsController@getDatatables')->name('datatable_account');

	});

	

	Route::get('/folding_gate_orders/', 'FoldingGateOrdersController@index')->name('folding_gate_order');
	Route::get('/folding_gate_orders/add', 'FoldingGateOrdersController@getAdd')->name('folding_gate_order_add');
	Route::post('/folding_gate_orders/add', 'FoldingGateOrdersController@postAdd')->name('folding_gate_order_add_post');
	Route::get('/folding_gate_orders/view', 'FoldingGateOrdersController@getView')->name('folding_gate_order_view');
	Route::get('/folding_gate_orders/datatables', 'FoldingGateOrdersController@getDatatables')->name('datatable_folding_gate_order');
	Route::get('/folding_gate_orders/print', 'FoldingGateOrdersController@getPrint')->name('print_folding_gate_order');

	

	Route::get('/folding_gate_sparepart_orders/', 'FoldingGateSparepartOrdersController@index')->name('folding_gate_sparepart_order');
	Route::get('/folding_gate_sparepart_orders/add', 'FoldingGateSparepartOrdersController@getAdd')->name('folding_gate_sparepart_order_add');
	Route::post('/folding_gate_sparepart_orders/add', 'FoldingGateSparepartOrdersController@postAdd')->name('folding_gate_sparepart_order_add_post');
	Route::get('/folding_gate_sparepart_orders/view', 'FoldingGateSparepartOrdersController@getView')->name('folding_gate_sparepart_order_view');
	Route::get('/folding_gate_sparepart_orders/datatables', 'FoldingGateSparepartOrdersController@getDatatables')->name('datatable_folding_gate_sparepart_order');
	Route::get('/folding_gate_sparepart_orders/print', 'FoldingGateSparepartOrdersController@getPrint')->name('print_folding_gate_sparepart_order');

	Route::get('/rolling_door_orders/', 'RollingDoorOrdersController@index')->name('rolling_door_order');
	Route::get('/rolling_door_orders/add', 'RollingDoorOrdersController@getAdd')->name('rolling_door_order_add');
	Route::post('/rolling_door_orders/add', 'RollingDoorOrdersController@postAdd')->name('rolling_door_order_add_post');
	Route::get('/rolling_door_orders/view', 'RollingDoorOrdersController@getView')->name('rolling_door_order_view');
	Route::get('/rolling_door_orders/datatables', 'RollingDoorOrdersController@getDatatables')->name('datatable_rolling_door_order');
	Route::get('/rolling_door_orders/print', 'RollingDoorOrdersController@getPrint')->name('print_rolling_door_order');


	Route::get('/rolling_door_sparepart_orders/', 'RollingDoorSparepartOrdersController@index')->name('rolling_door_sparepart_order');
	Route::get('/rolling_door_sparepart_orders/add', 'RollingDoorSparepartOrdersController@getAdd')->name('rolling_door_sparepart_order_add');
	Route::post('/rolling_door_sparepart_orders/add', 'RollingDoorSparepartOrdersController@postAdd')->name('rolling_door_sparepart_order_add_post');
	Route::get('/rolling_door_sparepart_orders/view', 'RollingDoorSparepartOrdersController@getView')->name('rolling_door_sparepart_order_view');
	Route::get('/rolling_door_sparepart_orders/datatables', 'RollingDoorSparepartOrdersController@getDatatables')->name('datatable_rolling_door_sparepart_order');
	Route::get('/rolling_door_sparepart_orders/print', 'RollingDoorSparepartOrdersController@getPrint')->name('print_rolling_door_sparepart_order');


	Route::get('/change_passwords/', 'ChangePasswordsController@index')->name('change_password');
	Route::post('/change_passwords/save', 'ChangePasswordsController@postSave')->name('change_password_save');

});
