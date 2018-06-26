<?php

namespace Belt\Convo\Commands;

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
        'vendor/larabelt/convo/database/factories' => 'database/factories',
        'vendor/larabelt/convo/database/migrations' => 'database/migrations',
        'vendor/larabelt/convo/database/seeds' => 'database/seeds',
    ];

}