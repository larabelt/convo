<?php

use Mockery as m;

use Belt\Notify\Alert;
use Belt\Core\Testing\BeltTestCase;
use Belt\Notify\Http\ViewComposers\AlertsComposer;
use Belt\Notify\Services\AlertService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class AlertsComposerTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Notify\Http\ViewComposers\AlertsComposer::__construct()
     * @covers \Belt\Notify\Http\ViewComposers\AlertsComposer::compose()
     * @covers \Belt\Notify\Http\ViewComposers\AlertsComposer::service()
     */
    public function test()
    {
        $this->enableI18n();

        Alert::unguard();

        $alerts = new Collection([
            new Alert(['id' => 1]),
            new Alert(['id' => 2]),
            new Alert(['id' => 3]),
        ]);

        Cache::shouldReceive('has')->once()->with('alerts-en_US')->andReturn(true);
        Cache::shouldReceive('get')->once()->with('alerts-en_US')->andReturn($alerts);
        $this->app['request']->cookies->set('alerts', '1,2');

        # constructor
        $composer = new AlertsComposer();
        $this->assertEquals(1, count($composer->alerts));

        # compose
        $view = m::mock(\Illuminate\View\View::class);
        $view->shouldReceive('with')->once()->with('alerts', $composer->alerts);
        $composer->compose($view);

        # service
        $this->assertInstanceOf(AlertService::class, $composer->service());
    }

}