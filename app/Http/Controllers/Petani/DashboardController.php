<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\RiwayatDeteksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display farmer dashboard with dynamic database stats
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Query base
        $query = RiwayatDeteksi::where('id_user', $userId);

        // Filter periode if requested (default to October 2026 for simulation data)
        $periode = $request->get('periode', '2026-10');
        if ($periode !== 'all') {
            [$year, $month] = explode('-', $periode);
            $query->whereYear('tanggal_deteksi', $year)->whereMonth('tanggal_deteksi', $month);
        }

        // Metrics
        $totalPemeriksaan = (clone $query)->count();
        $totalSehat = (clone $query)->where('status_hasil', 'Sehat')->count();
        $totalDugaan = (clone $query)->where('status_hasil', 'Dugaan Penyakit')->count();
        $totalTidakMeyakinkan = (clone $query)->where('status_hasil', 'Tidak Meyakinkan')->count();

        // Valid total for donut calculation
        $totalValid = $totalSehat + $totalDugaan;
        $persenSehat = $totalValid > 0 ? round(($totalSehat / $totalValid) * 100, 1) : 0;

        // Tren pemeriksaan per 3 interval dalam bulan
        $tren1 = (clone $query)->whereDay('tanggal_deteksi', '>=', 1)->whereDay('tanggal_deteksi', '<=', 3)->count();
        $tren2 = (clone $query)->whereDay('tanggal_deteksi', '>=', 4)->whereDay('tanggal_deteksi', '<=', 6)->count();
        $tren3 = (clone $query)->whereDay('tanggal_deteksi', '>=', 7)->whereDay('tanggal_deteksi', '<=', 9)->count();

        // 5 Pemeriksaan Terbaru
        $pemeriksaanTerbaru = RiwayatDeteksi::with('penyakit')
            ->where('id_user', $userId)
            ->latest('tanggal_deteksi')
            ->take(5)
            ->get();

        return view('petani.dashboard', compact(
            'totalPemeriksaan',
            'totalSehat',
            'totalDugaan',
            'totalTidakMeyakinkan',
            'totalValid',
            'persenSehat',
            'tren1',
            'tren2',
            'tren3',
            'pemeriksaanTerbaru',
            'periode'
        ));
    }
}

