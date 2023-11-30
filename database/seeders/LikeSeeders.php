<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LikeSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('likes')->insert([
            'is_comment' => 0,
            'is_blog' => 1,
            'user_id' => 1,
            'blog_id' => 1,
            'comment_id' => 0,
        ]);
        DB::table('likes')->insert([
            'is_comment' => 0,
            'is_blog' => 1,
            'user_id' => 2,
            'blog_id' => 1,
            'comment_id' => 0,
        ]);
    }
}
