<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'role' => "admin",
            ],
            // 1
            [
                'role' => "rektor",
            ],
            // 2
            [
                'role' => "wakil rektor",
            ],

            // 3
            [
                'parent_id' => 1,
                'role' => "kepala upt perpustakaan",
            ],
            // 4
            [
                'parent_id' => 1,
                'role' => "kepala upt teknologi informasi",
            ],
            // 5
            [
                'parent_id' => 1,
                'role' => "kepala upt bahasa",
            ],
            // 6
            [
                'parent_id' => 1,
                'role' => "ketua jmti",
            ],
            // 7
            [
                'parent_id' => 1,
                'role' => "ketua jstpm",
            ],
            // 8
            [
                'parent_id' => 1,
                'role' => "ketua jtip",
            ],
            // 9
            [
                'parent_id' => 1,
                'role' => "ketua jtsp",
            ],
            // 10
            [
                'parent_id' => 1,
                'role' => "ketua jikl",
            ],

            // 11
            [
                'parent_id' => 1,
                'role' => "kepala biro umum dan akademik",
            ],
            // 12
            [
                'parent_id' => 11,
                'role' => "kepala bagian akademik dan perencanaan",
            ],
            // 13
            [
                'parent_id' => 11,
                'role' => "kepala bagian umum dan keuangan",
            ],

            // 14
            [
                'parent_id' => 12,
                'role' => "kepala subbagian akademik dan kemahasiswaan",
            ],
            // 15
            [
                'parent_id' => 12,
                'role' => "kepala subbagian perencanaan",
            ],

            // 16
            [
                'parent_id' => 13,
                'role' => "kepala subbagian umum dan kepegawaian",
            ],
            // 17
            [
                'parent_id' => 13,
                'role' => "kepala subbagian keuangan dan barang milik negara",
            ],

             // 18
             [
                'parent_id' => 1,
                'role' => "lppm",
            ],
             // 18
             [
                'parent_id' => 1,
                'role' => "dosen dan jft lainnya",
            ],
        ])->each(function($role){
            DB::table("roles")->insert($role);
        });
    }
}
