<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PenyakitPadi;
use App\Models\RiwayatDeteksi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin
        $admin = User::create([
            'nama_lengkap' => 'Administrator AgriScan',
            'email' => 'admin@agriscan.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Akun Petani
        $petani = User::create([
            'nama_lengkap' => 'Pak Budi',
            'email' => 'petani@agriscan.com',
            'password' => Hash::make('password'),
            'role' => 'petani',
        ]);

        // 3. Master Data 4 Penyakit Padi Utama
        $penyakit1 = PenyakitPadi::create([
            'nama_penyakit' => 'Bacterial Leaf Blight (Hawar Daun Bakteri / Kresek)',
            'deskripsi' => 'Disebabkan oleh bakteri Xanthomonas oryzae pv. oryzae. Menyerang helai daun padi dari tepi daun berupa garis kebasahan bergelombang yang menguning hingga memutih keabuan dan mengering.',
            'saran_penanganan' => "1. Gunakan varietas padi yang tahan terhadap hawar daun bakteri.\n2. Terapkan pengairan berselang (intermittent irrigation) dan hindari genangan air berlebih di sawah.\n3. Kurangi pemupukan Nitrogen (Urea) berlebih dan seimbangkan dengan Kalium (K) serta Silika.\n4. Semprotkan bakterisida berbahan aktif tembaga (Cu) atau antibiotik pertanian jika serangan mencapai ambang kendali.",
        ]);

        $penyakit2 = PenyakitPadi::create([
            'nama_penyakit' => 'Rice Blast (Blas Padi)',
            'deskripsi' => 'Disebabkan oleh jamur Magnaporthe oryzae. Menyerang daun, ruas, dan tangkai malai. Pada daun membentuk bercak belah ketupat runcing di kedua ujung dengan pusat kelabu-putih dan tepian coklat kemerahan.',
            'saran_penanganan' => "1. Hindari jarak tanam yang terlalu rapat (terapkan sistem tanam jajar legowo).\n2. Hindari dosis pupuk Nitrogen yang terlalu tinggi pada awal musim tanam.\n3. Pergiliran varietas benih antar musim tanam untuk mematahkan siklus patogen.\n4. Aplikasi fungisida sistemik berbahan aktif trisiklazol atau isoprotiolan saat gejala awal terlihat.",
        ]);

        $penyakit3 = PenyakitPadi::create([
            'nama_penyakit' => 'Brown Spot (Bercak Coklat)',
            'deskripsi' => 'Disebabkan oleh jamur Bipolaris oryzae. Gejala khas berupa bercak bulat hingga oval berwarna coklat tua dengan lingkaran kuning tipis (halo) di sekelilingnya.',
            'saran_penanganan' => "1. Berikan pemupukan berimbang terutama Kalium, Fosfat, dan bahan organik tanah untuk memperkuat jaringan daun.\n2. Lakukan perlakuan benih (seed treatment) dengan fungisida sebelum disemai.\n3. Jaga drainase lahan agar aerasi akar tetap optimal.\n4. Semprotkan fungisida kontak/sistemik berbahan aktif mankozeb atau difenokonazol jika intensitas serangan meningkat.",
        ]);

        $penyakit4 = PenyakitPadi::create([
            'nama_penyakit' => 'Rice Tungro (Tungro Padi)',
            'deskripsi' => 'Penyakit virus yang ditularkan oleh vektor wereng daun hijau (Nephotettix virescens). Daun menguning hingga jingga dari pucuk ke pangkal, tanaman menjadi kerdil, dan malai tidak keluar sempurna.',
            'saran_penanganan' => "1. Tanam serempak dalam satu hamparan untuk memutus siklus hidup vektor wereng hijau.\n2. Kendalikan populasi wereng hijau menggunakan insektisida selektif bila populasi melebihi ambang batas.\n3. Lakukan sanitasi dan eradikasi tanaman sakit agar tidak menjadi sumber infeksi tanaman lain.\n4. Gunakan varietas padi tahan tungro.",
        ]);

        // 4. Data Sampel Riwayat Deteksi untuk Pak Budi (Bulan Oktober 2026)
        $samples = [
            [
                'id_user' => $petani->id,
                'id_penyakit' => null,
                'foto_daun' => '/images/daun-sehat.png',
                'skor_akurasi' => 94.00,
                'status_hasil' => 'Sehat',
                'tanggal_deteksi' => Carbon::create(2026, 10, 9, 8, 30, 0),
            ],
            [
                'id_user' => $petani->id,
                'id_penyakit' => $penyakit1->id_penyakit,
                'foto_daun' => '/images/daun-dugaan.png',
                'skor_akurasi' => 82.00,
                'status_hasil' => 'Dugaan Penyakit',
                'tanggal_deteksi' => Carbon::create(2026, 10, 8, 15, 10, 0),
            ],
            [
                'id_user' => $petani->id,
                'id_penyakit' => null,
                'foto_daun' => '/images/daun-preview.png',
                'skor_akurasi' => null,
                'status_hasil' => 'Tidak Meyakinkan',
                'tanggal_deteksi' => Carbon::create(2026, 10, 7, 9, 20, 0),
            ],
            // 9 sampel tambahan agar total 12 (8 Sehat, 3 Dugaan Penyakit, 1 Tidak Meyakinkan)
            [
                'id_user' => $petani->id,
                'id_penyakit' => null,
                'foto_daun' => '/images/daun-sehat.png',
                'skor_akurasi' => 96.50,
                'status_hasil' => 'Sehat',
                'tanggal_deteksi' => Carbon::create(2026, 10, 7, 14, 0, 0),
            ],
            [
                'id_user' => $petani->id,
                'id_penyakit' => null,
                'foto_daun' => '/images/daun-sehat.png',
                'skor_akurasi' => 91.20,
                'status_hasil' => 'Sehat',
                'tanggal_deteksi' => Carbon::create(2026, 10, 6, 10, 15, 0),
            ],
            [
                'id_user' => $petani->id,
                'id_penyakit' => $penyakit2->id_penyakit,
                'foto_daun' => '/images/daun-dugaan.png',
                'skor_akurasi' => 78.40,
                'status_hasil' => 'Dugaan Penyakit',
                'tanggal_deteksi' => Carbon::create(2026, 10, 5, 16, 45, 0),
            ],
            [
                'id_user' => $petani->id,
                'id_penyakit' => null,
                'foto_daun' => '/images/daun-sehat.png',
                'skor_akurasi' => 95.00,
                'status_hasil' => 'Sehat',
                'tanggal_deteksi' => Carbon::create(2026, 10, 4, 11, 20, 0),
            ],
            [
                'id_user' => $petani->id,
                'id_penyakit' => null,
                'foto_daun' => '/images/daun-sehat.png',
                'skor_akurasi' => 93.80,
                'status_hasil' => 'Sehat',
                'tanggal_deteksi' => Carbon::create(2026, 10, 3, 9, 10, 0),
            ],
            [
                'id_user' => $petani->id,
                'id_penyakit' => $penyakit3->id_penyakit,
                'foto_daun' => '/images/daun-dugaan.png',
                'skor_akurasi' => 85.30,
                'status_hasil' => 'Dugaan Penyakit',
                'tanggal_deteksi' => Carbon::create(2026, 10, 2, 14, 30, 0),
            ],
            [
                'id_user' => $petani->id,
                'id_penyakit' => null,
                'foto_daun' => '/images/daun-sehat.png',
                'skor_akurasi' => 92.10,
                'status_hasil' => 'Sehat',
                'tanggal_deteksi' => Carbon::create(2026, 10, 2, 8, 40, 0),
            ],
            [
                'id_user' => $petani->id,
                'id_penyakit' => null,
                'foto_daun' => '/images/daun-sehat.png',
                'skor_akurasi' => 97.00,
                'status_hasil' => 'Sehat',
                'tanggal_deteksi' => Carbon::create(2026, 10, 1, 15, 0, 0),
            ],
            [
                'id_user' => $petani->id,
                'id_penyakit' => null,
                'foto_daun' => '/images/daun-sehat.png',
                'skor_akurasi' => 90.50,
                'status_hasil' => 'Sehat',
                'tanggal_deteksi' => Carbon::create(2026, 10, 1, 10, 0, 0),
            ],
        ];

        foreach ($samples as $sample) {
            RiwayatDeteksi::create($sample);
        }
    }
}
