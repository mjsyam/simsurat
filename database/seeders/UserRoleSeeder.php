<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\Identifier;
use App\Models\User;
use App\Models\UserIdentifier;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            // 1
            [
                'name' => "Rektor",
            ],
            // 2
            [
                'name' => "Wakil Rektor Bidang Akademik",
            ],
            // 3
            [
                'name' => "Wakil Rektor Bidang Non Akademik",
            ],
            // 4
            [
                "name" => "Koordinator"
            ],
            // 5
            [
                "name" => "Wakil Koordinator"
            ],
            // 6
            [
                "name" => "Ketua"
            ],
            // 7
            [
                "name" => "Sekretaris"
            ],
            // 8
            [
                "name" => "Kepala"
            ]

            // 3
            // [
            //     'parent_id' => 3,
            //     'name' => "Kepala UPT Perpustakaan",
            // ],
            // // 4
            // [
            //     'parent_id' => 3,
            //     'name' => "Kepala UPT Teknologi Informasi",
            // ],
            // // 5
            // [
            //     'parent_id' => 3,
            //     'name' => "kepala UPT Bahasa",
            // ],
            // // 6
            // [
            //     'parent_id' => 3,
            //     'name' => "Ketua JMTI",
            // ],
            // // 7
            // [
            //     'parent_id' => 3,
            //     'name' => "Ketua JSTPM",
            // ],
            // // 8
            // [
            //     'parent_id' => 3,
            //     'name' => "Ketua JTIP",
            // ],
            // // 9
            // [
            //     'parent_id' => 3,
            //     'name' => "Ketua JTSP",
            // ],
            // // 10
            // [
            //     'parent_id' => 3,
            //     'name' => "Ketua JIKL",
            // ],

            // // 11
            // [
            //     'parent_id' => 3,
            //     'name' => "Kepala Biro Umum dan Akademik",
            // ],
            // // 12
            // [
            //     'parent_id' => 11,
            //     'name' => "Kepala Bagian Akademik dan Perencanaan",
            // ],
            // // 13
            // [
            //     'parent_id' => 11,
            //     'name' => "Kepala Bagian Umum dan Keuangan",
            // ],

            // // 14
            // [
            //     'parent_id' => 12,
            //     'name' => "Kepala Subbagian Akademik dan Kemahasiswaan",
            // ],
            // // 15
            // [
            //     'parent_id' => 12,
            //     'name' => "Kepala Subbagian Perencanaan",
            // ],

            // // 16
            // [
            //     'parent_id' => 13,
            //     'name' => "Kepala Subbagian Umum dan Kepegawaian",
            // ],
            // // 17
            // [
            //     'parent_id' => 13,
            //     'name' => "Kepala Subbagian Keuangan dan Barang Milik Negara",
            // ],

            // // 18
            // [
            //     'parent_id' => 3,
            //     'name' => "LPPM",
            // ],
            // // 19
            // [
            //     'parent_id' => 3,
            //     'name' => "Dosen dan JFT lainnya",
            // ],
            // // 20
            // [
            //     'parent_id' => 3,
            //     'name' => "Tendik",
            // ],
        ])->each(function ($role) {
            Role::create($role);
        });

        collect([
                // 1
                [
                    'name' => "Rektorat",
                ],
                // 2
                [
                    "parent_id" => 1,
                    "name" => "Rumpun Keuangan dan BMN"
                ],
                // 3
                [
                    "parent_id" => 1,
                    "name" => "Rumpun Kepegawaian"
                ],
                // 4
                [
                    "parent_id" => 1,
                    "name" => "Rumpun Sarana dan Prasarana"
                ],
                // 5
                [
                    "parent_id" => 1,
                    "name" => "Rumpun Hubungan Masyarakat"
                ],
                // 6
                [
                    "parent_id" => 1,
                    "name" => "Rumpun Perencanaan"
                ],
                // 7
                [
                    "parent_id" => 1,
                    "name" => "Rumpun Pengadaan"
                ],
                // 8
                [
                    "parent_id" => 1,
                    "name" => "Rumpun Akademik dan Kemahasiswaan"
                ],
                // 9
                [
                    "parent_id" => 1,
                    "name" => "Rumpun PLP"
                ],
                // 10
                [
                    'name' => "JMTI"
                ],
                // 11
                [
                    'name' => "JTSPK"
                ],
                // 12
                [
                    'name' => "JTIP"
                ],
                // 13
                [
                    'name' => "JSTP"
                ],
                // 14
                [
                    'name' => "JIKL"
                ],
                // 15
                [
                    "parent_id" => 11,
                    "name" => "Fisika"
                ],
                // 16
                [
                    "parent_id" => 10,
                    "name" => "Matematika"
                ],
                // 17
                [
                    "parent_id" => 12,
                    "name" => "Teknik Mesin"
                ],
                // 18
                [
                    "parent_id" => 12,
                    "name" => "Teknik Elektro"
                ],
                // 19
                [
                    "parent_id" => 12,
                    "name" => "Teknik Kimia"
                ],
                // 20
                [
                    "parent_id" => 14,
                    "name" => "Teknik Material dan Metalurgi"
                ],
                // 21
                [
                    "parent_id" => 13,
                    "name" => "Teknik Sipil"
                ],
                // 22
                [
                    "parent_id" => 13,
                    "name" => "Perencanaan Wilayah dan Kota"
                ],
                // 23
                [
                    "parent_id" => 11,
                    "name" => "Teknik Perkapalan"
                ],
                // 24
                [
                    "parent_id" => 10,
                    "name" => "Sistem Informasi"
                ],
                // 25
                [
                    "parent_id" => 10,
                    "name" => "Informatika"
                ],
                // 26
                [
                    "parent_id" => 12,
                    "name" => "Teknik Industri"
                ],
                // 27
                [
                    "parent_id" => 14,
                    "name" => "Teknik Lingkungan"
                ],
                // 28
                [
                    "parent_id" => 11,
                    "name" => "Teknik Kelautan"
                ],
                // 29
                [
                    "parent_id" => 10,
                    "name" => "Ilmu Aktuaria"
                ],
                // 30
                [
                    "parent_id" => 10,
                    "name" => "Statistika"
                ],
                // 31
                [
                    "parent_id" => 12,
                    "name" => "Arsitektur"
                ],
                // 32
                [
                    "parent_id" => 11,
                    "name" => "Teknologi Pangan"
                ],
                // 33
                [
                    "parent_id" => 13,
                    "name" => "Rekayasa Keselamatan"
                ],
                // 34
                [
                    "parent_id" => 10,
                    "name" => "Bisnis Digital"
                ],
                // 35
                [
                    "parent_id" => 11,
                    "name" => "Teknik Logistik"
                ],
                // 36
                [
                    "parent_id" => 12,
                    "name" => "Desain Komunikasi Visual"
                ],
                // 37
                [
                    'name' => "UPT Teknologi Informasi dan Komunikasi"
                ],
                // 38
                [
                    'name' => "UPT Bahasa"
                ],
                // 39
                [
                    'name' => "UPT Perpustakaan"
                ],
                // 40
                [
                    'name' => "Lembaga Penelitian dan Pengabdian kepada Masyarakat"
                ],
                // 41
                [
                    "parent_id" => 37,
                    "name" => "Pusat Penelitian dan Publikasi Ilmiah"
                ],
                // 42
                [
                    "parent_id" => 37,
                    "name" => "Inkubator Bisnis Teknologi"
                ],
                // 43
                [
                    "parent_id" => 37,
                    "name" => "International Office"
                ],
                // 44
                [
                    "parent_id" => 37,
                    "name" => "Pusat Pengembangan Pendidikan"
                ],
                // 45
                [
                    "parent_id" => 37,
                    "name" => "Pusat Pembinaan Kemahasiswaan dan Alumni"
                ],
                // 46
                [
                    "parent_id" => 37,
                    "name" => "Pusat Penjaminan Mutu"
                ],
                // 47
                [
                    "parent_id" => 37,
                    "name" => "Pusat E-Learning"
                ],
                // 48
                [
                    "parent_id" => 37,
                    "name" => "Pusat Penelitian"
                ],
                // 49
                [
                    "parent_id" => 37,
                    "name" => "Pusat Penelitian Energi"
                ],
                // 50
                [
                    "parent_id" => 37,
                    "name" => "Pusat Penelitian Pangan Pertanian"
                ],
                // 51
                [
                    "parent_id" => 37,
                    "name" => "Pusat Penelitian Smart City"
                ],
                // 52
                [
                    "parent_id" => 37,
                    "name" => "Pusat HaKI"
                ],
                // 53
                [
                    "parent_id" => 37,
                    "name" => "Pusat Laboratorium Terpadu"
                ],
                // 54
                [
                    "parent_id" => 37,
                    "name" => "Pusat Pengembangan SDM"
                ],
                // 55
                [
                    "parent_id" => 37,
                    "name" => "Pusat Pengembangan Strategis dan Infrastruktur"
                ],
                // 56
                [
                    "parent_id" => 37,
                    "name" => "Pusat TPB dan MKU"
                ],
                // 57
                [
                    "parent_id" => 37,
                    "name" => "Pusat ITK Press"
                ],
                // 58
                [
                    "parent_id" => 37,
                    "name" => "Pusat Halal Center"
                ],
                // 59
                [
                    "parent_id" => 37,
                    "name" => "Pusat Kerja sama dan Pengabdian kepada Masyarakat"
                ],
                // 60
                [
                    "parent_id" => 37,
                    "name" => "Tim Satuan Pengawas Internal (SPI)"
                ]


            ]
        )->each(function ($unit) {
            Unit::create($unit);
        });

        collect([
            // 1 Rektor - Rektorat
            [
                'unit_id' => 1,
                'role_id' => 1,
            ],
            // 2 Wakil Rektor Bidang Akademik - Rektorat
            [
                'unit_id' => 1,
                'role_id' => 2,
            ],
            // 3 Wakil Rektor Bidang Non Akademik - Rektorat
            [
                'unit_id' => 1,
                'role_id' => 3,
            ],
            // 4 Koordinator - Rumpun Keuangan dan BMN
            [
                'unit_id' => 2,
                'role_id' => 4,
            ],
            // 5 Koordinator - Rumpun Kepegawaian
            [
                'unit_id' => 3,
                'role_id' => 4,
            ],
            // 6 Koordinator - Rumpun Sarana dan Prasarana
            [
                'unit_id' => 4,
                'role_id' => 4,
            ],
            // 7 Koordinator - Rumpun Hubungan Masyarakat
            [
                'unit_id' => 5,
                'role_id' => 4,
            ],
            // 8 Koordinator - Rumpun Perencanaan
            [
                'unit_id' => 6,
                'role_id' => 4,
            ],
            // 9 Koordinator - Rumpun Pengadaan
            [
                'unit_id' => 7,
                'role_id' => 4,
            ],
            // 10 Koordinator - Rumpun Akademik dan Kemahasiswaan
            [
                'unit_id' => 8,
                'role_id' => 4,
            ],
            // 11 Koordinator - Rumpun PLP
            [
                'unit_id' => 9,
                'role_id' => 4,
            ],
            // 12 Ketua - JMTI
            [
                'unit_id' => 10,
                'role_id' => 6,
            ],
            // 13 Ketua - JTSPK
            [
                'unit_id' => 11,
                'role_id' => 6,
            ],
            // 14 Ketua - JTIP
            [
                'unit_id' => 12,
                'role_id' => 6,
            ],
            // 15 Ketua - JSTP
            [
                'unit_id' => 13,
                'role_id' => 6,
            ],
            // 16 Ketua - JIKL
            [
                'unit_id' => 14,
                'role_id' => 6,
            ],
            // 17 Koordinator - Fisika
            [
                'unit_id' => 15,
                'role_id' => 5,
            ],
            // 18 Koordinator - Matematika
            [
                'unit_id' => 16,
                'role_id' => 5,
            ],
            // 19 Koordinator - Teknik Mesin
            [
                'unit_id' => 17,
                'role_id' => 5,
            ],
            // 20 Koordinator - Teknik Elektro
            [
                'unit_id' => 18,
                'role_id' => 5,
            ],
            // 21 Koordinator - Teknik Kimia
            [
                'unit_id' => 19,
                'role_id' => 5,
            ],
            // 22 Koordinator - Teknik Material dan Metalurgi
            [
                'unit_id' => 20,
                'role_id' => 5,
            ],
            // 23 Koordinator - Teknik Sipil
            [
                'unit_id' => 21,
                'role_id' => 5,
            ],
            // 24 Koordinator - Perencanaan Wilayah dan Kota
            [
                'unit_id' => 22,
                'role_id' => 5,
            ],
            // 25 Koordinator - Teknik Perkapalan
            [
                'unit_id' => 23,
                'role_id' => 5,
            ],
            // 26 Koordinator - Sistem Informasi
            [
                'unit_id' => 24,
                'role_id' => 5,
            ],
            // 27 Koordinator - Informatika
            [
                'unit_id' => 25,
                'role_id' => 5,
            ],
            // 28 Koordinator - Teknik Industri
            [
                'unit_id' => 26,
                'role_id' => 5,
            ],
            // 29 Koordinator - Teknik Lingkungan
            [
                'unit_id' => 27,
                'role_id' => 5,
            ],
            // 30 Koordinator - Teknik Kelautan
            [
                'unit_id' => 28,
                'role_id' => 5,
            ],
            // 31 Koordinator - Ilmu Aktuaria
            [
                'unit_id' => 29,
                'role_id' => 5,
            ],
            // 32 Koordinator - Statistika
            [
                'unit_id' => 30,
                'role_id' => 5,
            ],
            // 33 Koordinator - Arsitektur
            [
                'unit_id' => 31,
                'role_id' => 5,
            ],
            // 34 Koordinator - Teknologi Pangan
            [
                'unit_id' => 32,
                'role_id' => 5,
            ],
            // 35 Koordinator - Rekayasa Keselamatan
            [
                'unit_id' => 33,
                'role_id' => 5,
            ],
            // 36 Koordinator - Bisnis Digital
            [
                'unit_id' => 34,
                'role_id' => 5,
            ],
            // 37 Koordinator - Teknik Logistik
            [
                'unit_id' => 35,
                'role_id' => 5,
            ],
            // 38 Koordinator - Desain Komunikasi Visual
            [
                'unit_id' => 36,
                'role_id' => 5,
            ],
            // 39 Kepala - UPT Teknologi Informasi dan Komunikasi
            [
                'unit_id' => 37,
                'role_id' => 8,
            ],
            // 40 Kepala - UPT Bahasa
            [
                'unit_id' => 38,
                'role_id' => 8,
            ],
            // 41 Kepala - UPT Perpustakaan
            [
                'unit_id' => 39,
                'role_id' => 8,
            ],
            // 42 Ketua - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 40,
                'role_id' => 6,
            ],
            // 43 Sekretaris - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 40,
                'role_id' => 7,
            ],
            // 44 Koordinator - Pusat Penelitian dan Publikasi Ilmiah
            [
                'unit_id' => 41,
                'role_id' => 5,
            ],
            // 45 Koordinator - Inkubator Bisnis Teknologi
            [
                'unit_id' => 42,
                'role_id' => 5,
            ],
            // 46 Koordinator - International Office
            [
                'unit_id' => 43,
                'role_id' => 5,
            ],
            // 47 Koordinator - Pusat Pengembangan Pendidikan
            [
                'unit_id' => 44,
                'role_id' => 5,
            ],
            // 49 Wakil Koordinator - Pusat Pengembangan Pendidikan
            [
                'unit_id' => 44,
                'role_id' => 5,
            ],
            // 50 Koordinator - Pusat Pembinaan Kemahasiswaan dan Alumni
            [
                'unit_id' => 45,
                'role_id' => 5,
            ],
            // 51 Koordinator - Pusat Penjaminan Mutu
            [
                'unit_id' => 46,
                'role_id' => 5,
            ],
            // 52 Koordinator - Pusat E-Learning
            [
                'unit_id' => 47,
                'role_id' => 5,
            ],
            // 53 Koordinator - Pusat Penelitian
            [
                'unit_id' => 48,
                'role_id' => 5,
            ],
            // 54 Koordinator - Pusat Penelitian Energi
            [
                'unit_id' => 49,
                'role_id' => 5,
            ],
            // 55 Koordinator - Pusat Penelitian Pangan Pertanian
            [
                'unit_id' => 50,
                'role_id' => 5,
            ],
            // 56 Koordinator - Pusat Penelitian Smart City
            [
                'unit_id' => 51,
                'role_id' => 5,
            ],
            // 57 Koordinator - Pusat HaKI
            [
                'unit_id' => 52,
                'role_id' => 5,
            ],
            // 58 Koordinator - Pusat Laboratorium Terpadu
            [
                'unit_id' => 53,
                'role_id' => 5,
            ],
            // 59 Koordinator - Pusat Pengembangan SDM
            [
                'unit_id' => 54,
                'role_id' => 5,
            ],
            // 60 Wakil Koordinator - Pusat Pengembangan SDM
            [
                'unit_id' => 54,
                'role_id' => 5,
            ],
            // 61 Koordinator - Pusat Pengembangan Strategis dan Infrastruktur
            [
                'unit_id' => 55,
                'role_id' => 5,
            ],
            // 62 Koordinator - Pusat TPB dan MKU
            [
                'unit_id' => 56,
                'role_id' => 5,
            ],
            // 63 Koordinator - Pusat ITK Press
            [
                'unit_id' => 57,
                'role_id' => 5,
            ],
            // 64 Koordinator - Pusat Halal Center
            [
                'unit_id' => 58,
                'role_id' => 5,
            ],
            // 65 Koordinator - Pusat Kerja sama dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 59,
                'role_id' => 5,
            ],
            // 66 Koordinator - Tim Satuan Pengawas Internal (SPI)
            [
                'unit_id' => 60,
                'role_id' => 5,
            ],

        ])->each(function ($identifier) {
            Identifier::create($identifier);
        });

        collect([
            [
                'unit_id' => 1,
                'name' => "Admin",
                'email' => "superadmin@gmail.com",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            [
                'unit_id' => 2,
                'name' => "Anggina Haraha",
                'email' => "anggina@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            [
                'unit_id' => 2,
                'name' => "Prof. Erma Suryani, S.T., M.T., Ph.D",
                'email' => "wr2@itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => str::random(10),
                'number' => "197004272005012001",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            [
                'unit_id' => 3,
                'name' => "Irma Fitria, S.Si., M.Si",
                'email' => "irma.fitria@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            [
                'unit_id' => 4,
                'name' => "Andi Idhil Ismail, S.T., M.Sc., Ph.D",
                'email' => "a.idhil@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ]
        ])->map(function ($user) {
            User::create($user);
        });

        UserIdentifier::create([
            'user_id' => 1,
            'identifier_id' => 1,
        ]);
        UserIdentifier::create([
            'user_id' => 2,
            'identifier_id' => 4,
        ]);
        UserIdentifier::create([
            'user_id' => 3,
            'identifier_id' => 3,
        ]);
        UserIdentifier::create([
            'user_id' => 4,
            'identifier_id' => 5,
        ]);
        UserIdentifier::create([
            'user_id' => 5,
            'identifier_id' => 6,
        ]);
    }
}
