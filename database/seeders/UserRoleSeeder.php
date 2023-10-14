<?php

namespace Database\Seeders;

use App\Models\ModelHasRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name' => "Admin",
            ],
            // 1
            [
                'name' => "Rektor",
            ],
            // 2
            [
                'name' => "Wakil Rektor",
            ],

            // 3
            [
                'parent_id' => 3,
                'name' => "Kepala UPT Perpustakaan",
            ],
            // 4
            [
                'parent_id' => 3,
                'name' => "Kepala UPT Teknologi Informasi",
            ],
            // 5
            [
                'parent_id' => 3,
                'name' => "kepala UPT Bahasa",
            ],
            // 6
            [
                'parent_id' => 3,
                'name' => "Ketua JMTI",
            ],
            // 7
            [
                'parent_id' => 3,
                'name' => "Ketua JSTPM",
            ],
            // 8
            [
                'parent_id' => 3,
                'name' => "Ketua JTIP",
            ],
            // 9
            [
                'parent_id' => 3,
                'name' => "Ketua JTSP",
            ],
            // 10
            [
                'parent_id' => 3,
                'name' => "Ketua JIKL",
            ],

            // 11
            [
                'parent_id' => 3,
                'name' => "Kepala Biro Umum dan Akademik",
            ],
            // 12
            [
                'parent_id' => 11,
                'name' => "Kepala Bagian Akademik dan Perencanaan",
            ],
            // 13
            [
                'parent_id' => 11,
                'name' => "Kepala Bagian Umum dan Keuangan",
            ],

            // 14
            [
                'parent_id' => 12,
                'name' => "Kepala Subbagian Akademik dan Kemahasiswaan",
            ],
            // 15
            [
                'parent_id' => 12,
                'name' => "Kepala Subbagian Perencanaan",
            ],

            // 16
            [
                'parent_id' => 13,
                'name' => "Kepala Subbagian Umum dan Kepegawaian",
            ],
            // 17
            [
                'parent_id' => 13,
                'name' => "Kepala Subbagian Keuangan dan Barang Milik Negara",
            ],

            // 18
            [
                'parent_id' => 3,
                'name' => "LPPM",
            ],
            // 19
            [
                'parent_id' => 3,
                'name' => "Dosen dan JFT lainnya",
            ],
            // 20
            [
                'parent_id' => 3,
                'name' => "Tendik",
            ],
        ])->each(function ($role) {
            Role::create($role);
        });

        collect([
            [
                'name' => 'admin'
            ],
            [
                'name' => "Rektorat",
            ],
            [
                'name' => "JMTI"
            ],
            [
                "name" => "JTSPK"
            ],
            [
                "name" => "JTIP"
            ],
            [
                "name" => "JSTP"
            ],
            [
                "name" => "JIKL"
            ],
            [
                "parent_id" => 2,
                "name" => "Matematika"
            ],
            [
                "parent_id" => 2,
                "name" => "Informatika"
            ],
            [
                "parent_id" => 2,
                "name" => "Sistem Informasi"
            ],
            [
                "parent_id" => 2,
                "name" => "Ilmu Aktuaria"
            ],
            [
                "parent_id" => 2,
                "name" => "Statistika"
            ],
            [
                "parent_id" => 2,
                "name" => "Bisnis Digital"
            ],
            [
                "parent_id" => 3,
                "name" => "Fisika"
            ],
            [
                "parent_id" => 3,
                "name" => "Teknik Perkapalan"
            ],
            [
                "parent_id" => 3,
                "name" => "Teknik Kelautan"
            ],
            [
                "parent_id" => 3,
                "name" => "Teknologi Pangan"
            ],
            [
                "parent_id" => 4,
                "name" => "Teknik Elektro"
            ],
            [
                "parent_id" => 4,
                "name" => "Teknik Mesin"
            ],
            [
                "parent_id" => 4,
                "name" => "Teknik Kimira"
            ],
            [
                "parent_id" => 4,
                "name" => "Teknik Industri"
            ],
            [
                "parent_id" => 4,
                "name" => "Teknik Logistik"
            ],
            [
                "parent_id" => 4,
                "name" => "Rekayasa Keselamatan"
            ],
            [
                "parent_id" => 5,
                "name" => "Teknik Sipil"
            ],
            [
                "parent_id" => 5,
                "name" => "Perencanaan Wilayah dan Kota"
            ],
            [
                "parent_id" => 5,
                "name" => "Arsitektur"
            ],
            [
                "parent_id" => 5,
                "name" => "Desain Komunikasi Visual"
            ],
            [
                "parent_id" => 6,
                "name" => "Teknik Lingkungan"
            ],
            [
                "parent_id" => 6,
                "name" => "Teknik Material dan Metalurgi"
            ]
        ])->each(function ($unit) {
            Unit::create($unit);
        });


        $roles = Role::all();
        $id = "1";
        foreach ($roles as $role) {
            $unit_ids = Unit::all()->pluck('id')->toArray();
            $user = User::whereId($id)->first();
            $user->assignRole($role->name)->roles()->where('name', $role->name)->first()->pivot->update([
                'unit_id' => array_rand($unit_ids, 1)
            ]);
            $id++;
        }

        User::create([
            'name' => "Anggina Haraha",
            'email' => "anggina@staff.itk.ac.id",
            'status' => 'DOSEN',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => str::random(10),
            "identifier_id" => null,
            'nip' => "0",
            'signature' => "beta",
            'avatar' => "beta",
        ])->assignRole('Tekndik Rektorat')->roles()->where('name', 'Tekndik Rektorat')->first()->pivot->update([
            'unit_id' => 1
        ]);

        User::create([
            'name' => "Prof. Erma Suryani, S.T., M.T., Ph.D",
            'email' => "wr2@itk.ac.id",
            'status' => 'DOSEN',
            "identifier_id" => null,
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => str::random(10),
            'nip' => "197004272005012001",
            'signature' => "beta",
            'avatar' => "beta",
        ])->assignRole('Wakil Rektor')->roles()->where('name', 'Wakil Rektor')->first()->pivot->update([
            'unit_id' => 1
        ]);

        User::create([
            'name' => "Irma Fitria, S.Si., M.Si",
            'email' => "irma.fitria@lecturer.itk.ac.id",
            'status' => 'DOSEN',
            "identifier_id" => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => str::random(10),
            'nip' => "0",
            'signature' => "beta",
            'avatar' => "beta",
        ])->assignRole('Ketua JMTI')->roles()->where('name', 'Ketua JMTI')->first()->pivot->update([
            'unit_id' => 2
        ]);

        User::create([
            'name' => "Andi Idhil Ismail, S.T., M.Sc., Ph.D",
            'email' => "a.idhil@lecturer.itk.ac.id",
            'status' => 'DOSEN',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            "identifier_id" => 2,
            'remember_token' => str::random(10),
            'nip' => "0",
            'signature' => "beta",
            'avatar' => "beta",
        ])->assignRole('Ketua JTIP')->roles()->where('name', 'Ketua JTIP')->first()->pivot->update([
            'unit_id' => 4
        ]);
    }
}
