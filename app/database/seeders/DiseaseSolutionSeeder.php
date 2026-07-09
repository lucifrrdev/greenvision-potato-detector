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
                'disease_key' => 'Bacteria',
                'disease_name' => 'Infeksi Bakteri (Bacterial Infection)',
                'cause' => 'Bakteri Ralstonia solanacearum (layu bakteri) atau Pectobacterium (busuk lunak) yang menyerang jaringan vaskular tanaman.',
                'pesticide' => 'Semprotkan bakterisida berbahan aktif tembaga hidroksida, tembaga oksiklorida, atau streptomisin sulfat sesuai dosis anjuran. Lakukan tindakan segera pada tanaman yang terinfeksi ringan.',
                'watering' => 'Gunakan irigasi bawah tanah atau irigasi tetes untuk meminimalkan pembasahan daun dan batang. Pastikan drainase tanah mengalir lancar karena bakteri menyebar sangat cepat melalui aliran air tanah yang tergenang.',
                'prevention' => 'Gunakan bibit kentang bersertifikat bebas bakteri patogen, lakukan rotasi tanaman dengan tanaman jagung atau rumput-rumputan selama minimal 3 tahun, serta segera cabut dan bakar tanaman yang menunjukkan gejala layu.'
            ],
            [
                'disease_key' => 'Bukan_Daun_Kentang',
                'disease_name' => 'Bukan Daun Kentang (Objek Lain)',
                'cause' => '-',
                'pesticide' => '-',
                'watering' => '-',
                'prevention' => 'Pastikan kamera Anda diarahkan langsung pada daun kentang yang ingin dianalisis. Ambil gambar dari jarak dekat (close-up) dengan pencahayaan yang cukup terang dan hindari bayangan yang mengganggu agar AI dapat memberikan diagnosis penyakit daun secara akurat.'
            ],
            [
                'disease_key' => 'Fungi',
                'disease_name' => 'Infeksi Jamur / Fungi (Fungal Infection)',
                'cause' => 'Jamur patogen daun kentang seperti Alternaria solani (bercak kering) atau Oidium (embun tepung) yang berkembang di lingkungan hangat dan lembap.',
                'pesticide' => 'Semprotkan fungisida kontak berbahan aktif mankozeb atau klorotalonil secara berkala. Jika infeksi meluas, aplikasikan fungisida sistemik berbahan aktif difenokonazol atau azoksistrobin.',
                'watering' => 'Lakukan penyiraman pada pagi hari langsung ke area tanah atau perakaran tanaman. Hindari pembasahan tajuk daun agar spora jamur tidak memiliki media basah untuk berkecambah.',
                'prevention' => 'Lakukan sanitasi lahan dengan membersihkan gulma pembawa inang jamur, atur jarak tanam agar tajuk tidak terlalu rapat untuk meningkatkan sirkulasi udara, dan bakar daun atau tanaman mati pasca panen.'
            ],
            [
                'disease_key' => 'Healthy',
                'disease_name' => 'Daun Kentang Sehat (Healthy)',
                'cause' => 'N/A (Tanaman tumbuh subur dalam kondisi optimal dengan nutrisi berimbang)',
                'pesticide' => 'Tidak memerlukan aplikasi pestisida kimia. Untuk mempertahankan imunitas tanaman, semprotkan agen hayati seperti Trichoderma harzianum dan berikan pupuk organik cair (POC) secara rutin setiap 2 minggu sekali.',
                'watering' => 'Jaga kelembapan tanah agar tetap konsisten stabil (tidak terlalu kering dan tidak becek). Lakukan penyiraman rutin berdasarkan tingkat kekeringan media tanah di sekitar perakaran tanaman.',
                'prevention' => 'Lakukan sanitasi lahan dari gulma liar secara berkala, lakukan pemantauan visual pada area bawah daun seminggu sekali, serta pastikan pemupukan makro dan mikro diberikan secara berimbang sesuai fase tumbuh.'
            ],
            [
                'disease_key' => 'Nematode',
                'disease_name' => 'Serangan Nematoda (Nematode Damage)',
                'cause' => 'Nematoda Sista Kentang (Globodera rostochiensis) atau nematoda bengkak akar (Meloidogyne spp.) yang merusak sistem perakaran tanaman.',
                'pesticide' => 'Gunakan nematisida berbahan aktif karbofuran atau etoprofos yang ditaburkan pada tanah di sekitar tanaman sesuai dengan dosis anjuran resmi.',
                'watering' => 'Jaga kelembapan tanah agar tidak mengalami kekeringan ekstrem, karena akar yang rusak akibat nematoda akan sangat sensitif dan cepat layu jika kekurangan air.',
                'prevention' => 'Lakukan rotasi tanaman dengan tanaman yang bukan inang nematoda (seperti marigold/tagetes yang dapat menekan populasi nematoda), dan pastikan tanah diolah secara mekanis sebelum ditanam.'
            ],
            [
                'disease_key' => 'Pest',
                'disease_name' => 'Serangan Hama Serangga (Insect Pest Damage)',
                'cause' => 'Hama pemakan daun seperti Ulat Grayak (Spodoptera litura), Kutu Daun (Aphids), Lalat Penggorok Daun (Liriomyza), atau Kumbang Kentang.',
                'pesticide' => 'Semprotkan insektisida berbahan aktif deltametrin, imidakloprid, atau abamektin sesuai dengan jenis hama sasaran yang teridentifikasi menyerang daun.',
                'watering' => 'Penyiraman tetap dilakukan secara normal. Pastikan air penyiraman bersih dan bebas dari sisa-sisa telur hama yang hanyut dari tanaman lain.',
                'prevention' => 'Pasang perangkap kuning berperekat (yellow sticky traps) di sekitar lahan, gunakan jaring serangga jika menanam di greenhouse, serta lakukan pemangkasan bagian daun yang menjadi sarang telur serangga.'
            ],
            [
                'disease_key' => 'Phytopthora',
                'disease_name' => 'Busuk Daun Phytophthora (Late Blight)',
                'cause' => 'Oomycete Phytophthora infestans yang berkembang sangat cepat dan masif dalam kondisi cuaca basah, dingin, dan berkabut.',
                'pesticide' => 'Gunakan fungisida sistemik berbahan aktif metalaksil atau dimetomorf yang dikombinasikan secara selang-seling dengan fungisida kontak tembaga oksida untuk mencegah kekebalan patogen.',
                'watering' => 'Hentikan atau kurangi penyiraman jika cuaca hujan terus-menerus. Pastikan bedengan tinggi agar sirkulasi air di parit lancar dan tidak merendam perakaran.',
                'prevention' => 'Tanam kuantitas bibit kentang yang teruji bebas penyakit late blight, atur jarak tanam renggang, dan musnahkan segera seluruh sisa tanaman yang terinfeksi agar tidak menular ke tanaman lain.'
            ],
            [
                'disease_key' => 'Virus',
                'disease_name' => 'Infeksi Virus Tanaman (Viral Infection)',
                'cause' => 'Potato Virus Y (PVY) atau Potato Leafroll Virus (PLRV) yang ditularkan oleh vektor serangga seperti Kutu Daun (Aphids).',
                'pesticide' => 'Penyakit virus tidak dapat diobati dengan pestisida. Semprotkan insektisida berbahan aktif abamektin untuk mengendalikan serangga kutu daun pembawa vektor virus.',
                'watering' => 'Penyiraman tetap dilakukan secara normal. Berikan pupuk mikro foliar untuk merangsang kekuatan tanaman bertahan terhadap gejala kerdil akibat virus.',
                'prevention' => 'Segera cabut dan musnahkan tanaman yang kerdil, daun mengeriting, atau bermosaik kuning. Gunakan mulsa plastik reflektif perak untuk mengusir serangga kutu daun agar tidak mendarat.'
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
