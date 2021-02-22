<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainNavsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MainNav = [
            [
                'content_fa' => 'صفحه اصلی',
                'content_en' => 'Home',
                'content_ru' => 'Главная',
                'content_fr' => 'Page d\'accueil',
                'route_name' => 'HomePage',
                'url' => null,
            ],
            [
                'content_fa' => 'درباره ما',
                'content_en' => 'About Us',
                'content_fr' => 'à propos de nous',
                'content_ru' => 'Про нас',
                'route_name' => 'HomePage',
                'url' => null,
            ],
            [
                'content_fa' => 'محصولات',
                'content_en' => 'Products',
                'content_ru' => 'Продукция',
                'content_fr' => 'Des produits',
                'route_name' => 'AllProducts',
                'url' => null,
            ],
            [
                'content_fa' => 'گالری تصاویر',
                'content_en' => 'Gallery',
                'content_fr' => 'Galerie de photos',
                'content_ru' => 'Галерея',
                'route_name' => 'AllGalleries',
                'url' => null,
            ],
            [
                'content_fa' => 'دفاتر فروش',
                'content_en' => 'Sales Offices',
                'content_fr' => 'Bureaux de ventes',
                'content_ru' => 'Офисы продаж',
                'route_name' => 'SalesOffice',
                'url' => null,
            ],
            [
                'content_fa' => 'استانداردها',
                'content_en' => 'Certificates',
                'content_ru' => 'Сертификаты',
                'content_fr' => 'Certificats',
                'route_name' => 'HomePage',
                'url' => null,
            ],
            [
                'content_fa' => 'رویدادها',
                'content_en' => 'Events',
                'content_fr' => 'Événements',
                'content_ru' => 'События',
                'route_name' => null,
                'url' => null,
            ],
            [
                'content_fa' => 'تماس با ما',
                'content_en' => 'Contact Us',
                'content_ru' => 'Контакты',
                'content_fr' => 'Nous contacter',
                'route_name' => 'ContactUsForm',
                'url' => null,
            ],
        ];

        foreach ($MainNav as $url => $item) {
            DB::table('main_navs')->insert([
                'content_fa' => $item['content_fa'],
                'content_en' => $item['content_en'],
                'content_ru' => $item['content_ru'],
                'content_fr' => $item['content_fr'],
                'route_name' => $item['route_name'],
                'url' => $item['url'],
            ]);
        }
    }
}
