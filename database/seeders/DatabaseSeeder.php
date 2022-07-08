<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        User::create([
            "name"=>"Thin Kabyar",
            "email"=>"thinkabyar@gmail.com",
            "password"=>Hash::make('password')
        ]);
        User::create([
            "name"=>"Thin Kabyar oo",
            "email"=>"thinkabyaroo@gmail.com",
            "password"=>Hash::make('password')
        ]);
        User::create([
            "name"=>"Kabyar",
            "email"=>"kabyar@gmail.com",
            "password"=>Hash::make('password')
        ]);
         \App\Models\User::factory(10)->create();
         Contact::factory(200)->create();
    }
}
