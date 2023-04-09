<?php

use App\Controller\Pages;
use App\Controller\Http\Router;

/**
 * CRUD User
 */
Router::get('/user/createTable', [Pages\UserController::class, 'createTable']);
Router::get('/user', [Pages\UserController::class, 'getAll']);
Router::get('/user/{id}', [Pages\UserController::class, 'get']);
Router::post('/user', [Pages\UserController::class, 'create']);
Router::put('/user/{id}', [Pages\UserController::class, 'update']);
Router::delete('/user/{id}', [Pages\UserController::class, 'delete']);

/**
 * CRUD Category
 */
Router::get('/category/createTable', [Pages\CategoryController::class, 'createTable']);
Router::get('/category', [Pages\CategoryController::class, 'getAll']);
Router::get('/category/{id}', [Pages\CategoryController::class, 'get']);
Router::post('/category', [Pages\CategoryController::class, 'create']);
Router::put('/category/{id}', [Pages\CategoryController::class, 'update']);
Router::delete('/category/{id}', [Pages\CategoryController::class, 'delete']);


/**
 * CRUD Product
 */
Router::get('/product/createTable', [Pages\ProductController::class, 'createTable']);
Router::get('/product', [Pages\ProductController::class, 'getAll']);
Router::get('/product/{id}', [Pages\ProductController::class, 'get']);
Router::post('/product', [Pages\ProductController::class, 'create']);
Router::put('/product/{id}', [Pages\ProductController::class, 'update']);
Router::delete('/product/{id}', [Pages\ProductController::class, 'delete']);
