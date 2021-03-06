<?php namespace Tests\Belt\Notify\Feature\Api;

use Belt\Core\Tests;
use Illuminate\Support\Facades\Cache;

class ApiAlertsTest extends Tests\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/alerts');
        $response->assertStatus(200);

        //Cache::shouldReceive('put')->withAnyArgs();
        # store
        $response = $this->json('POST', '/api/v1/alerts', [
            'name' => 'test',
            'body' => 'test',
        ]);
        $response->assertStatus(201);
        $response->assertJsonFragment(['name' => 'TEST']);
        $alertID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/alerts/$alertID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/alerts/$alertID", ['name' => 'updated']);
        $response = $this->json('GET', "/api/v1/alerts/$alertID");
        $response->assertJson(['name' => 'UPDATED']);

        # delete
        $response = $this->json('DELETE', "/api/v1/alerts/$alertID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/alerts/$alertID");
        $response->assertStatus(404);
    }

}