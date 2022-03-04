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

Route::get('/administracion/modelo/getListarModelos', 'Administracion\ModeloProductController@store');
Route::get('/administracion/modelo/listByIdModelo', 'Administracion\ModeloProductController@listByIdModelo');
Route::post('/administracion/modelo/setRegistrarModelo', 'Administracion\ModeloProductController@create');
Route::post('/administracion/modelo/setEditarModelo', 'Administracion\ModeloProductController@edit');

////////////Familia
Route::get('/administracion/familia/getListarFamilias', 'Administracion\FamiliaController@store');
Route::post('/administracion/familia/setRegistrarfamilias', 'Administracion\FamiliaController@create');
Route::get('/administracion/familia/listByIdFamilia', 'Administracion\FamiliaController@listByIdFamilia');
Route::post('/administracion/familia/setEditarfamilias', 'Administracion\FamiliaController@edit');
Route::post('/operacion/familia/export', 'Administracion\FamiliaController@export');
///////////////////////////////////////////////////////////////////////////////////////////////

/////////// Marcas
Route::get('/administracion/marcas/getListarMarcas', 'Administracion\MarcaController@store');
Route::post('/administracion/marcas/setRegistrarMarcas', 'Administracion\MarcaController@create');
Route::get('/administracion/marcas/listByIdMarcas', 'Administracion\MarcaController@listByIdMarcas');
Route::post('/administracion/marcas/setEditarMarca', 'Administracion\MarcaController@edit');
Route::post('/operacion/marcas/export', 'Administracion\MarcaController@export');
////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////// Material
Route::get('/administracion/material/getListarMaterial', 'Administracion\MaterialController@store');
Route::post('/administracion/material/setRegistrarMaterial', 'Administracion\MaterialController@create');
Route::get('/administracion/material/listByIdMaterial', 'Administracion\MaterialController@listByIdMaterial');
Route::post('/administracion/material/setEditarMaterial', 'Administracion\MaterialController@edit');
Route::post('/operacion/material/export', 'Administracion\MaterialController@export');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////// SubFamilia
Route::get('/administracion/subfamilia/getListarSubfamilia', 'Administracion\SubfamiliaController@store');
Route::post('/administracion/subfamilia/setRegistrarSubfamilia', 'Administracion\SubfamiliaController@create');
Route::get('/administracion/subfamilia/listByIdSubfamilia', 'Administracion\SubfamiliaController@listByIdSubfamilia');
Route::post('/administracion/subfamilia/setEditarSubfamilia', 'Administracion\SubfamiliaController@edit');
Route::get('/administracion/subfamilia/listSubFamiliabyFamilia', 'Administracion\SubfamiliaController@listSubFamiliabyFamilia');
Route::post('/operacion/subfamilia/export', 'Administracion\SubfamiliaController@export');

/////////// Modelo/Tipo
Route::get('/administracion/modelotipo/getListarModelotipo', 'Administracion\ModelotipoController@store');
Route::post('/administracion/modelotipo/setRegistrarModelotipo', 'Administracion\ModelotipoController@create');
Route::get('/administracion/modelotipo/listByIdModelotipo', 'Administracion\ModelotipoController@listByIdModelotipo');
Route::post('/administracion/modelotipo/setEditarModelotipo', 'Administracion\ModelotipoController@edit');
Route::post('/operacion/modelotipo/export', 'Administracion\ModelotipoController@export');

/////////// Estado del Producto
Route::get('/administracion/estadoprod/getListarEstadoprod', 'Administracion\EstadoProdController@index');

//////////  Producto
Route::get('/administracion/producto/getListarProducto', 'Administracion\ProductoController@index');
Route::post('/administracion/producto/setRegistrarProducto', 'Administracion\ProductoController@create');
Route::get('/administracion/producto/getListarProductoById', 'Administracion\ProductoController@ListarProductoById');
Route::get('/administracion/producto/ListarProductoByIdKardex', 'Administracion\ProductoController@ListarProductoByIdKardex');
Route::post('/administracion/producto/setEditarProductos', 'Administracion\ProductoController@edit');
Route::post('/operacion/producto/export', 'Administracion\ProductoController@export');
Route::get('/administracion/producto/BuscaCodigoProducto', 'Administracion\ProductoController@BuscaCodigoProducto');

////////  Proveedor
Route::get('/administracion/proveedor/getListarProveedor', 'Administracion\ProveedorController@index');
Route::post('/administracion/proveedor/setRegistrarProveedor', 'Administracion\ProveedorController@create');
Route::get('/administracion/proveedor/getListarProveedorById', 'Administracion\ProveedorController@ListarProveedorById');
Route::post('/administracion/proveedor/setEditarProveedor', 'Administracion\ProveedorController@edit');
Route::get('/administracion/KardexDetalle/listProveedor', 'Administracion\KardexDetalleController@listProveedor');
Route::get('/administracion/proveedor/ListarProveedorByRuc', 'Administracion\ProveedorController@ListarProveedorByRuc');
Route::get('/administracion/proveedor/ListProveedor', 'Administracion\ProveedorController@ListProveedor');

/////  Kardex
Route::get('/administracion/kardex/getListarKardexByProduct', 'Administracion\KardexController@index');
Route::post('/administracion/kardex/setRegistrarKardex', 'Administracion\KardexController@create');
Route::get('/administracion/kardex/getListarKardex', 'Administracion\KardexController@store');
Route::post('/administracion/kardex/BuscaStockxProducto', 'Administracion\KardexController@BuscaStockxProducto');

////// DetalleKardex
Route::get('/administracion/KardexDetalle/listKardexById', 'Administracion\KardexDetalleController@listKardexById');
Route::post('/administracion/KardexDetalle/setRegistrarDetalleKardex', 'Administracion\KardexDetalleController@create');
Route::post('/administracion/KardexDetalle/KardexReporteData', 'Administracion\KardexDetalleController@KardexReporteData');
Route::get('/administracion/KardexDetalle/getListarXKardex', 'Administracion\KardexDetalleController@getListarXKardex');
Route::get('/administracion/KardexDetalle/getListarEditXKardex', 'Administracion\KardexDetalleController@getListarEditXKardex');
Route::post('/administracion/KardexDetalle/setEditarDetalleKardex', 'Administracion\KardexDetalleController@edit');

///// Movimiento
Route::get('/administracion/KardexDetalle/listMovimiento', 'Administracion\KardexDetalleController@listMovimiento');

/////  Motivo
Route::get('/administracion/KardexDetalle/listMotivo', 'Administracion\KardexDetalleController@listMotivo');

/////  Unidad de Medida
Route::get('/administracion/KardexDetalle/listUnidMed', 'Administracion\KardexDetalleController@listUnidMed');

//// Usuario
Route::get('/administracion/usuario/listUsuario', 'Administracion\UsuarioController@index');
Route::post('/administracion/usuario/setRegistrarUsuario', 'Administracion\UsuarioController@create');
Route::get('/administracion/usuario/listUsuarioById', 'Administracion\UsuarioController@listUsuarioById');
Route::post('/administracion/usuario/setEditarUsuario', 'Administracion\UsuarioController@edit');
Route::post('/administracion/usuario/setDesactivarUsuario', 'Administracion\UsuarioController@destroy');
Route::get('/administracion/usuario/getRolByUsuario', 'Administracion\UsuarioController@getRolByUsuario');
Route::get('/administracion/usuario/getListarPermisosByRol', 'Administracion\UsuarioController@ListarPermisosByRol');
Route::get('/administracion/usuario/getListarRolPermisosByUsuario', 'Administracion\UsuarioController@ListarRolPermisosByUsuario');
Route::get('/administracion/usuario/getListarUsusarios', 'Administracion\UsuarioController@getListarUsusarios');
Route::get('/administracion/usuario/getListarUsusariosbyId', 'Administracion\UsuarioController@getListarUsusariosbyId');
Route::get('/administracion/usuario/getListarVendedores', 'Administracion\UsuarioController@getListarVendedores');
Route::get('/administracion/usuario/getListarGradoAcad', 'Administracion\UsuarioController@getListarGradoAcad');




/// Roles
Route::get('/administracion/rol/listRoles', 'Administracion\RolController@index');
Route::get('/administracion/rol/listRolByUSer', 'Administracion\RolController@listRolByUSer');
Route::get('/administracion/rol/getListarPermisosByRol', 'Administracion\RolController@getListarPermisosByRol');
Route::post('/administracion/rol/setRegistrarRolPermiso', 'Administracion\RolController@create');
Route::post('/administracion/rol/setEditarRolPermiso', 'Administracion\RolController@edit');

//// Permisos
Route::get('/administracion/permiso/listPermisos', 'Administracion\PermisoController@index');
Route::get('/administracion/permiso/listPermisosById', 'Administracion\PermisoController@listPermisosById');
Route::post('/administracion/permiso/setRegistrarPermiso', 'Administracion\PermisoController@create');
Route::post('/administracion/permiso/setEditarPermiso', 'Administracion\PermisoController@edit');
Route::get('/administracion/permiso/listUsuarioById', 'Administracion\PermisoController@listUsuarioById');
Route::post('/administracion/permiso/RegistrarPermisosByUsuario', 'Administracion\PermisoController@RegistrarPermisosByUsuario');

//// Login
Route::post('/authenticate/login', 'Auth\LoginController@create');
Route::post('/authenticate/logout', 'Auth\LoginController@logout');

/////  Reportes
Route::post('/administracion/reportes/movimientoxProducto', 'Administracion\ReporteMovimientoxProductoController@MovimientoxPedido');

///  Almacen
Route::get('/administracion/almacen/listAlmacen', 'Administracion\AlmacenController@index');

//Ventas
Route::get('/administracion/ventas/getListarStockProds', 'Administracion\VentaController@store');

//Clientes
Route::post('/administracion/cliente/createClientes', 'Administracion\ClienteController@create');
Route::get('/administracion/cliente/store', 'Administracion\ClienteController@store');
Route::get('/administracion/cliente/listClientesById', 'Administracion\ClienteController@listPermisosById');
Route::post('/administracion/cliente/EditClientes', 'Administracion\ClienteController@edit');
Route::get('/administracion/cliente/getListarCliente', 'Administracion\ClienteController@getListarCliente');
Route::get('/administracion/cliente/listGetClienteVendedor', 'Administracion\ClienteController@listGetClienteVendedor');
Route::get('/administracion/cliente/getListarAllCliente', 'Administracion\ClienteController@getListarAllCliente');
Route::post('/operacion/Cliente/export', 'Administracion\ClienteController@export');
Route::get('/administracion/cliente/listClientAll', 'Administracion\ClienteController@listClientAll');
Route::post('/administracion/cliente/consultaRuc', 'Administracion\ClienteController@consultaRuc');
Route::post('/administracion/cliente/consultaDNI', 'Administracion\ClienteController@consultaDNI');




//DetalleCotizacion
Route::get('/administracion/detallecotizancion/listProdByName', 'Administracion\DetalleCotizacionController@listProdByName');
Route::get('/administracion/detallecotizancion/listDetCotizacionBy', 'Administracion\DetalleCotizacionController@listDetCotizacionBy');
Route::post('/administracion/detallecotizancion/DatosItemDetalleCotixItem', 'Administracion\DetalleCotizacionController@DatosItemDetalleCotixItem');
Route::post('/administracion/detallecotizancion/EditDatosItem', 'Administracion\DetalleCotizacionController@EditDatosItem');






/// Estado de Cotizacion
Route::get('/administracion/detallecotizancion/listEstadoCotizacion', 'Administracion\DetalleCotizacionController@listEstadoCotizacion');
Route::post('/administracion/cotizacion/editEstadoCotizacion', 'Administracion\CotizacionController@editEstadoCotizacion');


//Cotizacion
Route::post('/administracion/cotizacion/addTempCotizacion', 'Administracion\CotizacionController@addTempCotizacion');
Route::get('/administracion/cotizacion/ListCotizacionesby', 'Administracion\CotizacionController@ListCotizacionesby');
Route::get('/administracion/cotizacion/ListCotizacionbyId', 'Administracion\CotizacionController@ListCotizacionbyId');
Route::post('/administracion/cotizacion/addTempEditCotizacion', 'Administracion\CotizacionController@addTempEditCotizacion');
Route::post('/administracion/cotizacion/EditCotizacion', 'Administracion\CotizacionController@edit');
Route::post('/administracion/cotizacion/dellTempEditCotizacion', 'Administracion\CotizacionController@dellTempEditCotizacion');
Route::get('/administracion/cotizacion/listCotizacionList', 'Administracion\CotizacionController@listCotizacionList');
Route::get('/administracion/cotizacion/listCotizacionListByDate', 'Administracion\CotizacionController@listCotizacionListByDate');
Route::get('/administracion/cotizacion/listCotizacionListByVendedor', 'Administracion\CotizacionController@listCotizacionListByVendedor');
Route::post('/administracion/cotizacion/CantidadDiasCotizacion', 'Administracion\CotizacionController@CantidadDiasCotizacion');
Route::post('/administracion/cotizacion/updateFechaCotizacion', 'Administracion\CotizacionController@updateFechaCotizacion');
Route::get('/administracion/cotizacion/SumaTotalCotizacion', 'Administracion\CotizacionController@SumaTotalCotizacion');
Route::get('/administracion/cotizacion/buscaEstado', 'Administracion\CotizacionController@buscaEstado');
Route::get('/administracion/cotizacion/ReporteVentasFechaEstado', 'Administracion\CotizacionController@ReporteVentasFechaEstado');








/// Exportados en formato Excel
Route::post('/operacion/cotizacionProduct/exportProduct', 'Administracion\CotizacionController@exportProductCotizacion');
Route::post('/operacion/cotizacionProduct/getExcelCotizacionFecha', 'Administracion\CotizacionController@exportFechaCotizacion');
Route::post('/operacion/cotizacionProduct/exportVendedor', 'Administracion\CotizacionController@exportVendedor');
Route::post('/operacion/cotizacionProduct/exportReporteVentasFechaEstado', 'Administracion\CotizacionController@exportReporteVentasFechaEstado');




///////////////////////////////////////////////////




/// COTIZACION A PDF
Route::get('/administracion/cotizacion/CotizacionCabecera', 'Administracion\CotizacionController@CotizacionCabecera');
Route::post('/administracion/cotizacion/CotizacionPdf', 'Administracion\CotizacionController@CotizacionPdf');

//Tipo de pago
Route::get('/administracion/cotizacion/listTipoPago', 'Administracion\CotizacionController@listTipoPago');

//Listado de dias de Pago
Route::get('/administracion/pago/index', 'Administracion\PagoController@index');

//TempCotizacion
Route::get('/administracion/tempcotizacion/ListtempCotizacion', 'Administracion\CotizacionController@ListtempCotizacion');
Route::post('/administracion/tempcotizacion/eliminarTempitemCoti', 'Administracion\CotizacionController@eliminarTempitemCoti');
//Elimina por boton eliminar de listado de items
Route::post('/administracion/tempcotizacion/reorder', 'Administracion\CotizacionController@reorder');
Route::post('/administracion/tempcotizacion/grabaCotizacion', 'Administracion\CotizacionController@create');


//Homologacion
Route::get('/administracion/tempcotizacion/getListarHomologacion', 'Administracion\HomologadoController@index');

/// Tipo de Articulo
Route::post('/administracion/tipo/store', 'Administracion\TipoController@Store');
Route::get('/administracion/tipo/index', 'Administracion\TipoController@index');
Route::post('/administracion/tipo/edit', 'Administracion\TipoController@edit');
Route::get('/administracion/tipo/create', 'Administracion\TipoController@create');

/// Categoria de Articulos
Route::get('/administracion/catart/index', 'Administracion\CatArticuloController@index');


///  Articulo de Tienda
Route::get('/administracion/articulo/index', 'Administracion\ArticuloController@index');
Route::post('/administracion/setRegistrarArchivo', 'Administracion\FilesController@setRegistrarArchivo');
Route::post('/administracion/articulo/store', 'Administracion\ArticuloController@store');
Route::get('/administracion/articulo/listArticulosById', 'Administracion\ArticuloController@listArticulosById');

/// Parte de Ingreso
Route::post('/administracion/parte_ingreso/create', 'Administracion\ParteIngresoController@addPIngreso');
Route::get('/administracion/parte_ingreso/ListtempParteIngreso', 'Administracion\ParteIngresoController@ListtempParteIngreso');
Route::post('/administracion/parte_ingreso/setGrabarPIngreso', 'Administracion\ParteIngresoController@setGrabaPIngreso');
Route::post('/administracion/parte_ingreso/eliminarTempitemPIngreso', 'Administracion\ParteIngresoController@eliminarTempitemPIngreso');
Route::post('/administracion/parte_ingreso/setGrabaPIngreso', 'Administracion\ParteIngresoController@setGrabaPIngreso');
Route::get('/administracion/parte_ingreso/ListParteIngreso', 'Administracion\ParteIngresoController@ListParteIngreso');
Route::get('/administracion/parte_ingreso/ListParteIngresoxNroOrden', 'Administracion\ParteIngresoController@ListParteIngresoxNroOrden');
Route::post('/administracion/parte_ingreso/ProveedorFechaPdf', 'Administracion\ParteIngresoController@ProveedorFechaPdf');
Route::post('/administracion/parte_ingreso/ProveedorOrdenCompraPdf', 'Administracion\ParteIngresoController@ProveedorOrdenCompraPdf');

/// Garantia
Route::get('/administracion/garantia/index', 'Administracion\GarantiaController@index');

/// Orden de Compra
Route::post('/administracion/ordenCompra/addOrden', 'Administracion\OrdencompraController@addOrden');
Route::get('/administracion/ordenCompra/ListtempOrden', 'Administracion\OrdencompraController@ListtempOrden');
Route::post('/administracion/ordenCompra/eliminarTemporder', 'Administracion\OrdencompraController@eliminarTemporder');
Route::post('/administracion/ordenCompra/setGrabarOrderCompra', 'Administracion\OrdencompraController@create');
Route::get('/administracion/ordenCompra/ListtempOrden', 'Administracion\OrdencompraController@ListtempOrden');
Route::get('/administracion/ordenCompra/ListXProduct', 'Administracion\OrdencompraController@ListXProduct');
Route::get('/administracion/ordenCompra/ListXProveedor', 'Administracion\OrdencompraController@ListXProveedor');
Route::post('/administracion/ordenCompra/setGenerarOrderPedidoPdf', 'Administracion\OrdencompraController@setGenerarOrderPedidoPdf');
Route::post('/administracion/ordenCompra/ListarDatosOrdenCompraXId', 'Administracion\OrdencompraController@ListarDatosOrdenCompraXId');
Route::post('/administracion/ordenCompra/setDarBajaOrderCompra', 'Administracion\OrdencompraController@setDarBajaOrderCompra');
Route::post('/administracion/ordenCompra/CargaDatosOrdenCompra', 'Administracion\OrdencompraController@CargaDatosOrdenCompra');



/// Detalle de Orden de Compra
Route::get('/administracion/DetalleordenCompra/view', 'Administracion\DetalleOrdenCompraController@view');
Route::get('/administracion/DetalleordenCompra/viewModal', 'Administracion\DetalleOrdenCompraController@viewModal');
Route::post('/administracion/DetalleordenCompra/CambiarEstadoDetalleOC', 'Administracion\DetalleOrdenCompraController@CambiarEstadoDetalleOC');
Route::post('/administracion/DetalleordenCompra/setMandarValorDetalleParteIngresoXId', 'Administracion\DetalleOrdenCompraController@setMandarValorDetalleParteIngresoXId');
Route::post('/administracion/DetalleordenCompra/setEditarCantidadParteIngre', 'Administracion\DetalleOrdenCompraController@setEditarCantidadParteIngre');
Route::post('/administracion/DetalleordenCompra/setEditarCantidadParteIngre', 'Administracion\DetalleOrdenCompraController@setEditarCantidadParteIngre');
Route::post('/administracion/DetalleordenCompra/addOrdenEdit', 'Administracion\DetalleOrdenCompraController@addOrdenEdit');
Route::post('/administracion/DetalleordenCompra/DeleteItemDetalleOrdenCompra', 'Administracion\DetalleOrdenCompraController@DeleteItemDetalleOrdenCompra');
Route::post('/administracion/DetalleordenCompra/CargaDetalleOrdenCompraEdit', 'Administracion\DetalleOrdenCompraController@CargaDetalleOrdenCompraEdit');
Route::post('/administracion/DetalleordenCompra/ModalSaveItemsDetalleOC', 'Administracion\DetalleOrdenCompraController@ModalSaveItemsDetalleOC');




/// Tipo de Cambio
Route::get('/administracion/ordenCompra/TipoCambio', 'Administracion\OrdencompraController@TipoCambio');

////  Parte de Salida
Route::post('/administracion/parte_salida/GrabarPSalida', 'Administracion\ParteSalidaController@GrabarPSalida');
Route::post('/administracion/parte_salida/addTempPSalida', 'Administracion\ParteSalidaController@AddTempParteSalida');
Route::post('/administracion/parte_salida/reorder', 'Administracion\ParteSalidaController@reorder');
Route::get('/administracion/parte_salida/ListtempParteSalida', 'Administracion\ParteSalidaController@ListtempParteSalida');
Route::post('/administracion/parte_salida/eliminarTempitemPSalida', 'Administracion\ParteSalidaController@eliminarTempitemPSalida');
Route::get('/administracion/parte_salida/getListarPartesalidaFecha', 'Administracion\ParteSalidaController@getListarPartesalidaFecha');
Route::get('/administracion/parte_salida/getListarPartesalidaCliente', 'Administracion\ParteSalidaController@getListarPartesalidaCliente');
Route::post('/administracion/parte_salida/reporteParteSalidaPdf', 'Administracion\ParteSalidaController@reporteParteSalidaPdf');



////  Papeleta de Salida
Route::get('/administracion/PapeletaSalida/Motivo', 'Administracion\PapeletaSalidaController@Motivo');
Route::post('/administracion/papeletasalida/create', 'Administracion\PapeletaSalidaController@create');
Route::get('/administracion/papeletasalida/listPapeleByVendedor', 'Administracion\PapeletaSalidaController@listPapeleByVendedor');
Route::get('/administracion/papeletasalida/ListMotivos', 'Administracion\PapeletaSalidaController@ListMotivos');
Route::get('/administracion/papeletaSalida/ListPapeletaSalidabyId', 'Administracion\PapeletaSalidaController@ListPapeletaSalidabyId');
Route::post('/administracion/papeletasalida/PapeletasalidaPdf', 'Administracion\PapeletaSalidaController@PapeletasalidaPdf');
Route::post('/administracion/papeletasalida/setDarBajaPapeletaSalida', 'Administracion\PapeletaSalidaController@setDarBajaPapeletaSalida');
Route::post('/administracion/papeletasalida/setAprobarPapeletaSalida', 'Administracion\PapeletaSalidaController@setAprobarPapeletaSalida');
Route::get('/administracion/papeletasalida/listPapeleByCliente', 'Administracion\PapeletaSalidaController@listPapeleByCliente');
Route::get('/administracion/papeletasalida/getListarCliente', 'Administracion\PapeletaSalidaController@getListarCliente');
Route::post('/administracion/papeletasalida/AddTempClient', 'Administracion\PapeletaSalidaController@AddTempClient');
Route::post('/administracion/papeletasalida/CleanTempClient', 'Administracion\PapeletaSalidaController@CleanTempClient');
Route::post('/administracion/papeletasalida/EliminarClientTemp', 'Administracion\PapeletaSalidaController@EliminarClientTemp');




///// Cliente Papeleta Salida

Route::get('/administracion/ClientePapeletaSalida/BuscaClientePapeletaS', 'Administracion\ClientePapeletaSalidaController@BuscaClientePapeletaS');


/// Orden de Servicio

Route::post('/administracion/OrdenServicio/create', 'Administracion\OrdenServicioController@create');
Route::get('/administracion/ordenServicio/ListXProveedor', 'Administracion\OrdenServicioController@ListXProveedor');
Route::post('/administracion/ordenServicio/setGenerarOrderPedidoPdf', 'Administracion\OrdenServicioController@setGenerarOrderPedidoPdf');
Route::post('/administracion/ordenServicio/setDarBajaOrderServicio', 'Administracion\OrdenServicioController@setDarBajaOrderServicio');
Route::post('/administracion/ordenServicio/CargaDatosOrdenServicio', 'Administracion\OrdenServicioController@CargaDatosOrdenServicio');
Route::get('/administracion/ordenServicio/ListXProduct', 'Administracion\OrdenServicioController@ListXProduct');






//Detalle Orden de Servicio

Route::get('/administracion/DetalleOrdenservicio/view', 'Administracion\DetalleOrdenServicioController@view');
Route::post('/administracion/DetalleOrdenservicio/addOrdenEdit', 'Administracion\DetalleOrdenServicioController@addOrdenEdit');
Route::post('/administracion/DetalleOrdenservicio/CargaDetalleOrdenServicioEdit', 'Administracion\DetalleOrdenServicioController@CargaDetalleOrdenServicioEdit');
Route::post('/administracion/DetalleOrdenservicio/ModalSaveItemsDetalleOS', 'Administracion\DetalleOrdenServicioController@ModalSaveItemsDetalleOS');
Route::post('/administracion/DetalleOrdenservicio/DeleteItemDetalleOrdenServicio', 'Administracion\DetalleOrdenServicioController@DeleteItemDetalleOrdenServicio');
Route::get('/administracion/DetalleOrdenservicio/viewDetalleOrdenServicio', 'Administracion\DetalleOrdenServicioController@viewDetalleOrdenServicio');























Route::get('/{optional?}', function () {
    return view('welcome');
})->name('basepath')
    ->where('optional', '.*');
