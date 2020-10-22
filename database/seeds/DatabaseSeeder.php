<?php

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
        $this->call([
            # l'ordine logico è importante!!
            UsersTableSeeder::class,
            PostsTableSeeder::class,
            TagsTableSeeder::class,
        ]);
    }
}
