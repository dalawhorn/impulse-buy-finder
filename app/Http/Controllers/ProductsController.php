<?php

namespace App\Http\Controllers;

use App\Apis\Kroger\Kroger;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        return view('products');
    }
}
