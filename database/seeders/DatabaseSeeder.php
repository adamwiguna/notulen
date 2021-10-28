<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       \App\Models\User::create([
        'slug' => Str::random(10),
        'name' => 'Admin',
        'email' => 'admin',
        'email_verified_at' => now(),
        'password' => bcrypt('admin'),
        'remember_token' => Str::random(10),
        'division_id' => 0,
        'is_admin' => true,
        'authorization_level' => 100,
       ]);

       \App\Models\User::create([
        'slug' => Str::random(10),
        'name' => 'user0',
        'email' => 'user0',
        'email_verified_at' => now(),
        'password' => bcrypt('1234'),
        'remember_token' => Str::random(10),
        'division_id' => 01,
        'is_admin' => false,
        'authorization_level' => 0,
       ]);

       \App\Models\User::create([
        'slug' => Str::random(10),
        'name' => 'user1',
        'email' => 'user1',
        'email_verified_at' => now(),
        'password' => bcrypt('1234'),
        'remember_token' => Str::random(10),
        'division_id' => 2,
        'is_admin' => false,
        'authorization_level' => 1,
       ]);

       \App\Models\User::create([
        'slug' => Str::random(10),
        'name' => 'user2',
        'email' => 'user2',
        'email_verified_at' => now(),
        'password' => bcrypt('1234'),
        'remember_token' => Str::random(10),
        'division_id' => 3,
        'is_admin' => false,
        'authorization_level' => 2,
       ]);

       \App\Models\User::create([
        'slug' => Str::random(10),
        'name' => 'user3',
        'email' => 'user3',
        'email_verified_at' => now(),
        'password' => bcrypt('1234'),
        'remember_token' => Str::random(10),
        'division_id' => 4,
        'is_admin' => false,
        'authorization_level' => 3,
       ]);

       \App\Models\Division::create([
            'name' => 'PISKP',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       \App\Models\Division::create([
            'name' => 'E-GOV',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       \App\Models\Division::create([
            'name' => 'TIK',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       \App\Models\Division::create([
            'name' => 'STATISTIK',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       \App\Models\Division::create([
            'name' => 'SEKRE',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       \App\Models\Division::create([
            'name' => 'SEKDIS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       \App\Models\Division::create([
            'name' => 'KADIS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // \App\Models\User::factory(50)->create();
        // \App\Models\Note::factory(1000)->create();
        // \App\Models\NoteDetail::factory(3000)->create();
        // \App\Models\Note_Image::factory(10000)->create();
        // \App\Models\Attendance::factory(10000)->create();
    }
}
