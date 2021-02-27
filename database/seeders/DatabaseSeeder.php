<?php

namespace Database\Seeders;

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
        $this->call(UsersTableSeeder::class);
        $this->call(MainMenuTableSeeder::class);
        $this->call(SubMenuTableSeeder::class);
        $this->call(LocaleContentTableSeeder::class);
        $this->call(MainNavsTableSeeder::class);
        $this->call(AboutUsTableSeeder::class);
        $this->call(CUTableSeeder::class);

    }
}
