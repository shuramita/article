<?php

Route::middleware('web')
    ->namespace('Shuramita\Article\Controllers')
    ->group(function()
    {
        Route::group(['prefix' => 'admin','middleware' => ['auth','admin']], function () {
            Route::get('article',['as'=>'admin_list_articles','uses'=>'ArticleController@index']);
            Route::get('article/create',['as'=>'admin_create_article','uses'=>'ArticleController@create']);
            Route::get('article/edit/{id}',['as'=>'admin_edit_article','uses'=>'ArticleController@edit']);
        });
        Route::group(['prefix' => 'admin','middleware' => ['auth','admin']], function () {
            Route::get('category',['as'=>'admin_list_categories','uses'=>'CategoryController@index']);
            Route::get('category/create',['as'=>'admin_create_category','uses'=>'CategoryController@create']);
            Route::get('category/edit/{id}',['as'=>'admin_edit_category','uses'=>'CategoryController@edit']);
        });
    });
Route::middleware(['auth:api'])
    ->namespace('Shuramita\Article\Controllers\API')
    ->prefix('api/article')
    ->group(function () {
    Route::post('create', 'ArticleController@create')->name('api_create_new_article');
    Route::post('update', 'ArticleController@update')->name('api_update_article');
    Route::post('delete/{id}', 'ArticleController@delete')->name('api_delete_article');
});
Route::middleware(['auth:api','admin'])
    ->namespace('Shuramita\Article\Controllers\API')
    ->prefix('api/category')
    ->group(function () {
        Route::post('create', 'CategoryController@create')->name('api_create_new_category');
        Route::post('update', 'CategoryController@update')->name('api_update_category');
        Route::post('delete/{id}', 'CategoryController@delete')->name('api_delete_category');
});
