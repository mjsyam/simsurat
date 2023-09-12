<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // \App\Models\User::factory(20)->create();
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
        ]);

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
        ]);

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
        ]);

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
        ]);

        for ($i = 0; $i <= 10; $i++){
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'status' => 'DOSEN',
                'nip' => '0',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'remember_token' => str::random(10),
                'nip' => "78051851387412",
                'signature' => "beta",
                'avatar' => "beta",
            ]);
        }
    }
}
