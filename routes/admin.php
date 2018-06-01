<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => ['web', 'admin']
],
    function () {

        # admin/belt/core home
        Route::get('belt/convo/{any?}', function () {
            return view('belt-convo::base.admin.dashboard');
        })->where('any', '(.*)');
    }
);