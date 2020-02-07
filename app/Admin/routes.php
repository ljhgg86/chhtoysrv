<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('sections', SectionController::class);
    $router->resource('categories', CategoryController::class);
    $router->get('/types/showtypes', 'TypeController@showTypes');
    $router->resource('types', TypeController::class);
    $router->get('/yellowpages/{typeid}/infomationsList', 'YellowpageController@infomationsList');
    $router->resource('infomations', InfomationController::class);
    $router->resource('producttypes', ProducttypeController::class);
    //$router->get('/yellowpages/{typeid}/infomationsList/create', 'YellowpageController@create');
    $router->resource('yellowpages', YellowpageController::class);
    $router->resource('motivations', MotivationController::class);
});
