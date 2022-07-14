<?php
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Testing\TestResponse;

TestResponse::macro('assertJsonResource', function (JsonResource $resource) {
    return $this->assertExactJson($resource->response()->getData(true));
});
