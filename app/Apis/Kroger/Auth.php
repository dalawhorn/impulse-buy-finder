<?php

namespace App\Apis\Kroger;


use Illuminate\Support\Facades\Http;

class Auth
{
    protected $endpoint_uri = "/connect/oauth2";
    protected $endpoint_url;

    public function __construct($base_url) {
        $this->endpoint_url = $base_url.$this->endpoint_uri;
    }

    public function getToken($scope = 'product.compact') {
        $headers = [
            'Authorization' => 'Basic '.base64_encode(config('services.kroger.client_id').":".config('services.kroger.client_secret')),
        ];

        $response = Http::withHeaders($headers)->asForm()->post($this->endpoint_url.'/token', [
            'grant_type' => 'client_credentials',
            'scope' => $scope
        ]);

        return $response['access_token'];
    }
}