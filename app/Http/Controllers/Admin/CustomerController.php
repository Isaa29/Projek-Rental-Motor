<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role','customer');
        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(fn($qq)=>$qq->where('name','like',"%$q%")->orWhere('email','like',"%$q%"));
        }
        return view('admin.customer', ['customers' => $query->withCount('transaksis')->latest()->get()]);
    }

    public function show($id)
    {
        $customer   = User::where('role','customer')->findOrFail($id);
        $transaksis = $customer->transaksis()->with('jenisMotor')->latest()->get();
        return view('admin.customer-detail', compact('customer','transaksis'));
    }
}
