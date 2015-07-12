<?php


Route::group(array('module' => 'PRM', 'namespace' => 'Asterisk\Modules\PRM\Controllers\Peoples'), function() {

    Route::get('prm/peoples', 'PeopleController@peoples');
    Route::get('prm/people', 'PeopleController@profile');

});	