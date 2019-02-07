<?php

namespace Belt\Notify\Commands;

use Belt\Core\Commands\PublishCommand as Command;

/**
 * Class PublishCommand
 * @package Belt\Content\Commands
 */
class PublishCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-notify:publish {action=publish} {--force} {--include=} {--exclude=} {--config}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish assets for belt notify';

    /**
     * @var array
     */
    protected $dirs = [
        'vendor/larabelt/notify/config' => 'config/belt',
        'vendor/larabelt/notify/database/factories' => 'database/factories',
        'vendor/larabelt/notify/database/migrations' => 'database/migrations',
        'vendor/larabelt/notify/database/seeds' => 'database/seeds',
        'vendor/larabelt/notify/docs' => 'resources/docs/raw',
    ];

}