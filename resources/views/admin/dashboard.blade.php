@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Dashboard Overview</h2>
    <p class="text-gray-500">Ringkasan aktivitas monitoring dan evaluasi.</p>
</div>

<!-- STATISTIK KARTU -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <!-- Total BP -->
    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
        <div class="text-gray-500 text-sm font-medium">Total Badan Publik</div>
        <div class="text-3xl font-bold text-gray-800 mt-2">
            {{ App\Models\User::where('role', 'bp')->count() }}
        </div>
    </div>

    <!-- Menunggu Verifikasi -->
    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-500">
        <div class="text-gray-500 text-sm font-medium">Menunggu Verifikasi</div>
        <div class="text-3xl font-bold text-gray-800 mt-2">
            {{ App\Models\User::where('role', 'bp')->where('status', 'Menunggu Verifikasi')->count() }}
        </div>
    </div>

    <!-- Terverifikasi -->
    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500">
        <div class="text-gray-500 text-sm font-medium">Sudah Terverifikasi</div>
        <div class="text-3xl font-bold text-gray-800 mt-2">
            {{ App\Models\User::where('role', 'bp')->where('status', 'Terverifikasi')->count() }}
        </div>
    </div>

    <!-- Dikembalikan -->
    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-500">
        <div class="text-gray-500 text-sm font-medium">Dikembalikan (Revisi)</div>
        <div class="text-3xl font-bold text-gray-800 mt-2">
            {{ App\Models\User::where('role', 'bp')->where('status', 'Dikembalikan')->count() }}
        </div>
    </div>
</div>

<!-- TABEL AKTIVITAS TERBARU -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="font-bold text-gray-800">Aktivitas Kuesioner Terbaru</h3>
        <a href="{{ route('admin.evaluasi.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua &rarr;</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Badan Publik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php
                    $recentUsers = App\Models\User::where('role', 'bp')->orderBy('updated_at', 'desc')->limit(5)->get();
                @endphp
                @if($recentUsers->count() > 0)
                    @foreach($recentUsers as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $user->status === 'Terverifikasi' ? 'bg-green-100 text-green-800' : 
                                   ($user->status === 'Dikembalikan' ? 'bg-red-100 text-red-800' : 
                                   'bg-yellow-100 text-yellow-800') }}">
                                {{ $user->status ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada aktivitas.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection