<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Daniel Bor',
            'email' => 'info@danielbor.tech',
            'email_verified_at' => now(),
            'telefono' => "54593913",
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Gabriel Valdez',
            'email' => 'gvaldezd@miumg.edu.gt',
            'email_verified_at' => now(),
            'telefono' => "58503857",
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Eleazar',
            'email' => 'jchetc5@miumg.edu.gt',
            'email_verified_at' => now(),
            'telefono' => "33339157",
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Oswaldo Bor',
            'email' => 'osxbor123@gmail.com',
            'email_verified_at' => now(),
            'telefono' => "99999999",
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
