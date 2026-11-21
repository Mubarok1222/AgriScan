<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenyakitPadi;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    /**
     * Display list of rice diseases
     */
    public function index(Request $request)
    {
        $query = PenyakitPadi::withCount('riwayatDeteksi');

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_penyakit', 'like', "%{$keyword}%")
                  ->orWhere('deskripsi', 'like', "%{$keyword}%");
            });
        }

        $penyakitList = $query->latest()->paginate(10)->withQueryString();
        $totalPenyakit = PenyakitPadi::count();

        return view('admin.penyakit', compact('penyakitList', 'totalPenyakit'));
    }

    /**
     * Store a newly created disease in database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penyakit' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'saran_penanganan' => 'required|string',
        ], [
            'nama_penyakit.required' => 'Nama penyakit wajib diisi.',
            'deskripsi.required' => 'Deskripsi penyakit wajib diisi.',
            'saran_penanganan.required' => 'Saran penanganan wajib diisi.',
        ]);

        PenyakitPadi::create($request->only('nama_penyakit', 'deskripsi', 'saran_penanganan'));

        return redirect()->route('admin.penyakit')
            ->with('success', 'Data penyakit berhasil ditambahkan ke pustaka database!');
    }

    /**
     * Update the specified disease in database
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penyakit' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'saran_penanganan' => 'required|string',
        ], [
            'nama_penyakit.required' => 'Nama penyakit wajib diisi.',
            'deskripsi.required' => 'Deskripsi penyakit wajib diisi.',
            'saran_penanganan.required' => 'Saran penanganan wajib diisi.',
        ]);

        $penyakit = PenyakitPadi::findOrFail($id);
        $penyakit->update($request->only('nama_penyakit', 'deskripsi', 'saran_penanganan'));

        return redirect()->route('admin.penyakit')
            ->with('success', 'Data penyakit berhasil diperbarui!');
    }

    /**
     * Remove the specified disease from database
     */
    public function destroy($id)
    {
        $penyakit = PenyakitPadi::findOrFail($id);
        $penyakit->delete();

        return redirect()->route('admin.penyakit')
            ->with('success', 'Data penyakit berhasil dihapus dari sistem!');
    }
}

