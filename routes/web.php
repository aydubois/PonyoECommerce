<?php

Route::get('/', 'HomepageController@index')->name('home_landing');


Route::get('/categories', 'CategoryController@listing')->name('category.listing');
Route::get('/category/{id?}', 'CategoryController@index')->name('category.index');
Route::get('/allproducts', 'ProductsController@index')->name('products.index'); //liste des produits

Route::get('article/{id?}', 'ProductsController@show')->name('products.show');

Route::get('/cart', 'CartController@index')->name('cart.index'); //affichage du panier
Route::post('/cart', 'CartController@store')->name('cart.store'); //ajout d'un produit
Route::patch('/cart', 'CartController@update')->name('cart.update'); //mise à jour d'un produit
Route::delete('/cart', 'CartController@delete')->name('cart.delete'); //suppression d'un produit

Route::get('/checkoutform', 'CheckoutController@index')->name('checkout.index'); //facture
Route::post('/checkoutpaiement', 'CheckoutController@paie')->name('checkout.paie');//paiement avec stripe
Route::get('/checkout/recap/{id?}', 'CheckoutController@recap')->name('checkout.recap');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store'); //facture


Auth::routes();
Route::get('/account', 'AccountController@index')->name('account.index')->middleware('auth');
Route::patch('/account', 'AccountController@update')->name('account.update')->middleware('auth');
Route::get('/account/{id?}/orders', 'AccountController@orders')->name('account.orders')->middleware('auth');
Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout')->middleware('auth');
