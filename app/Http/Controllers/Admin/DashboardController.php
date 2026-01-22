<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
{
    // 1. Hitung Data
    $total_bp = User::where('role', 'bp')->count();
    $filled = User::where('role', 'bp')->where('status', 'Sudah Mengisi')->count();
    
    // 2. Hitung Persentase (PENTING)
    $percentage = ($total_bp > 0) ? ($filled / $total_bp) * 100 : 0;

    // 3. Masukkan ke object $stats (PASTIKAN 'percentage' ADA DISINI)
    $stats = (object) [
        'total_bp' => $total_bp,
        'filled' => $filled,
        'percentage' => $percentage,  
    ];

    return view('admin.dashboard', compact('stats'));
}
}