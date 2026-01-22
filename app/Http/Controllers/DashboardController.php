<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Pastikan Anda punya file resources/views/admin/dashboard.blade.php
        return view('admin.dashboard');
    }
}