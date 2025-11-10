<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Alat Diagnostik',
                'description' => 'Peralatan untuk pemeriksaan dan diagnosis seperti tensimeter, stetoskop, dan termometer.',
            ],
            [
                'name' => 'Alat Laboratorium',
                'description' => 'Peralatan untuk laboratorium medis seperti mikroskop, tabung reaksi, dan centrifuge.',
            ],
            [
                'name' => 'Alat Bedah',
                'description' => 'Instrumen pembedahan seperti gunting bedah, pisau bedah, dan pinset.',
            ],
            [
                'name' => 'Peralatan Rehabilitasi',
                'description' => 'Peralatan terapi dan pemulihan pasien seperti kursi roda, walker, dan alat fisioterapi.',
            ],
            [
                'name' => 'Alat Sterilisasi',
                'description' => 'Peralatan sterilisasi seperti autoclave, UV sterilizer, dan alat pembersih instrumen medis.',
            ],
            [
                'name' => 'Alat Pelindung Diri (APD)',
                'description' => 'Peralatan pelindung seperti masker, sarung tangan medis, dan pakaian pelindung.',
            ],
            [
                'name' => 'Peralatan Gawat Darurat',
                'description' => 'Peralatan P3K, tandu, defibrillator, dan oxygen concentrator.',
            ],
            [
                'name' => 'Alat Kesehatan Rumah Tangga',
                'description' => 'Peralatan medis untuk kebutuhan rumah seperti alat cek gula darah, tensimeter digital, dan nebulizer.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
