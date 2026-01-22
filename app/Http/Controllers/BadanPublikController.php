<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class BadanPublikController extends Controller
{
    /**
     * Menampilkan Daftar Badan Publik (Untuk Admin)
     */
    public function index(Request $request)
    {
        // Definisikan query
        $query = User::where('role', 'bp')->with('kelas');
        
        // Eksekusi query
        $data = $query->orderBy('created_at', 'desc')->get();

        // Kembalikan view dengan data
        return view('admin.bp_list', ['data' => $data]);
    }

    /**
     * Dashboard User BP
     */
    public function dashboard()
    {
       // Ambil user yang sedang login
        $user = auth()->user();

        // Hitung jumlah jawaban user
        $answeredCount = $user->jawaban()->count();

        // Hitung total soal yang tersedia
        $questionCount = Question::count(); 

        // Kirim kedua variabel ke view
        return view('bp.dashboard', compact('answeredCount', 'questionCount'));
    }

    /**
     * Halaman Kuesioner User BP
     */
    public function kuesioner()
    {
        // 1. Ambil semua pertanyaan
        // Pastikan kolom di database tabel 'questions' sesuai
        $questions = Question::orderBy('id', 'asc')->get();

        // 2. Ambil jawaban yang sudah ada user ini (jika ada)
        // Ini berguna saat user 'Revisi', isian form tidak hilang
        // Pastikan ada Model 'Answer' atau gunakan relasi 'jawaban'
        $answers = [];
        if (auth()->user()->jawaban) {
            $answers = auth()->user()->jawaban->keyBy('question_id');
        }

        // 3. Kirim variabel $questions ke view
        return view('bp.kuesioner', compact('questions', 'answers'));
    }

    /**
     * Submit Kuesioner
     */
    public function submit(Request $request)
    {
        // Tambahkan logika simpan kuesioner di sini
        return redirect()->back()->with('success', 'Jawaban berhasil disimpan.');
    }
}