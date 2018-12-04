<?php

namespace Belt\Notify\Services;

use Cache, Translate;
use Belt\Notify\Alert;

/**
 * Class AlertService
 * @package Belt\Notify\Services
 */
class AlertService
{

    /**
     * Setup cache if missing
     */
    public function init()
    {
        if (!Cache::has($this->cacheKey())) {
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
    public function cacheKey()
    {
        return sprintf('alerts-%s', Translate::getLocale());
    }

    /**
     * Save alerts to cache
     */
    public function cache()
    {
        $alerts = $this->query()->active()->get();

        $alerts = $alerts->keyBy('id');

        Cache::put($this->cacheKey(), $alerts, 3600);

        return $alerts;
    }

}