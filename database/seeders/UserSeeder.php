<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ['username' => 'sulthan45', 'name' => 'Sulthan Alif Hayatyo', 'email' => 'sulthan@gmail.com' ],
            ['username' => 'sutio123', 'name' => 'Sutio Mudiarno', 'email' => 'sutio@gmail.com' ]
        ];

        foreach ($datas as $data) {
            $data['password'] = Hash::make('password');
            User::create($data);
        }
    }
}
