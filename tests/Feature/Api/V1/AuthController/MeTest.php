<?php

namespace Tests\Feature\Api\V1\AuthController;

use App\Http\Resources\MeResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class MeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_me_success()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson(route('api.v1.auth.me'));
        $response->assertStatus(200);
        $response->assertJsonResource(new MeResource($user));
    }
}
