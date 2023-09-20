<?php

namespace Database\Seeders;

use App\Models\LetterCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For Dummy Purposes Not Real Datas
        $names = [
            "Surat Permohonan",
            "Surat Keputusan",
            "Surat Kuasa",
            "Surat Perintah",
            "Surat Pengantar",
            "Surat Edaran",
            "Surat Undangan"
        ];

        foreach ($names as $name) {
            LetterCategory::create([
                "name" => $name,
            ]);
        }

    }
}
