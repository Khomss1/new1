@extends('layouts.app')

@section('title', 'Detail Kuesioner')

@section('page-title', 'Detail Kuesioner: ' . $bp->name)

@section('content')
<div class="flex justify-between items-end mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">{{ $bp->name }}</h2>
        <p class="text-sm text-gray-500">Kategori: {{ $bp->kelas->nama_kelas ?? '-' }}</p>
    </div>
    <a href="{{ route('evaluasi.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium">
        &larr; Kembali
    </a>
</div>

<!-- 1. FORM KEMBALIKAN (Revisi) -->
<!-- Form Revisi -->
@if(in_array($bp->status, ['Sudah Mengisi', 'Menunggu Verifikasi']))
<form action="{{ route('evaluasi.reject', $bp->id) }}" method="POST" class="mt-4 p-4 bg-orange-50 border-l-4 border-orange-500 rounded-lg shadow-sm">
    @csrf
    <div class="flex flex-col gap-2">
        <label class="text-sm font-bold text-orange-800 uppercase mb-1">Perintah Pengembalian:</label>
        <p class="text-sm text-orange-600">Kembalikan kuesioner ini ke responden jika terdapat kesalahan atau kekurangan.</p>
        <div class="flex flex-col gap-2">
            <label class="text-sm font-medium text-gray-700">Alasan Pengembalian:</label>
            <textarea name="alasan" rows="2" class="w-full border border-orange-300 rounded-md p-2 text-sm focus:ring-orange-500" required placeholder="Contoh: Link video rusak / jawaban tidak lengkap..."></textarea>
        
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700">
            <i class="ph ph-arrow-u-up-left mr-2"></i> Kembalikan (Revisi)
        </button>
    </div>
</form>
@endif

<!-- WRAPPER TABEL DATA JAWABAN -->
<div class="mt-6 space-y-6">
    @forelse($bp->jawaban as $jawaban)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-start mb-4">
            <div class="w-full pr-4">
                <h3 class="text-lg font-bold text-gray-900 mb-2">
                    {{ $jawaban->question->pertanya }}
                </h3>
                <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">
                    {{ $jawaban->question->kategori }}
                </span>
            </div>
            
            <!-- CHECKBOX ADMIN VERIFIKASI -->
            <div class="flex-shrink-0">
                <label class="inline-flex items-center cursor-pointer bg-blue-50 px-3 py-2 rounded-lg border border-blue-200 hover:bg-blue-100 transition">
                    <input type="checkbox" 
                           name="is_verified[{{ $jawaban->id }}]" 
                           value="1"
                           class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                           {{ $jawaban->is_verified ? 'checked' : '' }}>
                    <span class="ml-2 text-sm font-bold text-blue-800">Setuju</span>
                </label>
            </div>
        </div>

        <!-- JAWABAN USER -->
        <div class="bg-gray-50 rounded-lg p-4 space-y-3 border-l-4 border-blue-500">
            <div>
                <span class="text-xs font-bold text-gray-500 uppercase">Jawaban:</span>
                <p class="mt-1 text-sm font-medium text-gray-800">
                    {{ $jawaban->jawaban_text }} 
                </p>
            </div>

            <!-- LOGIKA PERBAIKAN LINK -->
            @php
                // Kita pecah text jawaban berdasarkan kata 'Link:'
                // Parameter 2 di explode artinya limit pecahan array jadi max 2 (untuk keamanan)
                $parts = explode('Link:', $jawaban->jawaban_text, 2);
                $link = isset($parts[1]) ? trim($parts[1]) : '';
            @endphp

            @if(!empty($link))
            <div>
                <span class="text-xs font-bold text-gray-500 uppercase">Link Bukti:</span>
                <div class="mt-2">
                    <a href="{{ $link }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm underline">
                        <i class="ph ph-link"></i> {{ $link }}
                    </a>
                </div>
            </div>
            @endif

            <!-- FILE -->
            @if($jawaban->jawaban_file)
            <div>
                <span class="text-xs font-bold text-gray-500 uppercase">File Bukti:</span>
                <div class="mt-2">
                    <a href="{{ asset($jawaban->jawaban_file) }}" target="_blank" 
                       class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200">
                        <i class="ph ph-download-simple mr-1"></i> Download File
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- INPUT KOMENTAR ADMIN -->
        <div class="mt-4">
            <label class="block text-xs font-bold text-gray-600 uppercase mb-1">Catatan Verifikator:</label>
            <textarea name="admin_notes[{{ $jawaban->id }}]" 
                      class="w-full border border-gray-300 rounded-md p-2 text-sm focus:ring-2 focus:ring-blue-500" 
                      rows="2">{{ $jawaban->admin_notes ?? '' }}</textarea>
            
            <!-- Hidden ID Answer -->
            <input type="hidden" name="answer_ids[]" value="{{ $jawaban->id }}">
        </div>
    </div>
    @empty
        <div class="text-center py-10 text-gray-500">
            <p class="text-lg">Belum ada jawaban yang dikirim.</p>
        </div>
    @endforelse
</div>

<!-- 2. WRAPPER FINALISASI (HANYA MUNCUL JIKA SUDAH DIVAKAN FORM ATAS) -->
@if(in_array($bp->status, ['Telah Diperbaiki', 'Terverifikasi']))
<div class="mt-8 bg-green-50 border-t-4 border-green-600 p-6 rounded-xl">
    <h3 class="text-lg font-bold text-green-900 mb-4">
        <i class="ph ph-star mr-2"></i> Penilaian Akhir & Verifikasi
    </h3>
    
    <form action="{{ route('evaluasi.finalize', $bp->id) }}" method="POST">
        @csrf
        <p class="text-sm text-gray-700 mb-4">Masukkan nilai 0-100 untuk setiap indikator:</p>
        
        <!-- Input 5 Indikator -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Digitalisasi</label>
                <input type="number" name="score_digitalisasi" min="0" max="100" value="0" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-green-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Jenis Info</label>
                <input type="number" name="score_jenis" min="0" max="100" value="0" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-green-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Kualitas</label>
                <input type="number" name="score_kualitas" min="0" max="100" value="0" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-green-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">Komitmen</label>
                <input type="number" name="score_komitmen" min="0" max="100" value="0" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-green-500">
            </div>
            <div>
                <!-- PERBAIKAN: text-gray-700 dan border-gray-300 -->
                <label class="block text-xs font-bold text-gray-700 mb-1">Sarana</label>
                <input type="number" name="score_sarana" min="0" max="100" value="0" class="w-full border border-gray-300 rounded px-2 py-1 text-sm focus:ring-green-500">
            </div>
        </div>

        <!-- Total Score & Status -->
        <div class="bg-white p-3 rounded border border-green-200 flex justify-between items-center">
            <span class="text-sm font-medium text-gray-700">Status Akhir:</span>
            <span class="text-sm font-bold text-green-800">Terverifikasi</span>
        </div>

        <!-- Tombol Finalisasi -->
        <div class="flex justify-end">
            <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                <i class="ph ph-check-circle mr-2"></i> Finalisasi & Terverifikasi
            </button>
        </div>
    </form>
@endif

<!-- 3. TOMBOL SIMPAN DETAIL (Jika ada jawaban) -->
@if(count($bp->jawaban) > 0)
<div class="mt-6 flex justify-end">
    <form action="{{ route('evaluasi.update', $bp->id) }}" method="POST">
        @csrf
        <button type="submit" class="bg-blue-100 hover:bg-blue-200 text-blue-800 px-4 py-2 rounded-lg text-sm font-medium">
            <i class="ph ph-floppy-disk mr-2"></i> Simpan Detail Ceklis
        </button>
    </form>
</div>
@endif
@endsection