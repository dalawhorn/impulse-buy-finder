<?php

namespace App\Apis\Kroger;


use Illuminate\Support\Facades\Http;

class Locations
{
    protected $token;

    protected $endpoint_uri = "/locations";
    protected $endpoint_url;

    public function __construct($token, $base_url) {
        $this->token = $token;
        $this->endpoint_url = $base_url.$this->endpoint_uri;
    }

    public function list($zip, $radius=10, $limit=10, $chain="Kroger") {
        $response = Http::withToken($this->token)->get($this->endpoint_url, [
            'filter.zipCode.near' => $zip,
            'filter.chain' => $chain,
            'filter.radiusInMiles' => $radius,
            'filter.limit' => $limit,
            'filter.department' => '02'
        ]);

        if($response->successful()) {
            return $response->json();
        }
        else {
            return false;
        }
    }

    public function getById($location_id) {
        $response = Http::withToken($this->token)->get($this->endpoint_url."/".$location_id);

        if($response->successful()) {
            return $response->json();
        }
        else {
            return false;
        }
    }
}