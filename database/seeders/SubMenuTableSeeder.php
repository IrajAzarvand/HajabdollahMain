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

                [
                    'SubMenu' => 'مدیریت برچسب ها',
                    'Url' => 'Tags.index',
                    'Icon' => 'fa fa-tags',
                ],
            ],
            'درباره ما' => [
                [
                    'SubMenu' => 'معرفی شرکت',
                    'Url' => 'CI.index',
                    'Icon' => 'fa fa-file-text-o',
                ],
                [
                    'SubMenu' => 'تاریخچه',
                    'Url' => 'History.index',
                    'Icon' => 'fa fa-clock-o',
                ],
                [
                    'SubMenu' => 'پیام مدیر عامل',
                    'Url' => 'CeoMessage.index',
                    'Icon' => 'fa fa-commenting-o',
                ],
                [
                    'SubMenu' => 'گواهینامه و افتخارات',
                    'Url' => 'CH.index',
                    'Icon' => 'fa fa-graduation-cap',
                ],
                [
                    'SubMenu' => 'چارت سازمانی',
                    'Url' => 'OC.index',
                    'Icon' => 'fa fa-street-view',
                ],
            ],
            'سایر' => [
                [
                    'SubMenu' => 'آخرین اخبار',
                    'Url' => 'LatestNews.index',
                    'Icon' => 'fa fa-align-right',
                ],
                [
                    'SubMenu' => 'فوتر',
                    'Url' => 'Footer.index',
                    'Icon' => 'fa fa-sort-amount-asc',
                ],
                [
                    'SubMenu' => 'گالری تصاویر',
                    'Url' => 'Gallery.index',
                    'Icon' => 'fa fa-picture-o',
                ],
                [
                    'SubMenu' => 'دفاتر فروش',
                    'Url' => 'SO.index',
                    'Icon' => 'fa fa-building-o',
                ],
                [
                    'SubMenu' => 'پیام ها',
                    'Url' => 'CUMessages.index',
                    'Icon' => 'fa fa-comments-o',
                ],
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
