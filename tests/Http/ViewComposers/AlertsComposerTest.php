<?php

use Mockery as m;

use Belt\Convo\Alert;
use Belt\Core\Testing\BeltTestCase;
use Belt\Convo\Http\ViewComposers\AlertsComposer;
use Belt\Convo\Services\AlertService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class AlertsComposerTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Convo\Http\ViewComposers\AlertsComposer::__construct()
     * @covers \Belt\Convo\Http\ViewComposers\AlertsComposer::compose()
     * @covers \Belt\Convo\Http\ViewComposers\AlertsComposer::service()
     */
    public function test()
    {
        Alert::unguard();

        $alerts = new Collection([
            new Alert(['id' => 1]),
            new Alert(['id' => 2]),
            new Alert(['id' => 3]),
        ]);

        Cache::shouldReceive('has')->once()->with('alerts')->andReturn(true);
        Cache::shouldReceive('get')->once()->with('alerts')->andReturn($alerts);
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