@extends('layouts.bp')

@section('title', 'Isi Kuesioner')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Form Kuesioner</h2>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('bp.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- PERULANGAN PERTANYAAN (HANYA 1 LOOP) -->
            @foreach($questions as $index => $question)
            
            <div class="mb-8 border-b border-gray-100 pb-6 last:border-0">
                
                <!-- 1. PERTANYAAN -->
                <label class="block text-sm font-medium text-gray-900 mb-4">
                    <span class="font-bold text-blue-600 text-lg">{{ $index + 1 }}.</span> {{ $question->pertanyaan }}
                </label>

                <div class="mt-2 space-y-6 pl-4">

                    <!-- 2. PILIHAN YA / TIDAK -->
                    <div class="flex items-center gap-6">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" 
                                   name="text_{{ $question->id }}" 
                                   value="Ya" 
                                   class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                   {{ isset($answers[$question->id]) && $answers[$question->id]->jawaban_text === 'Ya' ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700 font-medium">Ya</span>
                        </label>
                        
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" 
                                   name="text_{{ $question->id }}" 
                                   value="Tidak" 
                                   class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300"
                                   {{ isset($answers[$question->id]) && $answers[$question->id]->jawaban_text === 'Tidak' ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700 font-medium">Tidak</span>
                        </label>
                    </div>

                    <!-- 3. UPLOAD FILE (GAMBAR / EXCEL) -->
                    <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <label class="block text-sm font-medium text-blue-900 mb-2">
                            <i class="ph ph-upload-simple mr-1"></i> Upload Bukti Pendukung
                        </label>
                        <p class="text-xs text-gray-500 mb-2">Format yang diizinkan: JPG, PNG, GIF, XLS, XLSX.</p>
                        
                        <input type="file" 
                               name="file_{{ $question->id }}" 
                               accept=".jpg,.jpeg,.png,.gif,.xls,.xlsx"
                               class="block w-full text-sm text-slate-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-white file:text-blue-700
                                      hover:file:bg-blue-50
                                      border border-gray-300 rounded-md cursor-pointer">
                    </div>

                    <!-- 4. INPUT LINK YOUTUBE / GOOGLE DRIVE -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">
                            Link Bukti (YouTube / Google Drive)
                        </label>
                        
                        <!-- Logic: Ambil Link dari jawaban lama jika ada -->
                        @php 
                            $linkLama = ''; 
                            if(isset($answers[$question->id])) {
                                $parts = explode('Link:', $answers[$question->id]->jawaban_text);
                                $linkLama = trim($parts[1] ?? '');
                            }
                        @endphp
                        
                        <input type="text" 
                               name="link_{{ $question->id }}" 
                               placeholder="https://youtube.com/..." 
                               class="block w-full text-sm border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 placeholder-gray-400"
                               value="{{ $linkLama }}">
                    </div>

                    <!-- Hidden Input ID Question -->
                    <input type="hidden" name="question_id[]" value="{{ $question->id }}">
                    
                </div> <!-- End Space-y -->
            </div> <!-- End mb-8 -->
            @endforeach

            <!-- TOMBOL KIRIM -->
            <div class="mt-6 flex justify-end">
                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="ph ph-paper-plane-right mr-2 mt-1"></i> Kirim Jawaban
                </button>
            </div>
        </form>
    </div>
</div>
@endsection