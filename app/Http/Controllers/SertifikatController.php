<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Sertifikat;
use App\Models\KppsResult; // Asumsi ada model Ujian
use Barryvdh\DomPDF\Facade\Pdf;

class SertifikatController extends Controller
{
    public function cekSertifikat()
    {
        $user = Auth::user();
        $ujianLulus = KppsResult::where('user_id', $user->id)
                    ->where('accuracy', '>=', 70)
                    ->where('category', 'Post Test')
                    ->exists();

        // Mengembalikan JSON, ini lebih standar untuk API
        return response()->json([
            'can_download' => $ujianLulus
        ]);
    }

    public function generateSertifikat()
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Asumsi: Periksa apakah pengguna sudah lulus ujian
        $ujianLulus = KppsResult::where('user_id', $user->id)
                      ->where('accuracy', '>=', 70)
                      ->exists();

        if (!$ujianLulus) {
            // return redirect()->back()->with('error', 'Anda belum memenuhi syarat untuk mengunduh sertifikat.');
            return('<center><h1>Sertifikat Tidak tersedia</h1><p>Anda belum memenuhi syarat untuk mengunduh sertifikat</p></center>');
        }

        // Cek apakah sertifikat sudah ada
        $sertifikat = Sertifikat::firstOrCreate(
            ['user_id' => $user->id],
            ['nama_sertifikat' => 'Sertifikat KPPS', 'tanggal_diterbitkan' => now()]
        );

        // Buat PDF
        $data = ['nama_user' => $user->name, 
        'tanggal' => Carbon::parse($sertifikat->tanggal_diterbitkan)->format('d F Y')
    ];

        $pdf = Pdf::loadView('sertifikat.template', $data);

        // Set ukuran A4 landscape
        $pdf->setPaper('A4', 'landscape');

        // Generate PDF
        return $pdf->stream('sertifikat.pdf');


        // $pdf = PDF::loadView('sertifikat.template', $data);

        // return $pdf->download('sertifikat_kpps.pdf');
    }
}
