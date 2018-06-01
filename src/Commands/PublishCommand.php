<?php

namespace Belt\Convo\Commands;

use Belt\Core\Services\PublishService;
use Illuminate\Console\Command;

/**
 * Class PublishCommand
 * @package Belt\Convo\Commands
 */
class PublishCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-convo:publish {action=publish} {--force} {--include=} {--exclude=} {--config}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish assets for belt convo';

    /**
     * @var array
     */
    protected $dirs = [
        'vendor/larabelt/convo/config' => 'config/belt',
        //'vendor/larabelt/convo/resources/js' => 'resources/belt/convo/js',
        //'vendor/larabelt/convo/resources/sass' => 'resources/belt/convo/sass',
        'vendor/larabelt/convo/database/factories' => 'database/factories',
        'vendor/larabelt/convo/database/migrations' => 'database/migrations',
        'vendor/larabelt/convo/database/seeds' => 'database/seeds',
        'vendor/larabelt/convo/database/testing' => 'database/testing',
    ];

    /**
     * @var array
     */
    protected $files = [];

    /**
     * @var PublishService
     */
    private $service;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $action = $this->argument('action');

        $service = $this->service();

        if ($action == 'update') {
            $service->update();
        }

        if ($action == 'publish') {
            $this->publish($service);
        }
    }

    /**
     * Publish contents
     *
     * @param $service
     */
    public function publish($service)
    {
        $service->publish();

        if ($service->created) {
            $this->info("\nThe following files were added:\n");
            foreach ($service->created as $file) {
                $this->info($file);
            }
        }

        if ($service->modified) {
            $this->info("\nThe following files were overwritten:\n");
            foreach ($service->modified as $file) {
                $this->info($file);
            }
        }

        if ($service->ignored) {
            $this->warn("\nThe following files were ignored though source files have changed:\n");
            foreach ($service->ignored as $file) {
                $this->warn($file);
            }
        }
    }

    /**
     * @return PublishService
     */
    public function service()
    {
        $this->service = $this->service ?: new PublishService([
            'dirs' => $this->dirs,
            'files' => $this->files,
            'force' => $this->option('force'),
            'include' => $this->option('include'),
            'exclude' => $this->option('exclude'),
            'config' => $this->option('config'),
        ]);

        return $this->service;
    }

}