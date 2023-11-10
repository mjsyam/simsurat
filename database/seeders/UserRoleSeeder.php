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
                'name' => "Ketua Jurusan Ilmu Kebumian dan Lingkungan",
            ],
            // 2
            [
                'name' => "Koordinator Prodi Teknik Material dan Metalurgi",
            ],
            // 3
            [
                'name' => "Koordinator Prodi Teknik Lingkungan",
            ],
            // 4
            [
                'name' => "Ketua Jurusan Matematika dan Teknologi Informasi",
            ],
            // 5
            [
                'name' => "Koordinator Prodi Matematika",
            ],
            // 6
            [
                'name' => "Koordinator Prodi Sistem Informasi",
            ],
            // 7
            [
                'name' => "Koordinator Prodi Informatika",
            ],
            // 8
            [
                'name' => "Koordinator Prodi Ilmu Aktuaria",
            ],
            // 9
            [
                'name' => "Koordinator Prodi Statistika",
            ],
            // 10
            [
                'name' => "Koordinator Prodi Bisnis Digital",
            ],
            // 11
            [
                'name' => "Ketua Jurusan Sains, Teknik Perkapalan, dan Kemariti",
            ],
            // 12
            [
                'name' => "Koordinator Prodi Fisika",
            ],
            // 13
            [
                'name' => "Koordinator Prodi Teknik Perkapalan",
            ],
            // 14
            [
                'name' => "Koordinator Prodi Teknik Kelautan",
            ],
            // 15
            [
                'name' => "Koordinator Prodi Teknologi Pangan",
            ],
            // 16
            [
                'name' => "Ketua Jurusan Teknik Sipil dan Perencanaan",
            ],
            // 17
            [
                'name' => "Koordinator Prodi Teknik Sipil",
            ],
            // 18
            [
                'name' => "Koordinator Prodi PWK",
            ],
            // 19
            [
                'name' => "Koordinator Prodi Arsitektur",
            ],
            // 20
            [
                'name' => "Koordinator Prodi Desain Komunikasi Visual",
            ],
            // 21
            [
                'name' => "Ketua Jurusan Teknologi Industri dan Proses",
            ],
            // 22
            [
                'name' => "Koordinator Prodi Teknik Mesin",
            ],
            // 23
            [
                'name' => "Koordinator Prodi Teknik Elektro",
            ],
            // 24
            [
                'name' => "Koordinator Prodi Teknik Kimia",
            ],
            // 25
            [
                'name' => "Koordinator Prodi Teknik Industri",
            ],
            // 26
            [
                'name' => "Koordinator Prodi Rekayasa Keselamatan",
            ],
            // 27
            [
                'name' => "Koordinator Prodi Teknik Logistik",
            ],
            // 28
            [
                'name' => "Ketua Lembaga Penelitian dan Pengabdian kepada Masyarakat",
            ],
            // 29
            [
                'name' => "Sekretaris Lembaga Penelitian dan Pengabdian kepada Masyarakat",
            ],
            // 30
            [
                'name' => "Koordinator Pusat Penelitian dan Publikasi Ilmiah",
            ],
            // 31
            [
                'name' => "Koordinator Pusat IBT",
            ],
            // 32
            [
                'name' => "Koordinator Pusat International Office",
            ],
            // 33
            [
                'name' => "Koordinator Pusat Pengembangan Pendidikan",
            ],
            // 34
            [
                'name' => "Wakil Koordinator Pusat Pengembangan Pendidikan",
            ],
            // 35
            [
                'name' => "Koordinator Pusat Pembinaan Kemahasiswaan dan Alumni",
            ],
            // 36
            [
                'name' => "Koordinator Pusat Penjaminan Mutu",
            ],
            // 37
            [
                'name' => "Koordinator Pusat E-Learning",
            ],
            // 38
            [
                'name' => "Koordinator Pusat Penelitian",
            ],
            // 39
            [
                'name' => "Koordinator Pusat Penelitian Energi",
            ],
            // 40
            [
                'name' => "Koordinator Pusat Penelitian Pangan Pertanian",
            ],
            // 41
            [
                'name' => "Koordinator Pusat Penelitian Smart City",
            ],
            // 42
            [
                'name' => "Koordinator Pusat HaKI",
            ],
            // 43
            [
                'name' => "Koordinator Pusat Laboratorium Terpadu",
            ],
            // 44
            [
                'name' => "Koordinator Pusat Pengembangan SDM",
            ],
            // 45
            [
                'name' => "Wakil Koordinator Pusat Pengembangan SDM",
            ],
            // 46
            [
                'name' => "Koordinator Pusat Pengembangan Strategis dan Infrastruktur",
            ],
            // 47
            [
                'name' => "Koordinator Pusat TPB dan MKU",
            ],
            // 48
            [
                'name' => "Koordinator Pusat ITK Press",
            ],
            // 49
            [
                'name' => "Koordinator Pusat Halal Center",
            ],
            // 50
            [
                'name' => "Koordinator Pusat Kerja sama dan Pengabdian kepada Masyarakat",
            ],
            // 51
            [
                'name' => "Koordinator PLP",
            ],
            // 52
            [
                'name' => "Rektor",
            ],
            // 53
            [
                'name' => "Wakil Rektor Bidang Akademik",
            ],
            // 54
            [
                'name' => "Wakil Rektor Bidang Non Akademik",
            ],
            // 55
            [
                'name' => "Koordinator Rumpun Akademik dan Kemahasiswaan",
            ],
            // 56
            [
                'name' => "Koordinator Rumpun Hubungan Masyarakat",
            ],
            // 57
            [
                'name' => "Koordinator Rumpun Kepegawaian",
            ],
            // 58
            [
                'name' => "Koordinator Rumpun Keuangan dan BMN",
            ],
            // 59
            [
                'name' => "Koordinator Rumpun Pengadaan",
            ],
            // 60
            [
                'name' => "Koordinator Rumpun Perencanaan",
            ],
            // 61
            [
                'name' => "Koordinator Rumpun Sarana Prasarana",
            ],
            // 62
            [
                'name' => "Ketua Tim Satuan Pengawas Internal (SPI)",
            ],
            // 63
            [
                'name' => "Kepala UPT Bahasa",
            ],
            // 64
            [
                'name' => "Kepala UPT Perpustakaan",
            ],
            // 65
            [
                'name' => "Kepala UPT Teknologi Informasi dan Komunikasi",
            ],
        ])->each(function ($role) {
            Role::create($role);
        });

        collect([
            // 1
            [
                'name' => "Jurusan Ilmu Kebumian dan Lingkungan",
            ],
            // 2
            [
                'name' => "Jurusan Matematika dan Teknologi Informasi",
            ],
            // 3
            [
                'name' => "Jurusan Sains, Teknik Perkapalan, dan Kemaritiman",
            ],
            // 4
            [
                'name' => "Jurusan Teknik Sipil dan Perencanaan",
            ],
            // 5
            [
                'name' => "Jurusan Teknologi Industri dan Proses",
            ],
            // 6
            [
                'name' => "Lembaga Penelitian dan Pengabdian kepada Masyarakat",
            ],
            // 7
            [
                'name' => "PLP",
            ],
            // 8
            [
                'name' => "Rektorat",
            ],
            // 9
            [
                'name' => "Rumpun Akademik dan Kemahasiswaan",
            ],
            // 10
            [
                'name' => "Rumpun Hubungan Masyarakat",
            ],
            // 11
            [
                'name' => "Rumpun Kepegawaian",
            ],
            // 12
            [
                'name' => "Rumpun Keuangan dan BMN",
            ],
            // 13
            [
                'name' => "Rumpun Pengadaan",
            ],
            // 14
            [
                'name' => "Rumpun Perencanaan",
            ],
            // 15
            [
                'name' => "Rumpun Sarana Prasarana",
            ],
            // 16
            [
                'name' => "Satuan Pengawas Internal (SPI)",
            ],
            // 17
            [
                'name' => "UPT Bahasa",
            ],
            // 18
            [
                'name' => "UPT Perpustakaan",
            ],
            // 19
            [
                'name' => "UPT Teknologi Informasi dan Komunikasi",
            ],
        ])->each(function ($unit) {
            Unit::create($unit);
        });

        collect([
            // 1 Ketua Jurusan Imu Kebumian dan Lingkungan - Jurusan Imu Kebumian dan Lingkungan
            [
                'unit_id' => 1,
                'role_id' => 1,
            ],
            // 2 Koordinator Prodi Teknik Material dan Metalurgi - Jurusan Imu Kebumian dan Lingkungan
            [
                'unit_id' => 1,
                'role_id' => 2,
            ],
            // 3 Koordinator Prodi Teknik Lingkungan - Jurusan Imu Kebumian dan Lingkungan
            [
                'unit_id' => 1,
                'role_id' => 3,
            ],
            // 4 Ketua Jurusan Matematika dan Teknologi Informasi - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 4,
            ],
            // 5 Koordinator Prodi Matematika - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 5,
            ],
            // 6 Koordinator Prodi Sistem Informasi - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 6,
            ],
            // 7 Koordinator Prodi Informatika - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 7,
            ],
            // 8 Koordinator Prodi Ilmu Aktuaria - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 8,
            ],
            // 9 Koordinator Prodi Statistika - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 9,
            ],
            // 10 Koordinator Prodi Bisnis Digital - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 10,
            ],
            // 11 Ketua Jurusan Sains, Teknik Perkapalan, dan Kemaritiman - Jurusan Sains, Teknik Perkapalan, dan Kemaritiman
            [
                'unit_id' => 3,
                'role_id' => 11,
            ],
            // 12 Koordinator Prodi Fisika - Jurusan Sains, Teknik Perkapalan, dan Kemaritiman
            [
                'unit_id' => 3,
                'role_id' => 12,
            ],
            // 13 Koordinator Prodi Teknik Perkapalan  
            [
                'unit_id' => 3,
                'role_id' => 13,
            ],
            // 14 Koordinator Prodi Teknik Kelautan - Jurusan Sains, Teknik Perkapalan, dan Kemaritiman
            [
                'unit_id' => 3,
                'role_id' => 14,
            ],
            // 15 Koordinator Prodi Teknologi Pangan - Jurusan Sains, Teknik Perkapalan, dan Kemaritiman
            [
                'unit_id' => 3,
                'role_id' => 15,
            ],
            // 16 Ketua Jurusan Teknik Sipil dan Perencanaan - Jurusan Teknik Sipil dan Perencanaan
            [
                'unit_id' => 4,
                'role_id' => 16,
            ],
            // 17 Koordinator Prodi Teknik Sipil - Jurusan Teknik Sipil dan Perencanaan
            [
                'unit_id' => 4,
                'role_id' => 17,
            ],
            // 18 Koordinator Prodi PWK - Jurusan Teknik Sipil dan Perencanaan
            [
                'unit_id' => 4,
                'role_id' => 18,
            ],
            // 19 Koordinator Prodi Arsitektur - Jurusan Teknik Sipil dan Perencanaan
            [
                'unit_id' => 4,
                'role_id' => 19,
            ],
            // 20 Koordinator Prodi Desain Komunikasi Visual - Jurusan Teknik Sipil dan Perencanaan
            [
                'unit_id' => 4,
                'role_id' => 20,
            ],
            // 21 Ketua Jurusan Teknologi Industri dan Proses - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 21,
            ],
            // 22 Koordinator Prodi Teknik Mesin - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 22,
            ],
            // 23 Koordinator Prodi Teknik Elektro - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 23,
            ],
            // 24 Koordinator Prodi Teknik Kimia - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 24,
            ],
            // 25 Koordinator Prodi Teknik Industri - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 25,
            ],
            // 26 Koordinator Prodi Rekayasa Keselamatan - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 26,
            ],
            // 27 Koordinator Prodi Teknik Logistik - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 27,
            ],
            // 28 Ketua Lembaga Penelitian dan Pengabdian kepada Masyarakat - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 28,
            ],
            // 29 Sekretaris Lembaga Penelitian dan Pengabdian kepada Masyarakat - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 29,
            ],
            // 30 Koordinator Pusat Penelitian dan Publikasi Ilmiah - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 30,
            ],
            // 31 Koordinator Pusat IBT - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 31,
            ],
            // 32 Koordinator Pusat International Office - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 32,
            ],
            // 33 Koordinator Pusat Pengembangan Pendidikan - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 33,
            ],
            // 34 Wakil Koordinator Pusat Pengembangan Pendidikan - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 34,
            ],
            // 35 Koordinator Pusat Pembinaan Kemahasiswaan dan Alumni - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 35,
            ],
            // 36 Koordinator Pusat Penjaminan Mutu - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 36,
            ],
            // 37 Koordinator Pusat E-Learning - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 37,
            ],
            // 38 Koordinator Pusat Penelitian - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 38,
            ],
            // 39 Koordinator Pusat Penelitian Energi - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 39,
            ],
            // 40 Koordinator Pusat Penelitian Pangan Pertanian - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 40,
            ],
            // 41 Koordinator Pusat Penelitian Smart City - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 41,
            ],
            // 42 Koordinator Pusat HaKI - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 42,
            ],
            // 43 Koordinator Pusat Laboratorium Terpadu - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 43,
            ],
            // 44 Koordinator Pusat Pengembangan SDM - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 44,
            ],
            // 45 Wakil Koordinator Pusat Pengembangan SDM - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 45,
            ],
            // 46 Koordinator Pusat Pengembangan Strategis dan Infrastruktur - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 46,
            ],
            // 47 Koordinator Pusat TPB dan MKU - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 47,
            ],
            // 48 Koordinator Pusat ITK Press - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 48,
            ],
            // 49 Koordinator Pusat Halal Center - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 49,
            ],
            // 50 Koordinator Pusat Kerja sama dan Pengabdian kepada Masyarakat - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 50,
            ],
            // 51 Koordinator PLP - PLP
            [
                'unit_id' => 7,
                'role_id' => 51,
            ],
            // 52 Rektor - Rektorat
            [
                'unit_id' => 8,
                'role_id' => 52,
            ],
            // 53 Wakil Rektor Bidang Akademik - Rektorat
            [
                'unit_id' => 8,
                'role_id' => 53,
            ],
            // 54 Wakil Rektor Bidang Non Akademik - Rektorat
            [
                'unit_id' => 8,
                'role_id' => 54,
            ],
            // 55 Koordinator Rumpun Akademik dan Kemahasiswaan - Rumpun Akademik dan Kemahasiswaan
            [
                'unit_id' => 9,
                'role_id' => 55,
            ],
            // 56 Koordinator Rumpun Hubungan Masyarakat - Rumpun Hubungan Masyarakat
            [
                'unit_id' => 10,
                'role_id' => 56,
            ],
            // 57 Koordinator Rumpun Kepegawaian - Rumpun Kepegawaian
            [
                'unit_id' => 11,
                'role_id' => 57,
            ],
            // 58 Koordinator Rumpun Keuangan dan BMN - Rumpun Keuangan dan BMN
            [
                'unit_id' => 12,
                'role_id' => 58,
            ],
            // 59 Koordinator Rumpun Pengadaan - Rumpun Pengadaan
            [
                'unit_id' => 13,
                'role_id' => 59,
            ],
            // 60 Koordinator Rumpun Perencanaan - Rumpun Perencanaan
            [
                'unit_id' => 14,
                'role_id' => 60,
            ],
            // 61 Koordinator Rumpun Sarana Prasarana - Rumpun Sarana Prasarana
            [
                'unit_id' => 15,
                'role_id' => 61,
            ],
            // 62 Ketua Tim Satuan Pengawas Internal (SPI) - Satuan Pengawas Internal (SPI)
            [
                'unit_id' => 16,
                'role_id' => 62,
            ],
            // 63 Kepala UPT Bahasa - UPT Bahasa
            [
                'unit_id' => 17,
                'role_id' => 63,
            ],
            // 64 Kepala UPT Perpustakaan - UPT Perpustakaan
            [
                'unit_id' => 18,
                'role_id' => 64,
            ],
            // 65 Kepala UPT Teknologi Informasi dan Komunikasi - UPT Teknologi Informasi dan Komunikasi
            [
                'unit_id' => 19,
                'role_id' => 65,
            ],
        ])->each(function ($identifier) {
            Identifier::create($identifier);
        });

        collect([
            // [
            //     'name' => "Admin",
            //     'email' => "superadmin@gmail.com",
            //     'status' => 'TENDIK',
            //     'email_verified_at' => now(),
            //     'password' => Hash::make('123456789'),
            //     'remember_token' => str::random(10),
            //     'number' => "0",
            //     'signature' => "beta",
            //     'avatar' => "beta",
            // ],

            // 1
            [
                'name' => "Jatmoko Awali, S.T., M.T.",
                'email' => "jatmoko.awali@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "1",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 2
            [
                'name' => "Fikan Mubarok Rohimsyah S.T., M.Sc",
                'email' => "fikan.mubarok@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "2",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 3
            [
                'name' => "Chandra Suryani Rahendaputri, B.Sc., M.Sc",
                'email' => "chandra.suryani03@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "3",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 4
            [
                'name' => "Irma Fitria, S.Si., M.Si",
                'email' => "irma.fitria@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "4",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 5
            [
                'name' => "Kartika Nugraheni, S.Si., M.Si",
                'email' => "kartikanheni@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "5",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 6
            [
                'name' => "Sri Rahayu Natasia, S.Komp., M.Si., M.Sc",
                'email' => "natasia.ayu@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "6",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 7
            [
                'name' => "Nisa Rizqiya Fadhliana, S.Kom., M.T.",
                'email' => "nisafadhliana@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "7",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 8
            [
                'name' => "Muhammad Azka, S.Si., M.Sc.",
                'email' => "muhammad.azka@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "8",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 9
            [
                'name' => "Syalam Ali Wira Dinata Simatupang, S.Si., M.Si.",
                'email' => "syalam_ali_wira_dinata@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "9",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 10
            [
                'name' => "Deli Yansyah, S.E., M.Acc., Ak., CA",
                'email' => "deli.yansyah@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "10",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 11
            [
                'name' => "Alamsyah, S.T., M.T.",
                'email' => "alamsyah@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "11",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 12
            [
                'name' => "Febrian Dedi Sastrawan, S.Si., M.Sc.",
                'email' => "febrian.dedi@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "12",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 13
            [
                'name' => "Suardi, S.T., M.T.",
                'email' => "suardi@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "13",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 14
            [
                'name' => "Destyariani Liana Putri, S.T., M.T.",
                'email' => "putridestyariani@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "14",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 15
            [
                'name' => "Anggela, S.TP., M.Sc.",
                'email' => "anggela@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "15",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 16
            [
                'name' => "Rizky Arif Nugroho, S.T., M.T.",
                'email' => "arif.rizky@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "16",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 17
            [
                'name' => "Dr. Hijriah",
                'email' => "hijriah@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "17",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 18
            [
                'name' => "Dr. Eng. Arief Hidayat",
                'email' => "arief.hidayat@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "18",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 19
            [
                'name' => "Sherlia, S.T., M.Eng.",
                'email' => "sherlia@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "19",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 20
            [
                'name' => "Supratiwi Amir, S.Ds., M.Sn.",
                'email' => "supratiwi.amir@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "20",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 21
            [
                'name' => "Andi Idhil Ismail, S.T., M.Sc., Ph.D.",
                'email' => "a.idhil@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "21",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 22
            [
                'name' => "Gad Gunawan, S.T., M.T.",
                'email' => "gad_gunawan@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "22",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 23
            [
                'name' => "Kharis Sugiarto, S.ST., M.T.",
                'email' => "kharis.sugiarto@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "23",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 24
            [
                'name' => "Lusi Ernawati, S.T., M.Sc.",
                'email' => "lusiernawati@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "24",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 25
            [
                'name' => "Muqimuddin, S.T., M.T.",
                'email' => "muqimuddin@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "25",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 26
            [
                'name' => "Adiek Astika Clara Sudarni, S. ST., M.T.",
                'email' => "adiek.astika@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "26",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 27
            [
                'name' => "Amanda Dwi Wantira, S.Tr., M.T.",
                'email' => "amanda.dwi@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "27",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 28
            [
                'name' => "Nita, S.Si.,M.Si., Ph.D.",
                'email' => "nita@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "28",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 29
            [
                'name' => "Barokatun Hasanah, S.T., M.T.",
                'email' => "barokatun.hasanah@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "29",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 30
            [
                'name' => "Nadia Almira Jordan, S.T., M.T.",
                'email' => "nadiajordan@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "30",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 31
            [
                'name' => "Himawan Wicaksono, S.ST., M.T.",
                'email' => "himawan@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "31",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 32
            [
                'name' => "Dr. Musyarofah, S.Pd., M.Si.",
                'email' => "musyarofah@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "32",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 33
            [
                'name' => "Happy Aprillia, S.ST., M.T., M.Eng., Ph.D",
                'email' => "happy.aprillia@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "33",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 34
            [
                'name' => "Amalia Nur Kumalaningrum, M.Agr.Sc.",
                'email' => "amalia.nur@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "34",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 35
            [
                'name' => "Chaerul Qalbi. AM, S.T., M.Sc.",
                'email' => "chaerul.qalbi@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "35",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 36
            [
                'name' => "Rifqi Aulia Tanjung, S.T., M.T.",
                'email' => "rifqi.aulia@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "36",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 37
            [
                'name' => "Ramadhan Paninggalih S.Si., M.Si., M.Sc.",
                'email' => "ramadhanpaninggalih@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "37",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 38
            [
                'name' => "M. Uswah Pawara, ST., M.Sus Sci",
                'email' => "uswah.pawara@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "38",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 39
            [
                'name' => "Dr. Swastya Rahastama, S.Si., M.Si.",
                'email' => "swastya.r@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "39",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 40
            [
                'name' => "Rahmi Azzahra, S.T.P., M.Sc",
                'email' => "rahmi.azzahra@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "40",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 41
            [
                'name' => "Maryo Inri Pratama, S.T., M.T.",
                'email' => "maryo.inri@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "41",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 42
            [
                'name' => "Dian Rahmawati, S.T.,M.EngSc.",
                'email' => "dian.rahmawati@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "42",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 43
            [
                'name' => "Adi Mahmud Jaya Marindra, S.T., M.Eng., Ph.D.",
                'email' => "adi.marindra@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "43",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 44
            [
                'name' => "Doddy Suanggana, S.T., M.T.",
                'email' => "doddy.suanggana@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "44",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 45
            [
                'name' => "Tiara Rukmaya Dewi, S.T., M.Sc.",
                'email' => "tiara.rukmaya@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 46
            [
                'name' => "Firilia Filiana, S.T., M.T.",
                'email' => "firilia.filiana@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 47
            [
                'name' => "Eko Agung Syaputra, M.Ds.",
                'email' => "eko.agung@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 48
            [
                'name' => "Fadeli Muhammad Habibie, S.T.P., M.P., M.Sc.",
                'email' => "fadeli.muhammad@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 49
            [
                'name' => "Azmia Riska Nafisah, S.T.,M.T.",
                'email' => "azmia.rizka@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 50
            [
                'name' => "Aries Rohiyanto, A.Md.",
                'email' => "aries.rohiyanto@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 51
            [
                'name' => "Prof. Dr. Agus Rubiyanto, M.Eng.Sc.",
                'email' => "rektor@itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 52
            [
                'name' => "Prof. Erma Suryani, S.T., M.T., Ph.D.",
                'email' => "wr1@itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 53
            [
                'name' => "Ir. Khakim Ghozali, M.MT.",
                'email' => "wr2@itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 54
            [
                'name' => "Ike Wayan Norma Yunita, S.Pd.",
                'email' => "wayanike@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 55
            [
                'name' => "Nabila Khaerunnisa, S.Kom",
                'email' => "nabila.khaerunnisa@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 56
            [
                'name' => "Reo Surya Delma, S.H.",
                'email' => "reo.delma@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 57
            [
                'name' => "Putri Sekar Wilis, S.E.",
                'email' => "putri.sekar@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 58
            [
                'name' => "Irfan Aprison, S. Kom.",
                'email' => "irfanaprison@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 59
            [
                'name' => "Muhammad Zulfikhar, S.E.",
                'email' => "muhammadzulfikar@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 60
            [
                'name' => "Ramdan Indra Lesmana, S.IP.",
                'email' => "ramdan.indra@itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 61
            [
                'name' => "Taufik Hidayat, S.T., M.T.",
                'email' => "taufik.hidayat@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 62
            [
                'name' => "Healty Susantiningdyah, S.Pd., MAppLing.",
                'email' => "susan@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 63
            [
                'name' => "Winarni, S.Si., M.Si.",
                'email' => "winarni@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
            // 64
            [
                'name' => "Syamsul Mujahidin, S.Kom., M.Eng.",
                'email' => "syamsul@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
            ],
        ])->map(function ($user) {
            User::create($user);
        });

        foreach (Identifier::all() as $key => $identifier) {
            if ($key + 1 == 45) {
                UserIdentifier::create([
                    'user_id' => 21,
                    'identifier_id' => $identifier->id,
                ]);
            }else if($key > 45){
                UserIdentifier::create([
                    'user_id' => $key,
                    'identifier_id' => $identifier->id,
                ]);
            }else{
                UserIdentifier::create([
                    'user_id' => $key + 1,
                    'identifier_id' => $identifier->id,
                ]);
            }
        }
    }
}
