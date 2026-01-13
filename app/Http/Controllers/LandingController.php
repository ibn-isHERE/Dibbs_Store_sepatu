<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Kalau sudah login, redirect sesuai role
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            } else {
                return redirect()->route('customer.katalog');
            }
        }

        return view('landing');
    }
}