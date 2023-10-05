<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

use App\Models\User;
use App\Models\Identifier;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // \App\Models\User::factory(20)->create();

        Identifier::create([
            'name' => "JMTI"
        ]);

        Identifier::create([
            'name' => "JTIP"
        ]);

        Identifier::create([
            'name' => "JTSP"
        ]);

        Identifier::create([
            'name' => "Rektorat"
        ]);

        User::create([
            'name' => "Admin",
            'email' => "superadmin@gmail.com",
            'status' => 'DOSEN',
            "identifier_id" => 1,
            'nip' => '0',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => str::random(10),
            'nip' => "78051851387412",
            'signature' => "beta",
            'avatar' => "beta",
        ]);

        for ($i = 0; $i <= 19; $i++){
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'status' => 'DOSEN',
                'nip' => '0',
                'email_verified_at' => now(),
                "identifier_id" => 1,
                'password' => Hash::make('123456789'),
                'remember_token' => str::random(10),
                'nip' => "78051851387412",
                'signature' => "beta",
                'avatar' => "beta",
            ]);
        }
    }
}
