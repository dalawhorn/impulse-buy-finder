<?php

namespace App\Http\Controllers;

use App\Apis\Kroger\Kroger;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index() {
//        $kroger_api = new Kroger();
//        $locations = $kroger_api->locations()->list(37932);

        return view('locations');
    }
}
