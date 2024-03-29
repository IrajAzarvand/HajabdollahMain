<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SubMenus = [
            'صفحه اصلی' => [
                [
                    'SubMenu' => 'اسلایدر',
                    'Url' => 'Slider.index',
                    'Icon' => 'fa fa-columns',
                ],
            ],
            'محصولات' => [
                [
                    'SubMenu' => 'نوع محصولات',
                    'Url' => 'PType.index',
                    'Icon' => 'fa fa-arrows',
                ],
                [
                    'SubMenu' => 'دسته بندی محصولات',
                    'Url' => 'Category.index',
                    'Icon' => 'fa fa-list-ul',
                ],
                [
                    'SubMenu' => 'مدیریت محصولات',
                    'Url' => 'Product.index',
                    'Icon' => 'fa fa-shopping-bag',
                ],
                [
                    'SubMenu' => 'مدیریت کاتالوگ ها',
                    'Url' => 'Catalog.index',
                    'Icon' => 'fa fa-newspaper-o',
                ],
            ],
            'درباره ما' => [
                [
                    'SubMenu' => 'درباره ما',
                    'Url' => 'AboutUs.index',
                    'Icon' => 'fa fa-file-text-o',
                ],
                [
                    'SubMenu' => 'آدرس',
                    'Url' => 'Address.index',
                    'Icon' => 'fa fa-map-marker',
                ],
                [
                    'SubMenu' => 'تماس با ما',
                    'Url' => 'CU.index',
                    'Icon' => 'fa fa-file-text-o',
                ],
            ],
            'سایر' => [
                [
                    'SubMenu' => 'رویدادها',
                    'Url' => 'Events.index',
                    'Icon' => 'fa fa-align-right',
                ],
//                [
//                    'SubMenu' => 'گالری تصاویر',
//                    'Url' => 'Gallery.index',
//                    'Icon' => 'fa fa-picture-o',
//                ],
                [
                    'SubMenu' => 'دفاتر فروش',
                    'Url' => 'SO.index',
                    'Icon' => 'fa fa-building-o',
                ],
//                [
//                    'SubMenu' => 'پیام ها',
//                    'Url' => 'CUMessages.index',
//                    'Icon' => 'fa fa-comments-o',
//                ],
            ]
        ];

        foreach ($SubMenus as $MainMenu => $subMenu) {
            foreach ($subMenu as $item) {
                DB::table('sub_menus')->insert([
                    'main_menu' => $MainMenu,
                    'SubMenu' => $item['SubMenu'],
                    'Url' => $item['Url'],
                    'Icon' => $item['Icon'],
                ]);
            }
        }
    }
}
