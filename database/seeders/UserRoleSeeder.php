<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\Identifier;


class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Identifier::create([
            "name" => "JMTI"
        ]);

        Identifier::create([
            "name" => "IF",
            "parent_id" => 1
        ]);

        $users = User::all();
        $role = Role::get("id");
        $i = 1;
        foreach($users as $user){
            // dd($user);
            UserRole::create([
                'role_id' => $i,
                'user_id' => $user->id,
                'identifier_id' => random_int(1,2)
            ]);
            if($i < $role->count()){
                $i++;
            }
        }
    }
}
