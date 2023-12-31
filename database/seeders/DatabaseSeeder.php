<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {

        //\App\Models\Post::factory(3)->create();
        //
        \App\Models\Comment::factory(3)->create();

    }
}
