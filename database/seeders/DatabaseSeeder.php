<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'User 1',
                'email' => 'user1@example.com',
                'password' => 'password123',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ], 
            [
                'name' => 'User 2',
                'email' => 'user2@example.com',
                'password' => 'password123',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
