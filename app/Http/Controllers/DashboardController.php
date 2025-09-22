<?php

namespace App\Http\Controllers;

use App\Models\KppsResult;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->role === 'administrator'){
            $results = KppsResult::select('accuracy')->where('category','Post Test')->get();

            // Hitung kategori
            $categories = [
                'Luar Biasa (>=90%)'    => $results->where('accuracy', '>=', 90)->count(),
                'Bagus Sekali (>=70%)'  => $results->whereBetween('accuracy', [70, 89])->count(),
                'Tidak Buruk (>=50%)'   => $results->whereBetween('accuracy', [50, 69])->count(),
                'Perlu Belajar (<50%)'  => $results->where('accuracy', '<', 50)->count(),
            ];

            $labels = array_keys($categories);
            $data   = array_values($categories);

            return view('dashboard.admin', compact('labels', 'data'));
        }else{
            return view('dashboard.kpps');
        }
    }
}
