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

/* RUTAS PARA MIDDLEWARE r*/
//USUARIO SIN REGISTRO NI LOGEO
Route::group(['middleware' => ['guest']], function(){

    Route::get('/', function () {
        return view('welcome');
    }); //Alias de la ruta
    
    Route::get('/page', 'PageController@index')->name('page');

    /*Route::get('login', function () {
        return view('login');
    });*/
    
    Route::get('/login', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login'); //Ruta para el controlador de login

});

//USUARIO LOGEADO 
Route::group(['middleware' => ['auth']], function(){

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main'); //Alias de la ruta


    //RUTAS PARA ADMINISTRADOR
    Route::group(['middleware' => ['Administrador']], function(){

        /*DASHBOARD*/
        Route::get('/dashboard', 'DashboardController');
        
        /*USUARIOS*/
        Route::get('/user', 'UserController@index');
        Route::get('/userCliente', 'UserController@indexCliente');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');
        Route::get ('/user/selectUser', 'UserController@selectUser');
        Route::get ('/user/selectProgramador', 'UserController@selectProgramador');
        Route::get ('/user/selectProgramadorTarea', 'UserController@selectProgramadorTarea');

        /*PRODUCTOS*/
        Route::get('/producto', 'ProductoController@index');
        Route::post('/producto/registrar', 'ProductoController@store');
        Route::put('/producto/actualizar', 'ProductoController@update');
        Route::put('/producto/desactivar', 'ProductoController@desactivar');
        Route::put('/producto/activar', 'ProductoController@activar');
        Route::get ('/producto/selectProducto', 'ProductoController@selectProducto');

        /*SERVICIOS*/
        Route::get('/servicio', 'ServicioController@index');
        Route::post('/servicio/registrar', 'ServicioController@store');
        Route::put('/servicio/actualizar', 'ServicioController@update');
        Route::put('/servicio/desactivar', 'ServicioController@desactivar');
        Route::put('/servicio/activar', 'ServicioController@activar');
        

        /*CLIENTES*/
        Route::get('/Clientes', 'ClientesController@index');
        Route::post('/Clientes/store', 'ClientesController@store');
        Route::put('/Clientes/actualizar', 'ClientesController@update');
        Route::put('/Clientes/desactivar', 'ClientesController@desactivar');
        Route::put('/Clientes/activar', 'ClientesController@activar');

        /*DEPARTAMENTOS*/
        Route::get('/departamento', 'DepartamentoController@index');
        Route::post('/departamento/registrar', 'DepartamentoController@store');
        Route::post('/departamento/registrarDepUsr', 'DepartamentoController@storeDepUsr');
        Route::put('/departamento/actualizar', 'DepartamentoController@update');
        Route::put('/departamento/borrar', 'DepartamentoController@borrar');

        /*ROLES*/
        Route::get ('/rol', 'RolController@index');
        Route::get ('/rol/selectRol', 'RolController@selectRol');

        /*METODOS DE PAGO*/
        Route::get('/metodos', 'MetodoPagoController@index');
        Route::post('/metodos/store', 'MetodoPagoController@store');
        Route::put('/metodos/update', 'MetodoPagoController@update');
        Route::put('/metodos/desactivar', 'MetodoPagoController@desactivar');
        Route::put('/metodos/activar', 'MetodoPagoController@activar');
        Route::get ('/metodos/selectMetodo', 'MetodoPagoController@selectMetodo');

        /*PAGOS 
        Route::get('/pagos', 'PagosController@index');
        Route::get('/pagos/usuarios', 'PagosController@usuarios');
        Route::get('/pagos/metodos', 'PagosController@metodos');
        Route::post('/pagos/store', 'PagosController@store');
        Route::put('/pagos/update', 'PagosController@update');
        Route::put('/pagos/desactivar', 'PagosController@desactivar');
        Route::put('/pagos/activar', 'PagosController@activar');*/
      
        /*PROYECTOS*/
        Route::get('/proyectos', 'ProyectoController@index');
        Route::post('/proyectos/registrar', 'ProyectoController@store');
        Route::post('/proyectos/registrarCol', 'ProyectoController@storeCol');
        Route::put('/proyectos/actualizar', 'ProyectoController@update');
        Route::put('/proyectos/cancelar', 'ProyectoController@cancelar');
        Route::put('/proyectos/activar', 'ProyectoController@activar');

        /*HITOS*/
        Route::get('/hito', 'HitoController@index');
        Route::post('/hito/registrar', 'HitoController@store');
        Route::put('/hito/cancelar', 'HitoController@cancelar');
        Route::put('/hito/completar', 'HitoController@completar');

        /*COLABORADORES*/
        Route::get('/colaborador', 'ColaboradorController@index');
        Route::get('/colaboradorUsers', 'ColaboradorController@indexUsers');
        Route::post('/colaborador/registrar', 'ColaboradorController@store');
        Route::put('/colaborador/eliminar', 'ColaboradorController@eliminar');

        /*TAREAS*/
        Route::get('/tarea', 'TareaController@index');
        Route::get('/tareaAll', 'TareaController@indexAll');
        Route::post('/tarea/registrar', 'TareaController@store');
        Route::put('/tarea/actualizar', 'TareaController@update');
        Route::put('/tarea/cancelar', 'TareaController@cancelar');
        Route::put('/tarea/completar', 'TareaController@completar');
        Route::put('/tarea/pagar', 'TareaController@pagar');

        /*CARTERA*/
        Route::get('/cartera', 'CarteraController@index');
        Route::get('/carteraAuth', 'CarteraController@indexAuth');

        /*PAGOS*/
        Route::get('/pago','PagosController@index');
        Route::get('/pago/listarPdf','PagosController@listarPdf')->name('pagos.pdf');
    }); 

    //RUTAS PARA PROJECT MANAGER
    Route::group(['middleware'=>['PManager']],function(){

        /*PROYECTOS*/
        Route::get('/proyectosAuth', 'ProyectoController@indexAuth');
        Route::post('/proyectos/registrar', 'ProyectoController@store');
        Route::post('/proyectos/registrarCol', 'ProyectoController@storeCol');
        Route::put('/proyectos/actualizar', 'ProyectoController@update');
        Route::put('/proyectos/cancelar', 'ProyectoController@cancelar');
        Route::put('/proyectos/activar', 'ProyectoController@activar');

        /*HITOS*/
        Route::get('/hitoAuth', 'HitoController@indexAuth');
        Route::post('/hito/registrar', 'HitoController@store');
        Route::put('/hito/cancelar', 'HitoController@cancelar');
        Route::put('/hito/completar', 'HitoController@completar');

        /*COLABORADORES*/
        Route::get('/colaboradorAuthPM', 'ColaboradorController@indexAuthPM');
        Route::get('/colaboradorUsers', 'ColaboradorController@indexUsers');
        Route::post('/colaborador/registrar', 'ColaboradorController@store');
        Route::put('/colaborador/eliminar', 'ColaboradorController@eliminar');

        /*TAREAS*/
        Route::get('/tareaAllAuth', 'TareaController@indexAllAuth');
        Route::post('/tarea/registrar', 'TareaController@store');
        Route::put('/tarea/actualizar', 'TareaController@update');
        Route::put('/tarea/cancelar', 'TareaController@cancelar');
        Route::put('/tarea/pagar', 'TareaController@pagar');

        /*CARTERA*/
        Route::get('/carteraAuth', 'CarteraController@indexAuth');

        /*PAGOS*/
        Route::get('/pagoAuth','PagosController@indexAuth');


        Route::get ('/metodos/selectMetodo', 'MetodoPagoController@selectMetodo');
    });

    //RUTAS PARA DESARROLLADOR
    Route::group(['middleware'=>['Desarrollador']],function(){

        /*TAREAS*/
        Route::get('/tareaAuth', 'TareaController@indexAuth');
        Route::put('/tarea/completar', 'TareaController@completar');

        /*PROYECTOS*/
        Route::get('/proyectos', 'ProyectoController@index');
        Route::post('/proyectos/registrar', 'ProyectoController@store');
        Route::put('/proyectos/actualizar', 'ProyectoController@update');
        Route::put('/proyectos/cancelar', 'ProyectoController@cancelar');
        Route::put('/proyectos/activar', 'ProyectoController@activar');

        /*COLABORADORES*/
        Route::get('/colaboradorAuth', 'ColaboradorController@indexAuth');

        /*PAGOS*/
        Route::get('/pagoAuth','PagosController@indexAuth');
    });

    //RUTAS PARA PROJECT CLIENTE
    Route::group(['middleware'=>['Cliente']],function(){
        
        /*PROYECTOS*/
        Route::get('/proyectosAuthC', 'ProyectoController@indexAuthC');
        Route::put('/proyectos/pagarP', 'ProyectoController@pagarP');
        
        Route::post('/reportes/registrar', 'ReportesController@store');
        Route::get('/reportes', 'ReportesController@index');
        Route::get('/reportesm', 'ReportesController@indexm');
        Route::put('/reportes/atender', 'ReportesController@atender');

        /*PAGOS*/
        Route::get('/pagoAuth','PagosController@indexAuth');


        Route::get ('/metodos/selectMetodo', 'MetodoPagoController@selectMetodo');

        /*CARTERA*/
        Route::get('/carteraAuth', 'CarteraController@indexAuth');
    });
});    
/*-----------------------
*/




//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
