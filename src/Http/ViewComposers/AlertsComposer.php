<?php

namespace Belt\Notify\Http\ViewComposers;

use Belt, Cache, Cookie;
use Belt\Notify\Alert;
use Belt\Notify\Services\AlertService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class AlertsComposer
{
    /**
     * @var Alert[]|Collection
     */
    public $alerts;

    /**
     * @var AlertService
     */
    public $service;

    /**
     * Create a new profile composer.
     */
    public function __construct()
    {

        $this->service()->init();

        $alerts = Cache::get($this->service()->cacheKey());

        if ($alerts && $alerts->count() && $alerts instanceof Collection) {

            $dismissed = Cookie::get('alerts');

            if ($dismissed) {
                $dismissed = array_unique(explode(',', $dismissed));
                foreach ($dismissed as $id) {
                    $alerts->forget($id);
                }
            }

            $this->alerts = $alerts->count() ? $alerts : null;
        }
    }

    /**
     * @return AlertService
     */
    public function service()
    {
        return $this->service ?: $this->service = new AlertService();
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('alerts', $this->alerts);
    }
}