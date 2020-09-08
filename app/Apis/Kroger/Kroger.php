<?php

namespace App\Apis\Kroger;


class Kroger
{
    protected $base_url = "https://api.kroger.com/v1";

    public function auth() {
        return new Auth($this->base_url);
    }

    public function locations()  {
        $token = $this->auth()->getToken('product.compact');
        return new Locations($token, $this->base_url);
    }

    public function products()  {
        $token = $this->auth()->getToken('product.compact');
        return new Products($token, $this->base_url);
    }

}