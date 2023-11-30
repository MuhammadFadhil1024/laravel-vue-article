<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $title = Str::random(10);

        DB::table('blogs')->insert([
            'user_id' => 1,
            'title' => 'Harga Cabe Melonjak Tinggi Diprediksi hingga Awal 2024',
            'image_url' => 'cabe.jpeg',
            'slug' => Str::slug('Harga Cabe Melonjak Tinggi Diprediksi hingga Awal 2024'),
            'status' => 'accepted',
            'publish_date' => Carbon::now(),
            'content' => 'KBRN, Polman : Dinas Perdagangan Kabupaten Polewali Mandar (Polman) memprediksi harga cabai akan tetap tinggi hingga awal tahun 2024 mendatang. Saat ini harga cabai rawit di Kompleks Pasar Sentral Pekkkabata Jl Tamajarra, mencapai Rp 70 ribu per kg, Sabtu (11/11/2023). Sementara harga cabai besar Rp 55 ribu per kg, harga cabai keriting Rp 64 ribu per kilogram. Padahal pekan lalu harga cabai rawit hanya Rp 25 ribu per kg, cabai besar Rp 35 ribu, dan cabai keriting Rp 25 ribu per kg. Harga cabai telah mengalami kenaikan yang signifikan sejak memasuki musim kemarau. Kepala Bidang Perdagangan,Fatriasmal memperkirakan tren ini akan bertahan hingga Januari 2024. "Ini penyebabnya musim kemarau, kalau musim kemarau sampai Januari, prediksi kita akan mahal sampai disitu," terang Fatriasmal kepada RRI Ia menjelaskan stok cabai yang masuk ke kompleks pasar saat ini berkurang. Lantaran para petani cabai sudah dua kali mengalami panen yang sedikit imbas kemarau. Sebelumnya diberitakan, para petani cabai di Desa Pulliwa, Kecamatan Bulo, Kabupaten Polewali Mandar mulai menjerit di musim kemarau panjang. Pasalnya sudah satu bulan hingga Rabu (16/8/2023) kemarau panjang melanda, tidak pernah turun hujan. Membuat sejumlah tanaman cabai mengalami kekeringan layu hingga akhirnya mati. sedikitnya ada puluhan tanaman lombok mati kekeringan milik salah satu petani bernama ibu Nana ini. Tanaman lombok yang ia tanam sejak tiga bulan lalu harusnya masik dapat di panen pada bulan ke empat. "Baru tiga bulan ini kita panen, langsung kemarau tidak hujan dan pohonnya ikut mati," ungkap ibu Nana kepada wartawan. Ia mengatakan sedikitnya ada 50 pohon lombok miliknya mati kekeringan dari 100 pohon yang sebelumnya ia tanam. Mulanya pohon cabai ini mengalami kekeringan pada daun, rontok hingga layu dan mati. Sementara cabai yang ia petik juga mulai berubah warna, yang harusnya merah berubah jadi menguning.',
        ]);
    }
}
