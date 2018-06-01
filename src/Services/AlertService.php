<?php

namespace Belt\Convo\Services;

use Cache;
use Belt\Convo\Alert;

/**
 * Class AlertService
 * @package Belt\Convo\Services
 */
class AlertService
{

    /**
     * Setup cache if missing
     */
    public function init()
    {
        if (!Cache::has('alerts')) {
            $this->cache();
        }
    }

    /**
     * Get Alert query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Alert::query();
    }

    /**
     * Save alerts to cache
     */
    public function cache()
    {
        $alerts = $this->query()->active()->get();

        $alerts = $alerts->keyBy('id');

        Cache::put('alerts', $alerts, 3600);
    }

}