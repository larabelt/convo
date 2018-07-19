<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => ['web', 'admin']
],
    function () {

        # admin/belt/core home
        Route::get('belt/notify/{any?}', function () {
            return view('belt-notify::base.admin.dashboard');
        })->where('any', '(.*)');
    }
);