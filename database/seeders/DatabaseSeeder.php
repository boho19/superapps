<?php

namespace Database\Seeders;

use App\Models\Izin;
use App\Models\User;
use App\Models\Absen;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Karyawan::factory(3)->create();
        // Absen::factory(3)->create();
        // Izin::factory(3)->create();
         
        $user = new User();
        $user->email= 'user@gmail.com';
        $user->password= bcrypt('admin123');
        $user->role= 'karyawan';
        $user->email_verified_at=now();
        $user->save();


        $user = new User();
        $user->email= 'admin@gmail.com';
        $user->password= bcrypt('admin123');
        $user->role= 'admin';
        $user->email_verified_at=now();
        $user->save();


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
