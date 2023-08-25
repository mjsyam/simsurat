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
            "Surat Masuk",
            "Surat Keluar",
            "Surat Internal",
            "Surat Eksternal",
        ];

        foreach ($names as $name) {
            LetterCategory::create([
                "name" => $name,
            ]);
        }
        
    }
}
