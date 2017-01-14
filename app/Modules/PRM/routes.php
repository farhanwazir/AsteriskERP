<?php
Route::group(array('module' => 'PRM', 'namespace' => 'Asterisk\Modules\PRM\Controllers\Peoples'), function()
{

    //Ajax
    Route::get('prm/people/matching/json/{tag}', 'PeopleController@peopleMatchingJSON');

    //Search
    Route::get('prm/people/search/{tag}', 'PeopleController@search');

    /* People Routes */
    Route::get('prm/peoples/trashed', 'PeopleController@trashed');
    Route::delete('prm/peoples/{id}/remove-trashed', 'PeopleController@removeTrashed');
    Route::post('prm/peoples/{id}/restore', 'PeopleController@restore');
    Route::resource('prm/peoples', 'PeopleController');
    Route::patch('prm/peoples/{people}/update-dp', 'PeopleController@updateDisplayPic');

    /* Contact Routes */
    Route::resource('prm/people/{people}/contacts', 'ContactController');
});	