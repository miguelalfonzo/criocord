<?php



Route::get('/sql', function () {
    
   

});

//usuarios

Route::get('/usuarios','Mantenimiento\UsuarioController@index');
Route::get('/list_usuarios','Mantenimiento\UsuarioController@list_usuarios');
Route::get('/get_item_usuario','Mantenimiento\UsuarioController@get_item_usuario');

Route::get('/api_item_usuario','Mantenimiento\UsuarioController@api_item_usuario');
Route::post('/save_usuario','Mantenimiento\UsuarioController@save_usuario');



//roles

Route::get('/roles','Mantenimiento\RolController@index');


//mantenimiento de cliente

Route::get('/cliente','Mantenimiento\ClienteController@index');
Route::get('/list_cliente','Mantenimiento\ClienteController@list_cliente');
Route::get('/filter_ubigeo','Mantenimiento\MaestroController@filter_ubigeo');
Route::get('/filter_cliente','Mantenimiento\MaestroController@filter_cliente');
Route::get('/search_cliente','Mantenimiento\ClienteController@search_cliente');

Route::get('/get_item_cliente','Mantenimiento\ClienteController@get_item_cliente');
Route::post('/save_cliente','Mantenimiento\ClienteController@save_cliente');



//contratos

Route::get('/prospecto','Contrato\ProspectoController@index');

//prospectos

Route::get('/contrato','Contrato\ContratoController@index');

//cobranza-llamada

Route::get('/llamada','Cobranza\LlamadaController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
