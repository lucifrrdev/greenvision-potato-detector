<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Disease Solutions
        $this->call([
            DiseaseSolutionSeeder::class,
        ]);

        // 1. Akun Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@greenvision.com'],
            [
                'name' => 'Administrator Greenvision',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. Akun Petani 1 (Default Demo)
        $petani1 = User::updateOrCreate(
            ['email' => 'petani@greenvision.com'],
            [
                'name' => 'Pak Budi (Petani Pangalengan)',
                'password' => Hash::make('petani123'),
                'role' => 'user',
            ]
        );

        // 3. Akun Petani 2 (Alternatif Gmail)
        $petani2 = User::updateOrCreate(
            ['email' => 'petani@gmail.com'],
            [
                'name' => 'Siti Aminah (Petani Dieng)',
                'password' => Hash::make('petani123'),
                'role' => 'user',
            ]
        );

        // 4. Sample Riwayat Deteksi untuk Petani dan Admin
        $solHealthy = \App\Models\DiseaseSolution::where('disease_key', 'Potato___healthy')->first();
        $solEarly = \App\Models\DiseaseSolution::where('disease_key', 'Potato___Early_blight')->first();
        $solLate = \App\Models\DiseaseSolution::where('disease_key', 'Potato___Late_blight')->first();

        $sampleImage = '1783663063_daun_camera.jpg';
        if (!file_exists(public_path('predictions/' . $sampleImage))) {
            @copy(public_path('hero_leaf_scan.webp'), public_path('predictions/' . $sampleImage));
        }

        // Pastikan ada sampel deteksi jika tabel masih kosong
        if (\App\Models\Detection::count() === 0) {
            \App\Models\Detection::create([
                'user_id' => $petani1->id,
                'image_name' => $sampleImage,
                'disease_name' => 'Daun Kentang Sehat (Healthy)',
                'confidence' => 0.985,
                'details' => [
                    'penyakit' => $solHealthy->disease_name,
                    'penyebab' => $solHealthy->cause,
                    'pestisida' => $solHealthy->pesticide,
                    'penyiraman' => $solHealthy->watering,
                    'pencegahan' => $solHealthy->prevention,
                ],
            ]);

            \App\Models\Detection::create([
                'user_id' => $petani1->id,
                'image_name' => $sampleImage,
                'disease_name' => 'Bercak Kering (Early Blight)',
                'confidence' => 0.958,
                'details' => [
                    'penyakit' => $solEarly->disease_name,
                    'penyebab' => $solEarly->cause,
                    'pestisida' => $solEarly->pesticide,
                    'penyiraman' => $solEarly->watering,
                    'pencegahan' => $solEarly->prevention,
                ],
            ]);

            \App\Models\Detection::create([
                'user_id' => $petani1->id,
                'image_name' => $sampleImage,
                'disease_name' => 'Busuk Daun (Late Blight)',
                'confidence' => 0.974,
                'details' => [
                    'penyakit' => $solLate->disease_name,
                    'penyebab' => $solLate->cause,
                    'pestisida' => $solLate->pesticide,
                    'penyiraman' => $solLate->watering,
                    'pencegahan' => $solLate->prevention,
                ],
            ]);

            \App\Models\Detection::create([
                'user_id' => $petani2->id,
                'image_name' => $sampleImage,
                'disease_name' => 'Daun Kentang Sehat (Healthy)',
                'confidence' => 0.992,
                'details' => [
                    'penyakit' => $solHealthy->disease_name,
                    'penyebab' => $solHealthy->cause,
                    'pestisida' => $solHealthy->pesticide,
                    'penyiraman' => $solHealthy->watering,
                    'pencegahan' => $solHealthy->prevention,
                ],
            ]);

            \App\Models\Detection::create([
                'user_id' => $petani2->id,
                'image_name' => $sampleImage,
                'disease_name' => 'Bercak Kering (Early Blight)',
                'confidence' => 0.936,
                'details' => [
                    'penyakit' => $solEarly->disease_name,
                    'penyebab' => $solEarly->cause,
                    'pestisida' => $solEarly->pesticide,
                    'penyiraman' => $solEarly->watering,
                    'pencegahan' => $solEarly->prevention,
                ],
            ]);
        }
    }
}

