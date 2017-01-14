<?php

Route::group(array('module' => 'MenuManager', 'namespace' => 'Asterisk\Modules\MenuManager\Controllers'), function() {


    //Ajax
    Route::get('admin/menus/matching/json/{tag}', 'MenuManagerController@menusMatchingJSON');

    //Search
    Route::get('admin/menus/search/{tag}', 'MenuManagerController@search');

    /* Trashed Menu Routes*/
    Route::get('admin/menus/trashed', 'MenuManagerController@trashed');
    Route::get('admin/menu/{menu}/restore', 'MenuManagerController@restore');
    Route::delete('admin/menu/{menu}/remove-trashed', 'MenuManagerController@removeTrashed');

    /* Item Routes*/
    Route::get('admin/menu/{menu}/create', 'MenuManagerController@itemCreate');
    Route::post('admin/menu/{id}', 'MenuManagerController@itemStore');
    Route::get('admin/menu/{menu}/{item}/edit', 'MenuManagerController@itemEdit');
    Route::patch('admin/menu/{menu}/{item}', 'MenuManagerController@itemUpdate');
    Route::delete('admin/menu/{menu}/{item}', 'MenuManagerController@itemDestroy');

    /* Menu Manager Routes */
    Route::resource('admin/menu', 'MenuManagerController');
    Route::get('admin/menus', 'MenuManagerController@index');
    
});	