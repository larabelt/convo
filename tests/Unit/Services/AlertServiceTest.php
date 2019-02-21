<?php namespace Tests\Belt\Notify\Unit\Services;

use Mockery as m;

use Belt\Notify\Alert;
use Belt\Notify\Services\AlertService;
use Belt\Core\Tests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AlertServiceTest extends Tests\BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Notify\Services\AlertService::init
     * @covers \Belt\Notify\Services\AlertService::cache
     * @covers \Belt\Notify\Services\AlertService::query
     */
    public function test()
    {
        # init
        Cache::shouldReceive('has')->with('alerts')->andReturn(false);
        $service = m::mock(AlertService::class . '[cache]');
        $service->shouldReceive('cache')->andReturn(true);
        $service->init();

        # query
        $service = new AlertService();
        $this->assertInstanceOf(Builder::class, $service->query());

        # cache
        Alert::unguard();
        $alerts = new Collection();
        $alerts->add(factory(Alert::class)->make(['id' => 3]));
        $alerts->add(factory(Alert::class)->make(['id' => 2]));

        $query = m::mock(Builder::class);
        $query->shouldReceive('active')->andReturnSelf();
        $query->shouldReceive('get')->andReturn($alerts);

        $service = m::mock(AlertService::class . '[query]');
        $service->shouldReceive('query')->andReturn($query);

        //$alerts = $alerts->keyBy('id');

        Cache::shouldReceive('put');

        $service->cache();

    }

}