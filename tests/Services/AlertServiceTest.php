<?php

use Mockery as m;

use Belt\Notify\Alert;
use Belt\Notify\Services\AlertService;
use Belt\Core\Testing;
use Belt\Core\Facades\TranslateFacade as Translate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AlertServiceTest extends Testing\BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Notify\Services\AlertService::init
     * @covers \Belt\Notify\Services\AlertService::cacheKey
     * @covers \Belt\Notify\Services\AlertService::cache
     * @covers \Belt\Notify\Services\AlertService::query
     * @covers \Belt\Notify\Services\AlertService::clearCache
     */
    public function test()
    {
        $this->enableI18n();

        # cacheKey
        $service = new AlertService();
        $this->assertEquals('alerts-foo', $service->cacheKey('foo'));
        Translate::setLocale('es_ES');
        $this->assertEquals('alerts-es_ES', $service->cacheKey());
        Translate::setLocale('en_US');
        $this->assertEquals('alerts-en_US', $service->cacheKey());

        # init
        Cache::shouldReceive('has')->with('alerts-en_US')->andReturn(false);
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
        Cache::shouldReceive('put');
        $service->cache();

        # clearCache
        Cache::shouldReceive('delete')->with('alerts-es_ES')->andReturnSelf();
        Cache::shouldReceive('delete')->with('alerts-en_US')->andReturnSelf();
        $service->clearCache();

    }

    /**
     * @covers \Belt\Notify\Services\AlertService::init
     * @covers \Belt\Notify\Services\AlertService::cacheKey
     * @covers \Belt\Notify\Services\AlertService::cache
     * @covers \Belt\Notify\Services\AlertService::query
     * @covers \Belt\Notify\Services\AlertService::clearCache
     */
    public function ztest2()
    {
        $this->enableI18n();

        # cacheKey
        $service = new AlertService();
        Translate::shouldReceive('getLocale')->once()->andReturn('es_ES');
        $this->assertEquals('alerts-es_ES', $service->cacheKey());

    }

}