<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        if (User::where("email","admin1@mail.com")->first() == null){
            $user = new User;
            $user->name = "admin1";
            $user->email = "admin1@mail.com";
            $user->password = Hash::make("12345");
            $user->role = "Admin";
            $user->save();
        }
    }
}
