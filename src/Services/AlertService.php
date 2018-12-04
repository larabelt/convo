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
     * @param null $code
     * @return string
     */
    public function cacheKey($code = null)
    {
        return sprintf('alerts-%s', $code ?: Translate::getLocale());
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

    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function clearCache()
    {
        foreach (Translate::getAvailableLocales() as $locale) {
            $code = array_get($locale, 'code');
            Cache::delete($this->cacheKey($code));
        }

        Cache::delete($this->cacheKey(config('app.fallback_locale')));
    }

}