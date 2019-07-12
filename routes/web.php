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

// Route::get('/main', function () {
//     return view('contenido/contenido');
// })->name('main');
Route::get('/',function(){
    return view('inicio/contenido');
})->name('inicio');



// Route::group(['middleware'=>['auth']],function(){
    Route::get('/licoreria',function(){
        return view('contenido/contenido');
    })->name('registro');
 
       
Route::get('/categoria', 'CategoriaController@index');
Route::post('/categoria/registrar', 'CategoriaController@store');
Route::put('/categoria/actualizar', 'CategoriaController@update');
Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
Route::put('/categoria/activar', 'CategoriaController@activar');
Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
Route::get('/categoria/listarCategoria', 'CategoriaController@listarCategoria');

Route::get('/cliente', 'ClienteController@index');
Route::post('/cliente/registrar', 'ClienteController@store');
Route::put('/cliente/actualizar', 'ClienteController@update');
Route::put('/cliente/desactivar', 'ClienteController@desactivar');
Route::put('/cliente/activar', 'ClienteController@activar');
Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');

Route::get('/producto', 'ProductoController@index');
Route::post('/producto/registrar', 'ProductoController@store');
Route::put('/producto/actualizar', 'ProductoController@update');
Route::put('/producto/desactivar', 'ProductoController@desactivar');
Route::put('/producto/activar', 'ProductoController@activar');
Route::get('/producto/selectProducto', 'ProductoController@selectProducto');
Route::get('/producto/listarProducto', 'ProductoController@listarProducto');

Route::get('/venta', 'VentaController@index');
Route::post('/venta/registrar', 'VentaController@store');
Route::put('/venta/actualizar', 'VentaController@update');
Route::put('/venta/desactivar', 'VentaController@desactivar');
Route::put('/venta/activar', 'VentaController@activar');

Route::get('/usuario/login','UsuarioController@Login');


Route::get('/pedido', 'PedidoController@index');
Route::post('/pedido/registrar', 'PedidoController@store');
Route::put('/pedido/actualizar', 'PedidoController@update');
Route::put('/pedido/desactivar', 'PedidoController@desactivar');
Route::put('/pedido/activar', 'PedidoController@activar');


// Route::get('/','Auth\LoginController@showLoginForm');
// Route::post('/login','Auth\LoginController@login')->name('login');

// Route::get('/home', 'HomeController@index')->name('home');
// });
Auth::routes();
   
Route::get('/home', 'HomeController@index')->name('home');
