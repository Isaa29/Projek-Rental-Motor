<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\JenisMotor;

class BerandaController extends Controller
{
    public function index()
    {
        $motor = JenisMotor::withCount([
            'motors as tersedia_count' => fn($q)=>$q->where('status','tersedia'),
        ])->having('tersedia_count','>',0)->take(4)->get();

        return view('customer.beranda', compact('motor'));
    }
}
