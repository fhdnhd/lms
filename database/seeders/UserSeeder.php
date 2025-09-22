<?php 
 // database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Administrator',
            'email' => 'admin@kpu.go.id',
            'password' => Hash::make('password'),
            'role' => 'administrator',
            'nik'=>'3516081305760001'
        ]);

        User::create([
            'id' => (string) Str::uuid(),
            'name' => 'KPPS 1',
            'email' => 'kpps1@kpu.go.id',
            'password' => Hash::make('password'),
            'role' => 'kpps',
            'nik'=>'3516081305760002'
        ]);
    }
}
