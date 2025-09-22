<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KppsResult;

class KppsController extends Controller
{

    /**
     * Simpan hasil quiz KPPS ke database
     */
    public function saveResult(Request $request)
    {
        $validated = $request->validate([
            'category'       => 'required|string',
            'correct_answers'  => 'required|integer',
            'total_questions'  => 'required|integer',
            'accuracy'         => 'required|integer',
        ]);

        $result = KppsResult::create([
            'user_id'         => auth()->id(), // kalau user login, kalau tidak bisa nullable
            'category'      => $validated['category'],
            'correct_answers' => $validated['correct_answers'],
            'total_questions' => $validated['total_questions'],
            'accuracy'        => $validated['accuracy'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Hasil berhasil disimpan',
            'data'    => $result
        ]);
    }

    /**
     * (Opsional) Ambil semua hasil quiz user yang login
     */
    public function myResults()
    {
        $results = KppsResult::where('user_id', auth()->id())->latest()->get();

        return response()->json([
            'success' => true,
            'data'    => $results
        ]);
    }
}
