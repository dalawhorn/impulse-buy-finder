<?php

namespace App\Apis\Kroger;


use Illuminate\Support\Facades\Http;

class Products
{
    protected $token;

    protected $endpoint_uri = "/products";
    protected $endpoint_url;

    public function __construct($token, $base_url) {
        $this->token = $token;
        $this->endpoint_url = $base_url.$this->endpoint_uri;
    }

    public function search($term, $location_id, $start=0, $limit=10) {
        $response = Http::withToken($this->token)->get($this->endpoint_url, [
            'filter.locationId' => $location_id,
            'filter.term' => $term,
            'filter.start' => $start,
            'filter.limit' => $limit,
            'filter.fulfillment' => 'ais,csp,dth'
        ]);

        if($response->successful()) {
            return $response->json();
        }
        else {
            return false;
        }
    }
}