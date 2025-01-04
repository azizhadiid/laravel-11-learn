<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->truncate();

        User::factory()
            ->count(30)
            ->create();

        // DB::table('blogs')->insert([
        //     'title' =>  'blog 1',
        //     'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, doloribus doloremque? Quod, ut? Asperiores expedita, consequatur corrupti provident sapiente quod animi voluptates ut vel repellendus veniam assumenda obcaecati! Voluptatem, natus?',
        // ]);

        // DB::table('blogs')->insert([
        //     'title' =>  'blog 2',
        //     'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, doloribus doloremque? Quod, ut? Asperiores expedita, consequatur corrupti provident sapiente quod animi voluptates ut vel repellendus veniam assumenda obcaecati! Voluptatem, natus?',
        // ]);

        // DB::table('blogs')->insert([
        //     'title' =>  'blog 3',
        //     'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus, doloribus doloremque? Quod, ut? Asperiores expedita, consequatur corrupti provident sapiente quod animi voluptates ut vel repellendus veniam assumenda obcaecati! Voluptatem, natus?',
        // ]);
    }
}
