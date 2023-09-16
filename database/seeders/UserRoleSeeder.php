<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

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
                'name' => "Tekndik Rektorat",
            ],
        ])->each(function($role){
            Role::create($role);
        });


        $roles = Role::all();
        $id = "1";
        foreach($roles as $role){
            User::whereId($id)->first()->assignRole($role);

            $id++;
        }

        User::create([
            'name' => "Anggina Haraha",
            'email' => "anggina@staff.itk.ac.id",
            'status' => 'DOSEN',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => str::random(10),
            'nip' => "0",
            'signature' => "beta",
            'avatar' => "beta",
        ])->assignRole('Tekndik Rektorat');

        User::create([
            'name' => "Prof. Erma Suryani, S.T., M.T., Ph.D",
            'email' => "wr2@itk.ac.id",
            'status' => 'DOSEN',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => str::random(10),
            'nip' => "197004272005012001",
            'signature' => "beta",
            'avatar' => "beta",
        ])->assignRole('Wakil Rektor');

        User::create([
            'name' => "Irma Fitria, S.Si., M.Si",
            'email' => "irma.fitria@lecturer.itk.ac.id",
            'status' => 'DOSEN',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => str::random(10),
            'nip' => "0",
            'signature' => "beta",
            'avatar' => "beta",
        ])->assignRole('Ketua JMTI');

        User::create([
            'name' => "Andi Idhil Ismail, S.T., M.Sc., Ph.D",
            'email' => "a.idhil@lecturer.itk.ac.id",
            'status' => 'DOSEN',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => str::random(10),
            'nip' => "0",
            'signature' => "beta",
            'avatar' => "beta",
        ])->assignRole('Ketua JTIP');
    }
}
