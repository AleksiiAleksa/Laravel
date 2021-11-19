<?php
Auth::routes();

Route::get("/add", "IndexController@New");
Route::post('/add','IndexController@AddNews')->name('AddNews');

Route::get('/', "IndexController@Index")->name('index');
Route::get('/search', "IndexController@Search")->name('search');
Route::get('/search/{number}', "IndexController@Search2")->name('search2');

Route::get('/description/{id}/{auth}', "IndexController@Description")->name('description');

Route::get('/cart/{status}', 'IndexController@ShowCart')->name('cart');
Route::post('/cart/{auth}', 'IndexController@Buying')->name('buying');
Route::post('/description/{id}/{auth}', 'IndexController@ChangeCart')->name('changeCart');
Route::post('/cart/{id}/{auth}', 'IndexController@ChangeCartIn')->name('changeCartIn');

Route::get('/category/{number}', "IndexController@ShowCategory");
Route::get('/delete/{id}','IndexController@DeleteNews')->name('Delete');



//Route::get('/home', 'Controller@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
