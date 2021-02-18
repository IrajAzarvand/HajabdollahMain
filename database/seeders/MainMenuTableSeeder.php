<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MainMenus = [
            'صفحه اصلی',
            'درباره ما',
            'محصولات',
            'سایر',

        ];

        foreach ($MainMenus as $mainMenu) {
            DB::table('main_menus')->insert([
                'MainMenu' => $mainMenu,
            ]);
        }
    }
}