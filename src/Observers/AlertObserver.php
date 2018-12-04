<?php

namespace Belt\Notify\Observers;

use Belt\Notify\Services\AlertService;
use DB, Translate;
use Belt\Notify\Alert;

/**
 * Class AlertObserver
 * @package Belt\Notify\Observers
 */
class AlertObserver
{

    /**
     * @var AlertService
     */
    public $service;

    /**
     * @return AlertService
     */
    public function service()
    {
        return $this->service ?: $this->service = new AlertService();
    }

    /**
     * Listen to the Alert saving $alert.
     *
     * @alert  Alert $alert
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function saved(Alert $alert)
    {
        $this->service()->clearCache();
    }
}