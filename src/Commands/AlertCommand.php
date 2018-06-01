<?php

namespace Belt\Convo\Commands;

use Belt\Convo\Services\AlertService;
use Illuminate\Console\Command;

/**
 * Class AlertCommand
 * @package Belt\Convo\Commands
 */
class AlertCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-convo:alerts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->service()->cache();
    }

}