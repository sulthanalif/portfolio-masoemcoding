<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'sulthan45')->first();
        $image = 'blog.jpg';

        $datas = [
            ['tittle' => 'Masoem Juara', 'content' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Suscipit qui laboriosam dolorum dolor, ut, voluptates omnis voluptatem temporibus quidem magni facilis, fuga quae dolores ratione doloremque! Distinctio aliquid placeat quaerat.'],
        ];

        foreach ($datas as $data) {
            $data['user_id'] = $user->id;
            $data['image'] = $image;
            Blog::create($data);
        }
    }
}


