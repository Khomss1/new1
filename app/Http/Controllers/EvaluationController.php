<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EvaluationController extends Controller
{
    /**
     * Halaman Daftar Hasil Kuesioner
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'bp')
                     ->with('kelas')
                     ->withCount('jawaban')
                     ->orderBy('created_at', 'desc');

        // Filter status jika ada
        $statusFilter = $request->query('status');
        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }

        // Di index, kita pakai nama $data
        $data = $query->get(); 
        
        return view('admin.bp_list', ['data' => $data]);
    }

    /**
     * Halaman Detail Jawaban per BP
     */
    public function show($id)
    {
        // !!! PERHATIKAN DI SINI !!!
        // Di method show, kita HARUS pakai nama variabel $bp
        $bp = User::with(['kelas', 'jawaban.question'])->findOrFail($id);
        
        // !!! PERHATIKAN DI SINI !!!
        // Kita kirim array dengan key 'bp' => $bp
        // JANGAN KIRIM 'data' => $data
        return view('admin.verifikasi', ['bp' => $bp]);
    }

    /**
     * Simpan Detail Ceklis (Update)
     */
    public function update(Request $request, $id)
    {
        $bp = User::findOrFail($id);
        
        // Logic update jawaban bisa disesuaikan
        // ...

        return redirect()->route('admin.evaluasi.show', $id)->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Finalisasi Verifikasi & Beri Nilai Akhir
     */
    public function finalizeScore(Request $request, $id)
    {
        $bp = User::findOrFail($id);
        
        $score_digitalisasi = $request->score_digitalisasi;
        $score_jenis = $request->score_jenis;
        $score_kualitas = $request->score_kualitas;
        $score_komitmen = $request->score_komitmen;
        $score_sarana = $request->score_sarana;

        $totalScore = ($score_digitalisasi + $score_jenis + $score_kualitas + $score_komitmen + $score_sarana) / 5;

        $bp->total_score = $totalScore;
        $bp->status = 'Terverifikasi'; 
        
        $bp->save();

        return redirect()->route('admin.evaluasi.show', $id)->with('success', 'Nilai berhasil disimpan.');
    }

    /**
     * Route Reject (Kembalikan / Revisi)
     */
    public function reject(Request $request, $id)
    {
        $bp = User::findOrFail($id);
        
        $bp->catatan_pengembalian = $request->alasan; 
        $bp->status = 'Dikembalikan';
        $bp->save();

        return redirect()->back()->with('success', 'Kuesioner dikembalikan ke responden.');
    }
}