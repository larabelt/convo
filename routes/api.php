<?php

use Belt\Convo\Http\Controllers\Api;

Route::group([
    'prefix' => 'api/v1',
    'middleware' => ['api']
],
    function () {

        # alerts
        Route::get('alerts/{alert}', Api\AlertsController::class . '@show');
        Route::put('alerts/{alert}', Api\AlertsController::class . '@update');
        Route::delete('alerts/{alert}', Api\AlertsController::class . '@destroy');
        Route::get('alerts', Api\AlertsController::class . '@index');
        Route::post('alerts', Api\AlertsController::class . '@store');

    }
);