<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\RiwayatDeteksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    /**
     * Display list of detection history for logged in farmer
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = RiwayatDeteksi::with('penyakit')->where('id_user', $userId);

        // Filter periode
        $periode = $request->get('periode', '2026-10');
        if ($periode && $periode !== 'all') {
            [$year, $month] = explode('-', $periode);
            $query->whereYear('tanggal_deteksi', $year)->whereMonth('tanggal_deteksi', $month);
        }

        // Filter status hasil
        if ($request->filled('status')) {
            $query->where('status_hasil', $request->status);
        }

        $riwayatList = $query->latest('tanggal_deteksi')->paginate(6)->withQueryString();
        $totalAll = RiwayatDeteksi::where('id_user', $userId)->count();

        return view('petani.riwayat', compact('riwayatList', 'periode', 'totalAll'));
    }

    /**
     * Display single history detail
     */
    public function show($id)
    {
        $deteksi = RiwayatDeteksi::with('penyakit')
            ->where('id_user', Auth::id())
            ->findOrFail($id);

        return view('petani.detail', compact('deteksi'));
    }
}

