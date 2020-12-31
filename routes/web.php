<?php

use Illuminate\Support\Facades\Route;

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

//Route::bind('articulo',function($id){
//	return App\Articulo::where('id',$id)->first();
//});

Route::get('/', [
	'as'=>'home',
	'uses'=>'StoreController@all'
]);


// Route::get('/home', function () {
//     return view('admin.dashboard');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//--MOSTARR ARTICULO DETALLE
Route::get('/articulo/{id}',[
	'as'=>'articulo-detalle',
	'uses'=>'StoreController@show'
]);

//-----Carrito-------------
Route::get('cart/show',[
	'as'=>'cart-show',
	'uses'=>'CartController@show'
]);

//Agrega al carrito {id}
Route::get('cart/add',[
	'as'=>'cart-add',
	'uses'=>'CartController@add'
]);

//elimina del carrito un articulo

Route::get('cart/delete/{id}',[
	'as'=>'cart-delete',
	'uses'=>'CartController@delete'
]);

//Vacia el carrito x completo

Route::get('cart/trash',[
	'as'=>'cart-trash',
	'uses'=>'CartController@trash'
]);

//actualiza la cantidad del carrito
Route::get('cart/update/{id}/{quantity}',[
	'as'=>'cart-update',
	'uses'=>'CartController@update'
]);

//muestra detalle del pedido

Route::get('order-detail',[
	'middleware'=>'auth',
	'as'=>'order-detail',
	'uses'=>'CartController@OrderDetail'
]);


// Paypal--------------------
//Enviamos nuestro pedido a paypal
Route::get('payment',array(
	'as'=>'payment',
	'uses'=>'PaypalController@postPayment'
));

Route::get('payment/status',array(
	'as'=>'payment.status',
	'uses'=>'PaypalController@getPaymentStatus'
));



//end paypal


//Admin--------------------------------------------------------

Route::group(['namespace'=>'Admin','middleware'=>['auth','admin'],'prefix'=>'admin'],function(){

	// Route::get('/home', function () {
		
	//     return view('admin.home');
	// })->name('home-admin');

	Route::get('/home', 'HomeController@index')->name('home-admin');


	Route::resource('categoria','CategoriaController');

	Route::resource('articulos','ArticulosController');

	//ruta para mandar 2 vriables para edit comentado
	// Route::get('articulos/{id}/{id_talla}',[
	// 	'as'=>'edit-articulos',
	// 	'uses'=>'ArticulosController@edit'
	// ]);

	
	//PEDIDOS
	Route::post('order/get-items',[
		'as'=>'order-getItems',
		'uses'=>'OrderController@getItems'
	]);

	Route::resource('orders','OrderController');
	Route::resource('marcas','MarcaController');
	Route::resource('tallas','TallaController');
	Route::resource('users','UserController');
	Route::resource('ingresos','IngresoController');
	Route::resource('estadisticas','EstadisticasController');
	Route::resource('articulotalla','ArticulotallaController');
	Route::resource('proveedor','ProveedorController');

	Route::resource('excel','ExcelController');



	
	//ruta empleada para obtener las tallas que tiene un producto
	Route::get('/ingresos/size/{id}','IngresoController@getSize');



	//actualiza EL ESTADO DEL PEDIDO
Route::get('order/update/{id}/{quantity}',[
	'as'=>'order-estado',
	'uses'=>'OrderController@update'
]);








});
	