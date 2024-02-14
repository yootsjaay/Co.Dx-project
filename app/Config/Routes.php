<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('admin', function ($routes) {

    $routes->resource('empresas', [
        'filter' => 'permission:empresas-permisos',
        'controller' => 'EmpresasController',
        'except' => 'show'
    ]);

    $routes->post('empresas/save', 'EmpresasController::save');
    $routes->post('empresas/obtenerEmpresa', 'EmpresasController::obtenerEmpresa');
    $routes = service('routes');
   
    $routes->resource('emailSettings', [
        'filter' => 'permission:email-permiso',
        'controller' => 'SettingsMailController',
    ]);
    
    $routes->post('mailSettings/save', 'SettingsMailController::guardar');
    
    //Para futuros envios
    //$routes->get('mailSettings/sendMail/(:any)', 'SettingsMailController::sendMailPDF/$1');



    $routes->resource('categorias', [
        'filter' => 'permission:categorias-permission',
        'controller' => 'categoriasController',
        'except' => 'show'
    ]);
$routes->post('categorias/save', 'CategoriasController::save');
$routes->post('categorias/getCategorias', 'CategoriasController::getCategorias');

    $routes->get('generateCRUD/(:any)', 'AutoCrudController::index/$1');

    $routes->resource('custumers', [
        'filter' => 'permission:custumers-permission',
        'controller' => 'custumersController',
        'except' => 'show'
    ]);
    $routes->post('custumers/save' , 'CustumersController::save');
    $routes->post('custumers/getCustumers', 'CustumersController::getCustumers');



    $routes->resource('peticionesdescargamasiva', [
        'filter' => 'permission:peticionesdescargamasiva-permission',
        'controller' => 'peticionesdescargamasivaController',
        'except' => 'show'
    ]);

    $routes->post('peticionesdescargamasiva/save', 'PeticionesdescargamasivaController::save');
    $routes->post('peticionesdescargamasiva/getPeticionesdescargamasiva', 'PeticionesdescargamasivaController::getPeticionesdescargamasiva');










    
    $routes->resource('products', [
        'filter' => 'permission:products-permission',
        'controller' => 'productsController',
        'except' => 'show'
    ]);
$routes->post('products/save', 'ProductsController::save');
$routes->post('products/getProducts', 'ProductsController::getProducts');

    $routes->post('products/save', 'ProductsController::save');
    $routes->post('products/getProducts', 'ProductsController::getProducts');
    $routes->get('products/getAllProducts/(:any)', 'ProductsController::getAllProducts/$1');

    $routes->get('products/getAllProductsInventory/(:any)/(:any)/(:any)', 'ProductsController::getAllProductsInventory/$1/$2/$3');

    $routes->post('products/getUnidadSATAjax', 'ProductsController::getUnidadSATAjax');
    $routes->post('products/getProductosSATAjax', 'ProductsController::getProductosSATAjax');

    $routes->post('products/getProductsAjax', 'ProductsController::getProductsAjaxSelect2');
});
