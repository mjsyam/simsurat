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
use Illuminate\Support\Facades\Log;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            // lapisan 1
            // 1
            [
                'name' => "Rektor",
            ],

            // lapisan 2
            // 2
            [
                'name' => "Wakil Rektor Bidang Akademik",
                "parent_id" => "1",
            ],
            // 3
            [
                'name' => "Wakil Rektor Bidang Non Akademik",
                "parent_id" => "1",
            ],

            // lapisan 3
            // 3.2 {
            // 4
            [
                'name' => "Kepala UPT Teknologi Informasi dan Komunikasi",
                "parent_id" => "2",
            ],
            // 5
            [
                'name' => "Koordinator Rumpun Perencanaan",
                "parent_id" => "2",
            ],
            // 6
            [
                'name' => "Koordinator Rumpun Hubungan Masyarakat",
                "parent_id" => "2",
            ],
            // 7
            [
                'name' => "Koordinator Rumpun Kepegawaian",
                "parent_id" => "2",
            ],
            // 8
            [
                'name' => "Koordinator Rumpun Keuangan dan BMN",
                "parent_id" => "2",
            ],
            // 9
            [
                'name' => "Koordinator Rumpun Pengadaan",
                "parent_id" => "2",
            ],
            // 10
            [
                'name' => "Koordinator Rumpun Sarana Prasarana",
                "parent_id" => "2",
            ],
            // 11
            [
                'name' => "Ketua Tim Satuan Pengawas Internal (SPI)",
                "parent_id" => "2",
            ],
            // }

            // 3.3 {
            // 12
            [
                'name' => "Ketua Jurusan Matematika dan Teknologi Informasi",
                "parent_id" => "3",
            ],
            // 13
            [
                'name' => "Ketua Jurusan Sains, Teknik Perkapalan, dan Kemaritiman",
                "parent_id" => "3",
            ],
            // 14
            [
                'name' => "Ketua Jurusan Teknologi Industri dan Proses",
                "parent_id" => "3",
            ],
            // 15
            [
                'name' => "Ketua Jurusan Teknik Sipil dan Perencanaan",
                "parent_id" => "3",
            ],
            // 16
            [
                'name' => "Ketua Jurusan Ilmu Kebumian dan Lingkungan",
                "parent_id" => "3",
            ],
            // 17
            [
                'name' => "Kepala UPT Bahasa",
                "parent_id" => "3",
            ],
            // 18
            [
                'name' => "Kepala UPT Perpustakaan",
                "parent_id" => "3",
            ],
            // 19
            [
                'name' => "Ketua Lembaga Penelitian dan Pengabdian kepada Masyarakat",
                "parent_id" => "3",
            ],
            // 20
            [
                'name' => "Koordinator Rumpun Akademik dan Kemahasiswaan",
                "parent_id" => "3",
            ],
            // }

            // lapisan 4
            // 4.12 {
            // 21
            [
                'name' => "Koordinator Prodi Matematika",
                "parent_id" => "12",
            ],
            // 22
            [
                'name' => "Koordinator Prodi Informatika",
                "parent_id" => "12",
            ],
            // 23
            [
                'name' => "Koordinator Prodi Sistem Informasi",
                "parent_id" => "12",
            ],
            // 24
            [
                'name' => "Koordinator Prodi Ilmu Aktuaria",
                "parent_id" => "12",
            ],
            // 25
            [
                'name' => "Koordinator Prodi Statistika",
                "parent_id" => "12",
            ],
            // 26
            [
                'name' => "Koordinator Prodi Bisnis Digital",
                "parent_id" => "12",
            ],
            // }

            // lapisan 4
            // 4.13 {
            // 27
            [
                'name' => "Koordinator Prodi Fisika",
                "parent_id" => "13",
            ],
            // 28
            [
                'name' => "Koordinator Prodi Teknik Perkapalan",
                "parent_id" => "13",
            ],
            // 29
            [
                'name' => "Koordinator Prodi Teknik Kelautan",
                "parent_id" => "13",
            ],
            // 30
            [
                'name' => "Koordinator Prodi Teknologi Pangan",
                "parent_id" => "13",
            ],
            // }

            // lapisan 4
            // 4.14 {
            // 31
            [
                'name' => "Koordinator Prodi Teknik Mesin",
                "parent_id" => "14",
            ],
            // 32
            [
                'name' => "Koordinator Prodi Teknik Elektro",
                "parent_id" => "14",
            ],
            // 33
            [
                'name' => "Koordinator Prodi Teknik Kimia",
                "parent_id" => "14",
            ],
            // 34
            [
                'name' => "Koordinator Prodi Teknik Industri",
                "parent_id" => "14",
            ],
            // 35
            [
                'name' => "Koordinator Prodi Rekayasa Keselamatan",
                "parent_id" => "14",
            ],
            // 36
            [
                'name' => "Koordinator Prodi Teknik Logistik",
                "parent_id" => "14",
            ],
            // }

            // lapisan 4
            // 4.15 {
            // 37
            [
                'name' => "Koordinator Prodi Teknik Sipil",
                "parent_id" => "15",
            ],
            // 38
            [
                'name' => "Koordinator Prodi Perencanaan Wilayah dan Kota",
                "parent_id" => "15",
            ],
            // 39
            [
                'name' => "Koordinator Prodi Arsitektur",
                "parent_id" => "15",
            ],
            // 40
            [
                'name' => "Koordinator Prodi Desain Komunikasi Visual",
                "parent_id" => "15",
            ],
            // }

            // lapisan 4
            // 4.16 {
            // 41
            [
                'name' => "Koordinator Prodi Teknik Lingkungan",
                "parent_id" => "16",
            ],
            // 42
            [
                'name' => "Koordinator Prodi Teknik Material dan Metalurgi",
                "parent_id" => "16",
            ],
            // }

            // Lapisan 4
            // 4.19 {
            // 43
            [
                'name' => "Koordinator Pusat Penelitian dan Publikasi Ilmiah",
                "parent_id" => "19",
            ],
            // 44
            [
                'name' => "Koordinator Pusat Pengabdian Kepada Masyarakat dan Kerja sama ",
                "parent_id" => "19",
            ],
            // 45
            [
                // Koordinator Pusat HaKI
                'name' => "Koordinator Pusat Hak atas Kekayaan Intelektual",
                "parent_id" => "19",
            ],
            // 46
            [
                // Koordinator Pusat IBT
                'name' => "Koordinator Pusat Inkubator Bisnis Teknologi",
                "parent_id" => "19",
            ],
            // 47
            [
                'name' => "Koordinator Pusat Pengembangan Pendidikan",
                "parent_id" => "19",
            ],
            // 48
            [
                'name' => "Koordinator Pusat Pembinaan Kemahasiswaan dan Alumni",
                "parent_id" => "19",
            ],
            // 49
            [
                'name' => "Koordinator Pusat Penjaminan Mutu",
                "parent_id" => "19",
            ],
            // 50
            [
                // Koordinator Pusat TPB dan MKU
                'name' => "Koordinator Pusat Tahap Persiapan Bersama dan Mata Kuliah Umum",
                "parent_id" => "19",
            ],
            // 51
            [
                'name' => "Koordinator Pusat E-Learning",
                "parent_id" => "19",
            ],
            // 52
            [
                'name' => "Koordinator Pusat Penelitian Kemaritiman",
                "parent_id" => "19",
            ],
            // 53
            [
                'name' => "Koordinator Pusat Penelitian Energi",
                "parent_id" => "19",
            ],
            // 54
            [
                'name' => "Koordinator Pusat Penelitian Pangan Pertanian",
                "parent_id" => "19",
            ],
            // 55
            [
                'name' => "Koordinator Pusat Penelitian Smart City",
                "parent_id" => "19",
            ],
            // 56
            [
                'name' => "Koordinator Pusat Laboratorium Terpadu",
                "parent_id" => "19",
            ],
            // 57
            [
                'name' => "Koordinator Pusat Pengembangan SDM",
                "parent_id" => "19",
            ],
            // 58
            [
                'name' => "Koordinator Pusat Pengembangan Strategis dan Infrastruktur",
                "parent_id" => "19",
            ],
            // 59
            [
                'name' => "Koordinator Pusat International Office",
                "parent_id" => "19",
            ],
            // 60
            [
                'name' => "Koordinator Pusat Halal Center",
                "parent_id" => "19",
            ],
            // 61
            [
                'name' => "Sekretaris Lembaga Penelitian dan Pengabdian kepada Masyarakat",
                "parent_id" => "19",
            ],

            // }

            // Lapisan 5
            // 5.57
            // 62
            [
                'name' => "Wakil Koordinator Pusat Pengembangan SDM",
                "parent_id" => "57",
            ],
            // 5.47
            // 63
            [
                'name' => "Wakil Koordinator Pusat Pengembangan Pendidikan",
                "parent_id" => "47",
            ],

            // agak ramdom
            // 64
            [
                'name' => "Koordinator Pusat Penelitian",
                "parent_id" => "19",
            ],
            // 65
            [
                'name' => "Koordinator Pusat ITK Press",
                "parent_id" => "19",
            ],
            // 66
            [
                'name' => "Koordinator PLP",
                "parent_id" => "3",
            ],
            // 67
            [
                'name' => "Kepala Biro Umum dan Akademik",
                "parent_id" => "3",
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
            // 1 Ketua Jurusan Ilmu Kebumian dan Lingkungan - Jurusan Ilmu Kebumian dan Lingkungan
            [
                'unit_id' => 1,
                'role_id' => 16,
            ],
            // 2 Koordinator Prodi Teknik Material dan Metalurgi - Jurusan Ilmu Kebumian dan Lingkungan
            [
                'unit_id' => 1,
                'role_id' => 42,
            ],
            // 3 Koordinator Prodi Teknik Lingkungan - Jurusan Ilmu Kebumian dan Lingkungan
            [
                'unit_id' => 1,
                'role_id' => 41,
            ],
            // 4 Ketua Jurusan Matematika dan Teknologi Informasi - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 12,
            ],
            // 5 Koordinator Prodi Matematika - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 21,
            ],
            // 6 Koordinator Prodi Sistem Informasi - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 23,
            ],
            // 7 Koordinator Prodi Informatika - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 22,
            ],
            // 8 Koordinator Prodi Ilmu Aktuaria - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 24,
            ],
            // 9 Koordinator Prodi Statistika - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 25,
            ],
            // 10 Koordinator Prodi Bisnis Digital - Jurusan Matematika dan Teknologi Informasi
            [
                'unit_id' => 2,
                'role_id' => 26,
            ],
            // 11 Ketua Jurusan Sains, Teknik Perkapalan, dan Kemaritiman - Jurusan Sains, Teknik Perkapalan, dan Kemaritiman
            [
                'unit_id' => 3,
                'role_id' => 13,
            ],
            // 12 Koordinator Prodi Fisika - Jurusan Sains, Teknik Perkapalan, dan Kemaritiman
            [
                'unit_id' => 3,
                'role_id' => 27,
            ],
            // 13 Koordinator Prodi Teknik Perkapalan
            [
                'unit_id' => 3,
                'role_id' => 28,
            ],
            // 14 Koordinator Prodi Teknik Kelautan - Jurusan Sains, Teknik Perkapalan, dan Kemaritiman
            [
                'unit_id' => 3,
                'role_id' => 29,
            ],
            // 15 Koordinator Prodi Teknologi Pangan - Jurusan Sains, Teknik Perkapalan, dan Kemaritiman
            [
                'unit_id' => 3,
                'role_id' => 30,
            ],
            // 16 Ketua Jurusan Teknik Sipil dan Perencanaan - Jurusan Teknik Sipil dan Perencanaan
            [
                'unit_id' => 4,
                'role_id' => 15,
            ],
            // 17 Koordinator Prodi Teknik Sipil - Jurusan Teknik Sipil dan Perencanaan
            [
                'unit_id' => 4,
                'role_id' => 37,
            ],
            // 18 Koordinator Prodi PWK - Jurusan Teknik Sipil dan Perencanaan
            [
                'unit_id' => 4,
                'role_id' => 38,
            ],
            // 19 Koordinator Prodi Arsitektur - Jurusan Teknik Sipil dan Perencanaan
            [
                'unit_id' => 4,
                'role_id' => 39,
            ],
            // 20 Koordinator Prodi Desain Komunikasi Visual - Jurusan Teknik Sipil dan Perencanaan
            [
                'unit_id' => 4,
                'role_id' => 40,
            ],
            // 21 Ketua Jurusan Teknologi Industri dan Proses - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 14,
            ],
            // 22 Koordinator Prodi Teknik Mesin - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 31,
            ],
            // 23 Koordinator Prodi Teknik Elektro - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 32,
            ],
            // 24 Koordinator Prodi Teknik Kimia - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 33,
            ],
            // 25 Koordinator Prodi Teknik Industri - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 34,
            ],
            // 26 Koordinator Prodi Rekayasa Keselamatan - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 35,
            ],
            // 27 Koordinator Prodi Teknik Logistik - Jurusan Teknologi Industri dan Proses
            [
                'unit_id' => 5,
                'role_id' => 36,
            ],
            // 28 Ketua Lembaga Penelitian dan Pengabdian kepada Masyarakat - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 19,
            ],
            // 29 Sekretaris Lembaga Penelitian dan Pengabdian kepada Masyarakat - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 61,
            ],
            // 30 Koordinator Pusat Penelitian dan Publikasi Ilmiah - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 43,
            ],
            // 31 Koordinator Pusat IBT - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 46,
            ],
            // 32 Koordinator Pusat International Office - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 59,
            ],
            // 33 Koordinator Pusat Pengembangan Pendidikan - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 47,
            ],
            // 34 Wakil Koordinator Pusat Pengembangan Pendidikan - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 63,
            ],
            // 35 Koordinator Pusat Pembinaan Kemahasiswaan dan Alumni - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 48,
            ],
            // 36 Koordinator Pusat Penjaminan Mutu - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 49,
            ],
            // 37 Koordinator Pusat E-Learning - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 51,
            ],
            // 38 Koordinator Pusat Penelitian - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 64,
            ],
            // 39 Koordinator Pusat Penelitian Energi - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 53,
            ],
            // 40 Koordinator Pusat Penelitian Pangan Pertanian - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 54,
            ],
            // 41 Koordinator Pusat Penelitian Smart City - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 55,
            ],
            // 42 Koordinator Pusat HaKI - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 45,
            ],
            // 43 Koordinator Pusat Laboratorium Terpadu - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 56,
            ],
            // 44 Koordinator Pusat Pengembangan SDM - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 57,
            ],
            // 45 Wakil Koordinator Pusat Pengembangan SDM - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 62,
            ],
            // 46 Koordinator Pusat Pengembangan Strategis dan Infrastruktur - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 58,
            ],
            // 47 Koordinator Pusat TPB dan MKU - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 50,
            ],
            // 48 Koordinator Pusat ITK Press - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 65,
            ],
            // 49 Koordinator Pusat Halal Center - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 60,
            ],
            // 50 Koordinator Pusat Pengabdian Kepada Masyarakat dan Kerja sama - Lembaga Penelitian dan Pengabdian kepada Masyarakat
            [
                'unit_id' => 6,
                'role_id' => 44,
            ],
            // 51 Koordinator PLP - PLP
            [
                'unit_id' => 7,
                'role_id' => 66,
            ],
            // 52 Rektor - Rektorat
            [
                'unit_id' => 8,
                'role_id' => 1,
            ],
            // 53 Wakil Rektor Bidang Akademik - Rektorat
            [
                'unit_id' => 8,
                'role_id' => 2,
            ],
            // 54 Wakil Rektor Bidang Non Akademik - Rektorat
            [
                'unit_id' => 8,
                'role_id' => 3,
            ],
            // 55 Koordinator Rumpun Akademik dan Kemahasiswaan - Rumpun Akademik dan Kemahasiswaan
            [
                'unit_id' => 9,
                'role_id' => 20,
            ],
            // 56 Koordinator Rumpun Hubungan Masyarakat - Rumpun Hubungan Masyarakat
            [
                'unit_id' => 10,
                'role_id' => 6,
            ],
            // 57 Koordinator Rumpun Kepegawaian - Rumpun Kepegawaian
            [
                'unit_id' => 11,
                'role_id' => 7,
            ],
            // 58 Koordinator Rumpun Keuangan dan BMN - Rumpun Keuangan dan BMN
            [
                'unit_id' => 12,
                'role_id' => 8,
            ],
            // 59 Koordinator Rumpun Pengadaan - Rumpun Pengadaan
            [
                'unit_id' => 13,
                'role_id' => 9,
            ],
            // 60 Koordinator Rumpun Perencanaan - Rumpun Perencanaan
            [
                'unit_id' => 14,
                'role_id' => 5,
            ],
            // 61 Koordinator Rumpun Sarana Prasarana - Rumpun Sarana Prasarana
            [
                'unit_id' => 15,
                'role_id' => 10,
            ],
            // 62 Ketua Tim Satuan Pengawas Internal (SPI) - Satuan Pengawas Internal (SPI)
            [
                'unit_id' => 16,
                'role_id' => 11,
            ],
            // 63 Kepala UPT Bahasa - UPT Bahasa
            [
                'unit_id' => 17,
                'role_id' => 17,
            ],
            // 64 Kepala UPT Perpustakaan - UPT Perpustakaan
            [
                'unit_id' => 18,
                'role_id' => 18,
            ],
            // 65 Kepala UPT Teknologi Informasi dan Komunikasi - UPT Teknologi Informasi dan Komunikasi
            [
                'unit_id' => 19,
                'role_id' => 4,
            ],
            // 66 Kepala Biro Umum dan Akademik - Rektorat
            [
                'unit_id' => 8,
                'role_id' => 67,
            ],
        ])->each(function ($identifier) {
            Identifier::create($identifier);
        });

        // 6285259367474
        // 6285895165709
        // 6287854257246
        // 6282183755464
        // 6281347565630
        // 6281363123365
        // 6282148788999
        // 6282326200076
        // 6285363220512
        // 6285768333807
        // 6285242800578
        // 6285341112790
        // 6285244317201
        // 6285649312537
        // 6281360650330
        // 6281393177723
        // 6285396942508
        // 6281317666677
        // 6287753372399
        // 6285255605456
        // 6281242608799
        // 6285282814331
        // 6282338264877
        // 6282236719503
        // 628991333570
        // 6281238326787
        // 6287877091800
        // 6281234550536
        // 6282130717329
        // 6281217580491
        // 6285250651451
        // 628971554763
        // 6281347087013
        // 6282245439445
        // 6281257004114
        // 6281348494529
        // 6289639003412



        // 6285256166864

        // 6282155237471
        // 6281355844412

        // 6282243137654
        // 6282257451955
        // 6281224661190
        // 6281217183412


        // 6281330686130
        // 6281231352063
        // 628990945520
        // 6285387380122
        // 6282393892599
        // 6285725659195
        // 6281258668666

        collect([
            [
                "unit_id" => "8",
                'name' => "Admin",
                'email' => "superadmin@gmail.com",
                'status' => 'ADMIN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => str::random(10),
                'number' => "0",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "1",
            ],

            // 1
            [
                'name' => "Jatmoko Awali, S.T., M.T.",
                'email' => "jatmoko.awali@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "1",
                'phone_number' => '6285259367474',
                "unit_id" => "1",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "1",
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
                'phone_number' => '6285895165709',
                "unit_id" => "1",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "2",
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
                'phone_number' => '6287854257246',
                "unit_id" => "1",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "3",
            ],
            // 4
            [
                'unit_id' => 3,
                'name' => "Irma Fitria, S.Si., M.Si",
                'email' => "irma.fitria@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "4",
                'phone_number' => '6282183755464',
                "unit_id" => "2",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "4",
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
                'phone_number' => '6281347565630',
                "unit_id" => "2",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "5",
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
                'phone_number' => '6281363123365',
                "unit_id" => "2",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "6",
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
                'phone_number' => '6282148788999',
                "unit_id" => "2",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "7",
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
                'phone_number' => '6282326200076',
                "unit_id" => "2",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "8",
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
                'phone_number' => '6285363220512',
                "unit_id" => "2",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "9",
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
                'phone_number' => '6285768333807',
                "unit_id" => "2",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "10",
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
                'phone_number' => '6285242800578',
                "unit_id" => "3",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "11",
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
                'phone_number' => '6285341112790',
                "unit_id" => "3",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "12",
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
                'phone_number' => '6285244317201',
                "unit_id" => "3",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "13",
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
                'phone_number' => '6285649312537',
                "unit_id" => "3",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "14",
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
                'phone_number' => '6281360650330',
                "unit_id" => "3",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "15",
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
                'phone_number' => '6281393177723',
                "unit_id" => "4",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "16",
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
                'phone_number' => '6285396942508',
                "unit_id" => "4",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "17",
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
                'phone_number' => '6281317666677',
                "unit_id" => "4",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "18",
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
                'phone_number' => '6287753372399',
                "unit_id" => "4",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "19",
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
                'phone_number' => '6285255605456',
                "unit_id" => "4",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "20",
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
                'phone_number' => '6281242608799',
                "unit_id" => "5",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "21",
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
                'phone_number' => '6285282814331',
                "unit_id" => "5",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "22",
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
                'phone_number' => '6282338264877',
                "unit_id" => "5",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "23",
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
                'phone_number' => '6282236719503',
                "unit_id" => "5",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "24",
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
                'phone_number' => '628991333570',
                "unit_id" => "5",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "25",
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
                'phone_number' => '6281238326787',
                "unit_id" => "5",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "26",
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
                'phone_number' => '6287877091800',
                "unit_id" => "5",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "27",
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
                'phone_number' => '6281234550536',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "28",
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
                'phone_number' => '6282130717329',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "29",
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
                'phone_number' => '6281217580491',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "30",
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
                'phone_number' => '6285250651451',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "31",
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
                'phone_number' => '628971554763',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "32",
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
                'phone_number' => '6281347087013',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "33",
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
                'phone_number' => '6282245439445',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "34",
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
                'phone_number' => '6281257004114',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "35",
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
                'phone_number' => '6281348494529',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "36",
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
                'phone_number' => '6289639003412',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "37",
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
                'phone_number' => '',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "38",
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
                'phone_number' => '',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "39",
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
                'phone_number' => '',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "40",
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
                'phone_number' => '6285256166864',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "41",
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
                'phone_number' => '',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "42",
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
                'phone_number' => '6282155237471',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "43", // Add identifier_id
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
                'phone_number' => '6281355844412',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "44", // Add identifier_id
            ],
            // 45
            // [
            //     'name' => "Andi Idhil Ismail, S.T., M.Sc., Ph.D.",
            //     'email' => "a.idhil@lecturer.itk.ac.id",
            //     'status' => 'DOSEN',
            //     'email_verified_at' => now(),
            //     'password' => Hash::make('123456789'),
            //     'remember_token' => Str::random(10),
            //     'number' => "44",
            //     "unit_id" => "6",
            //     'signature' => "beta",
            //     'avatar' => "beta",
            //     'identifier_id' => "45", // Add identifier_id
            // ],
            // 46
            [
                'name' => "Tiara Rukmaya Dewi, S.T., M.Sc.",
                'email' => "tiara.rukmaya@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6282243137654',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "46", // Add identifier_id
            ],
            // 47
            [
                'name' => "Firilia Filiana, S.T., M.T.",
                'email' => "firilia.filiana@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6282257451955',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "47", // Add identifier_id
            ],
            // 48
            [
                'name' => "Eko Agung Syaputra, M.Ds.",
                'email' => "eko.agung@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6281224661190',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "48", // Add identifier_id
            ],
            // 49
            [
                'name' => "Fadeli Muhammad Habibie, S.T.P., M.P., M.Sc.",
                'email' => "fadeli.muhammad@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6281217183412',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "49", // Add identifier_id
            ],
            // 50
            [
                'name' => "Azmia Riska Nafisah, S.T.,M.T.",
                'email' => "azmia.rizka@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6282243137654',
                "unit_id" => "6",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "50", // Add identifier_id
            ],
            // 51
            [
                'name' => "Aries Rohiyanto, A.Md.",
                'email' => "aries.rohiyanto@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '',
                "unit_id" => "7",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "51", // Add identifier_id
            ],
            // 52
            [
                'name' => "Prof. Dr. Agus Rubiyanto, M.Eng.Sc.",
                'email' => "rektor@itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6281330686130',
                "unit_id" => "8",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "52", // Add identifier_id
            ],
            // 53
            [
                'name' => "Prof. Erma Suryani, S.T., M.T., Ph.D.",
                'email' => "wr1@itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6281231352063',
                "unit_id" => "8",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "53", // Add identifier_id
            ],
            // 54
            [
                'name' => "Ir. Khakim Ghozali, M.MT.",
                'email' => "wr2@itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '628990945520',
                "unit_id" => "8",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "54", // Add identifier_id
            ],
            // 55
            [
                'name' => "Ike Wayan Norma Yunita, S.Pd.",
                'email' => "wayanike@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6285387380122',
                "unit_id" => "9",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "55", // Add identifier_id
            ],
            // 56
            [
                'name' => "Nabila Khaerunnisa, S.Kom",
                'email' => "nabila.khaerunnisa@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6282393892599',
                'unit_id' => "10",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "56", // Add identifier_id
            ],
            // 57
            [
                'name' => "Reo Surya Delma, S.H.",
                'email' => "reo.delma@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6285725659195',
                "unit_id" => "11",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "57", // Add identifier_id
            ],
            // 58
            [
                'name' => "Putri Sekar Wilis, S.E.",
                'email' => "putri.sekar@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6281258668666',
                "unit_id" => "12",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "58", // Add identifier_id
            ],
            // 59
            [
                'name' => "Irfan Aprison, S. Kom.",
                'email' => "irfanaprison@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '',
                "unit_id" => "13",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "59", // Add identifier_id
            ],
            // 60
            [
                'name' => "Muhammad Zulfikhar, S.E.",
                'email' => "muhammadzulfikar@staff.itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '',
                "unit_id" => "14",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "60", // Add identifier_id
            ],
            // 61
            [
                'name' => "Ramdan Indra Lesmana, S.IP.",
                'email' => "ramdan.indra@itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '',
                "unit_id" => "15",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "61", // Add identifier_id
            ],
            // 62
            [
                'name' => "Taufik Hidayat, S.T., M.T.",
                'email' => "taufik.hidayat@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6285859107339',
                "unit_id" => "16",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "62", // Add identifier_id
            ],
            // 63
            [
                'name' => "Healty Susantiningdyah, S.Pd., MAppLing.",
                'email' => "susan@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '628113603040',
                "unit_id" => "17",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "63", // Add identifier_id
            ],
            // 64
            [
                'name' => "Winarni, S.Si., M.Si.",
                'email' => "winarni@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6282139837201',
                "unit_id" => "18",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "64", // Add identifier_id
            ],
            // 65
            [
                'name' => "Syamsul Mujahidin, S.Kom., M.Eng.",
                'email' => "syamsul@lecturer.itk.ac.id",
                'status' => 'DOSEN',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '6281254712848',
                "unit_id" => "19",
                'signature' => "beta",
                'avatar' => "beta",
                'identifier_id' => "65", // Add identifier_id
            ],
            // 66
            [
                'name' => "Yuspian, S.Sos., M.I.R.",
                'email' => "kabua@itk.ac.id",
                'status' => 'TENDIK',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => Str::random(10),
                'number' => "0",
                'phone_number' => '',
                "unit_id" => "8",
                'signature' => "beta",
                'avatar' => "beta",
                "identifier_id" => "66",
            ],
        ])->map(function ($user) {
            Log::info($user);
            $newUser = User::create([
                'name' => $user["name"],
                'email' => $user["email"],
                'status' => $user["status"],
                'email_verified_at' => $user["email_verified_at"],
                'password' => $user["password"],
                'remember_token' => $user["remember_token"],
                'number' => $user["number"],
                'phone_number' => $user["phone_number"] ?? '',
                "unit_id" => $user["unit_id"],
                'signature' => $user["signature"],
                'avatar' => $user["avatar"],
            ]);

            UserIdentifier::create([
                'user_id' => $newUser->id,
                'identifier_id' => $user["identifier_id"],
            ]);
        });

        UserIdentifier::create([
            'user_id' => "21",
            'identifier_id' => "25",
        ]);

        User::create([
            'name' => "Lasniah Wahyuni., ST",
            'email' => "wahyuni.lasniah@staff.itk.ac.id",
            'status' => "TENDIK",
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
            'number' => "0",
            "unit_id" => "2",
            'signature' => "beta",
            'avatar' => "beta",
        ]);

        User::create([
            'name' => "Selvian Handayani, S.Si",
            'email' => "selvian@staff.itk.ac.id",
            'status' => "TENDIK",
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
            'number' => "0",
            "unit_id" => "2",
            'signature' => "beta",
            'avatar' => "beta",
        ]);

        User::create([
            'name' => "Supatmi, S.Si",
            'email' => "supatmi@staff.itk.ac.id",
            'status' => "TENDIK",
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
            'number' => "0",
            "unit_id" => "5",
            'signature' => "beta",
            'avatar' => "beta",
        ]);

        User::create([
            'name' => "Anggina Frezky Harahap",
            'email' => "anggina.frezky@staff.itk.ac.id",
            'status' => "TENDIK",
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
            'number' => "0",
            "unit_id" => "8",
            'signature' => "beta",
            'avatar' => "beta",
        ]);
    }
}
