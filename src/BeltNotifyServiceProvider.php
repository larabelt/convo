<?php

namespace Belt\Notify;

use Belt, Barryvdh, Collective, Illuminate, Laravel, Rap2hpoutre, Silber;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;

/**
 * class BeltNotifyServiceProvider
 * @package Belt\Notify
 */
class BeltNotifyServiceProvider extends Belt\Core\BeltServiceProvider
{

    /**
     * The Larabelt toolkit version.
     *
     * @var string
     */
    const VERSION = '2.0-BETA';

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Belt\Notify\Alert::class => Belt\Notify\Policies\AlertPolicy::class,
    ];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/../routes/admin.php';
        include __DIR__ . '/../routes/api.php';

        // beltable values for global belt command
        $this->app['belt']->addPackage('notify', ['dir' => __DIR__ . '/..']);
        $this->app['belt']->publish('belt-notify:publish');
        $this->app['belt']->seeders('BeltNotifySeeder');

        // cookies encryption exception
        Belt\Core\Http\Middleware\EncryptCookies::except('alerts');
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(GateContract $gate, Router $router)
    {

        //observers
        Belt\Notify\Alert::observe(Belt\Notify\Observers\AlertObserver::class);

        // set backup view paths
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'belt-notify');

        // set backup translation paths
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'belt-notify');

        // policies
        $this->registerPolicies($gate);

        // commands
        $this->commands(Belt\Notify\Commands\AlertCommand::class);
        $this->commands(Belt\Notify\Commands\PublishCommand::class);

        // morphMap
        Relation::morphMap([
            'alerts' => Belt\Notify\Alert::class,
        ]);

        // route model binding
        $router->model('alert', Belt\Notify\Alert::class, function ($value) {
            return Belt\Notify\Alert::sluggish($value)->first();
        });

        // access map for window config
        Belt\Core\Services\AccessService::put('*', 'alerts');
    }

    /**
     * Register the application's policies.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function registerPolicies(GateContract $gate)
    {
        $gate->before(function ($user) {
            if ($user->super) {
                return true;
            }
        });

        foreach ($this->policies as $key => $value) {
            $gate->policy($key, $value);
        }
    }

}