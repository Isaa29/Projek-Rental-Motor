<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class KontakController extends Controller
{
    public function index()
    {
        return view('customer.kontak');
    }
}
