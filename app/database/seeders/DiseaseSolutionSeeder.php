<?php

namespace Database\Seeders;

use App\Models\DiseaseSolution;
use Illuminate\Database\Seeder;

class DiseaseSolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $solutions = [
            [
                'disease_key' => 'Bukan_Daun_Kentang',
                'disease_name' => 'Bukan Daun Kentang (Objek Lain)',
                'cause' => '-',
                'pesticide' => '-',
                'watering' => '-',
                'prevention' => 'Pastikan kamera Anda diarahkan langsung pada daun kentang yang ingin dianalisis. Ambil gambar dari jarak dekat (close-up) dengan pencahayaan yang cukup terang dan hindari bayangan yang mengganggu agar AI dapat memberikan diagnosis penyakit daun secara akurat.'
            ],
            [
                'disease_key' => 'Potato___healthy',
                'disease_name' => 'Daun Kentang Sehat (Healthy)',
                'cause' => 'N/A (Tanaman tumbuh subur dalam kondisi optimal dengan nutrisi berimbang)',
                'pesticide' => 'Tidak memerlukan aplikasi pestisida kimia. Untuk mempertahankan imunitas tanaman, semprotkan agen hayati seperti Trichoderma harzianum dan berikan pupuk organik cair (POC) secara rutin setiap 2 minggu sekali.',
                'watering' => 'Jaga kelembapan tanah agar tetap konsisten stabil (tidak terlalu kering dan tidak becek). Lakukan penyiraman rutin berdasarkan tingkat kekeringan media tanah di sekitar perakaran tanaman.',
                'prevention' => 'Lakukan sanitasi lahan dari gulma liar secara berkala, lakukan pemantauan visual pada area bawah daun seminggu sekali, serta pastikan pemupukan makro dan mikro diberikan secara berimbang sesuai fase tumbuh.'
            ],
            [
                'disease_key' => 'Potato___Early_blight',
                'disease_name' => 'Bercak Kering (Early Blight)',
                'cause' => 'Jamur patogen Alternaria solani yang menyerang daun tua terlebih dahulu dengan pola lingkaran konsentris gelap seperti target papan panah.',
                'pesticide' => 'Semprotkan fungisida kontak berbahan aktif mankozeb atau klorotalonil. Jika infeksi meluas, aplikasikan fungisida sistemik berbahan aktif difenokonazol.',
                'watering' => 'Lakukan penyiraman langsung ke tanah di pagi hari, hindari pembasahan tajuk daun agar spora jamur tidak menyebar cepat.',
                'prevention' => 'Lakukan rotasi tanaman non-solanaceae, bersihkan sisa tanaman terinfeksi, dan jaga kecukupan unsur hara nitrogen serta kalium tanah.'
            ],
            [
                'disease_key' => 'Potato___Late_blight',
                'disease_name' => 'Busuk Daun (Late Blight)',
                'cause' => 'Fungi sejenis oomycete Phytophthora infestans yang menyukai cuaca dingin dan basah, menyebabkan bercak kebasahan gelap pada daun dan batang.',
                'pesticide' => 'Semprotkan fungisida sistemik berbahan aktif metalaksil, dimetomorf, atau klorotalonil secara berkala, diselingi fungisida kontak berbahan tembaga.',
                'watering' => 'Atur sistem drainase agar air parit mengalir lancar dan bedengan tidak becek tergenang saat musim hujan.',
                'prevention' => 'Gunakan bibit bersertifikat bebas penyakit busuk daun, atur jarak tanam agak longgar untuk sirkulasi udara bebas, serta cabut/bakar tanaman sakit sesegera mungkin.'
            ]
        ];

        foreach ($solutions as $sol) {
            DiseaseSolution::updateOrCreate(
                ['disease_key' => $sol['disease_key']],
                $sol
            );
        }
    }
}
