<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesOfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $States = [
//            [
//                'id' => 1,
//                'name' => 'Ardabil',
//                'fa' => 'اردبيل',
//                'en' => 'Ardabil',
//                'ru' => 'Ардебиль',
//                'tr' => 'Erdebil',
//
//            ],
            [
                'id' => 2,
                'name' => 'Esfahan',
                'fa' => 'اصفهان
فلکه دانشگاه،خیابان امام خمینی،بعد از شاپورجدید، خیابان شهید زرین، جنب شرکت بهروز
33878916-031',
                'en' => 'Esfahan
University Square, Imam Khomeini St., after Shapur Jadid, Shahid Zarrin St., next to Behrooz Company
33878916-031',
                'ru' => 'Исфахан
Университетская площадь, ул. Имама Хомейни, им. Шапура Джадида, ул. Шахида Заррина, рядом с компанией Behrooz
33878916-031',
                'tr' => 'Esfahan
Üniversite Meydanı, İmam Humeyni Caddesi, Shapur Jadid\'den sonra, Shahid Zarrin St., Behrooz Company\'nin yanında
33878916-031',
            ],
            [
                'id' => 3,
                'name' => 'Alborz',
                'fa' => 'کرج
جاده شهریار،شهرک صنعتی سیمین دشت،خیابان هشتم غربی،پلاک 148
36670562-026',
                'en' => 'Karaj
Shahriar Road, Simin Dasht Industrial Town, West 8th Street, No. 148
36670562-026',
                'ru' => 'Карадж
Shahriar Road, промышленный город Simin Dasht, West 8th Street, No. 148
36670562-026',
                'tr' => 'Karaj
Shahriyar Yolu, Simin Dasht Industrial City, West Sharia 8, No. 148
36670562-026',
            ],
//            [
//                'id' => 4,
//                'name' => 'Ilam',
//                'fa' => 'ايلام',
//                'en' => 'Ilam',
//                'ru' => 'ايلام',
//                'tr' => 'Ilam',
//            ],
            [
                'id' => 5,
                'name' => 'East Azarbaijan',
                'fa' => 'تبریز،
میدان بسیج،جاده 2 تهران، 200متر بالاتر ازجنب کارخانه آناتا
36373465-041',
                'en' => 'Tabriz,
                Sage Square, 2 Avenue Tahran, 200 meters per square meter, Azjeb Karkhana Anata
041-36373465',
                'ru' => 'Тебриз,
Площадь Басидж, дорога 2, Тегеран, на высоте 200 метров над фабрикой Аната
36373465-041',
                'tr' => 'Tebriz,
Basij Meydanı, Yol 2, Tahran, Anata Fabrikası\'nın 200 metre yukarısında
36373465-041',
            ],
            [
                'id' => 6,
                'name' => 'Western Azerbaijan',
                'fa' => 'ارومیه
جاده سلماس، کوی تالار دلگشا،شرکت بستنی اطمینان
3-32722652-044',
                'en' => 'Orumieh
Salmas Road, Delgosha Hall Alley, Atminan Ice Cream Company
3-32722652-044',
                'ru' => 'Orumieh
Salmas Road, Delgosha Hall Alley, компания Atminan Ice Cream Company
3-32722652-044',
                'tr' => 'Orumieh
Salmas Yolu, Delgosha Hall Alley, Atminan Dondurma Şirketi
3-32722652-044',
            ],
//            [
//                'id' => 7,
//                'name' => 'Bushehr',
//                'fa' => 'بوشهر',
//                'en' => 'Bushehr',
//                'ru' => 'Бушер',
//                'tr' => 'Buşehr',
//            ],
            [
                'id' => 8,
                'name' => 'Tehran',
                'fa' => 'تهران مرکز
کیلومتر11اتوبان فتح،سه راهی شهریار،بعد ازسعیدآباد،قبل از پل بادامک، روبروی پمپ بنزین،خیابان وحید1 ،پلاک 23
65606580-021',
                'en' => 'Centeral Tehran
11 km of Fatah highway, Shahriyar intersection, after Saeedabad, before Badamak bridge, in front of gas station, Vahid 1 street, No. 23
65606580-021',
                'ru' => 'Центральный Тегеран
11 км шоссе Фатх, перекресток Шахрияр, после Саидабада, перед мостом Бадамак, напротив АЗС, улица Вахид 1, дом 23
65606580-021',
                'tr' => 'Merkez Tahran
Fatah otoyolunun 11 km. Şehriyar kavşağı, Saeedabad sonrası, Badamak köprüsü önünde, benzin istasyonu önünde, Vahid 1 sokak, No. 23
65606580-021',
            ],
            [
                'id' => 9,
                'name' => 'Tehran',
                'fa' => 'تهران غرب
کیلومتر11اتوبان فتح،سه راهی شهریاربه سمت باغستان ،بعد ازسعیدآباد،قبل از پل بادامک، روبروی پمپ بنزین،خیابان وحید1 ،پلاک 23
65606580-021',
                'en' => 'West Tehran
11 km of Fatah Highway, Shahriar Towards Baghistan, after Saeed Abad, before Badamak Bridge, in front of gas station, Vahid 1 St., No. 23
65606580-021',
                'ru' => 'Западный Тегеран
11 км шоссе Фатх, Шахрияр в сторону Багистана, после Саид Абада, перед мостом Бадамак, напротив АЗС, ул. Вахид 1, № 23
65606580-021',
                'tr' => 'Batı Tahran
11 km El Fetih Karayolu, Şehriar Bağistan\'a Doğru, Saeed Abad\'dan sonra, Badamak Köprüsü\'nden önce, benzin istasyonu önünde, Vahid 1 Cad.
    65606580-021',
            ],
            [
                'id' => 10,
                'name' => 'Tehran',
                'fa' => 'تهران شرق و جنوب
شهرری،جاده قدیم قم- تهران(خیابان رجایی جنوبی)،شهر سنگ،کوچه دوم گل رز،پلاک11
7-55227976-021',
                'en' => 'East and south of Tehran
Shahreri, Old Qom-Tehran Road (South Rajai St.), Shahr-e Sang, 2nd Rose Alley, No. 11
7-55227976-021',
                'ru' => 'К востоку и югу от Тегерана
Shahreri, Old Qom-Tehran Road (South Rajai St.), Shahr-e Sang, 2nd Rose Alley, No. 11
7-55227976-021',
                'tr' => 'doğusu ve güney Tahran
Shahreri, Eski Qom-Tahran Yolu (Güney Rajai St.), Shahr-e Sang, 2. Gül Sokağı, No. 11
7-55227976-021',
            ],
//            [
//                'id' => 11,
//                'name' => 'Chaharmahal O Bakhtiari',
//                'fa' => 'چهار محال و بختیاری',
//                'en' => 'Chaharmahal O Bakhtiari',
//                'ru' => 'Чахармахал и Бахтиари',
//                'tr' => 'Chaharmahal va Bakhtiari',
//
//            ],
//            [
//                'id' => 12,
//                'name' => 'South Khorasan',
//                'fa' => 'خراسان جنوبي',
//                'en' => 'South Khorasan',
//                'ru' => 'خراسان جنوبي',
//                'tr' => 'Güney Horasan',
//            ],
            [
                'id' => 13,
                'name' => 'Khorasan Razavi',
                'fa' => 'مشهد
کیلومتر5 جاده قوچان، مقابل آزادی135، داخل مجموعه شهد ایران
4-36585651-051',
                'en' => 'Mashhad
5 km of Quchan road, in front of Azadi 135, inside the nectar complex of Iran
4-36585651-051',
                'ru' => 'Мешхед
5 км дороги Кучан, напротив Азади 135, внутри нектарного комплекса Ирана
4-36585651-051',
                'tr' => 'Meşhed
Shahd Iran kompleksi içinde Azadi 135 önünde Quchan yolunun 5 km.
4-36585651-051',

            ],
//            [
//                'id' => 14,
//                'name' => 'North Khorasan',
//                'fa' => 'خراسان شمالي',
//                'en' => 'North Khorasan',
//                'ru' => 'Северный Хорасан',
//                'tr' => 'Kuzey Horasan',
//
//            ],
//            [
//                'id' => 15,
//                'name' => 'Khuzestan',
//                'fa' => 'خوزستان',
//                'en' => 'Khuzestan',
//                'ru' => 'Хузестан',
//                'tr' => 'Khuzestan',
//            ],
            [
                'id' => 16,
                'name' => 'Zanjan',
                'fa' => 'زنجان
شهرک صنعتی علی آباد، خیابان تیر،ابتدای روزبه 9
32222081-024
32222315-024',
                'en' => 'Zanjan
Aliabad Industrial Town, Tir St., beginning of Roozbeh 9
32222081-024
32222315-024',
                'ru' => 'Зенджан
Промышленный город Алиабад, ул. Тир, начало улицы Рузбех 9
32222081-024
32222315-024',
                'tr' => 'Zencan
Aliabad Industrial Town, Tir St., Roozbeh başlangıcı 9
32222081-024
32222315-024',

            ],
//            [
//                'id' => 17,
//                'name' => 'Semnan',
//                'fa' => 'سمنان',
//                'en' => 'Semnan',
//                'ru' => 'سمنان',
//                'tr' => 'Semnan',
//            ],
            [
                'id' => 18,
                'name' => 'Sistan O Baluchestan',
                'fa' => 'زاهدان
شهرک صنعتی جاده میرجاوه، بلوار کارگر، نبش کارگر5
33592447-054',
                'en' => 'Sistan-o-Baluchestan sales office
Industrial Town - Mirjaveh Road - Kargar Boulevard - Corner of Kargar 5 - The first door on the left
Phone: 33592447 - 054',
                'ru' => 'Офис продаж в Систане и Белуджистане
Промышленный город - улица Мирджаве - бульвар Каргар - угол Каргара 5 - первая дверь слева
Телефон: 33592447 - 054',
                'tr' => 'Zahedan
Mirjaveh Road Industrial Town, Kargar Bulvarı, Kargar 5 köşesi
33592447-054',

            ],
            [
                'id' => 19,
                'name' => 'Fars',
                'fa' => 'شیراز
شهرک بزرگ صنعتی ،میدان سوم، خیابان کوشش جنوبی،خیابان207 ،سمت راست،
سوله سوم
37740372-071
37740163-071
37740165-071',
                'en' => 'Shiraz
Large Industrial Town, Third Square, South Kooshesh St., 207 St., Right, third Niches
37740372-071
37740163-071
37740165-071',
                'ru' => 'Шираз
Большой промышленный городок, Третья площадь, Южный Коошеш ул., 207 ул., Направо,
37740372-071
37740163-071
37740165-071',
                'tr' => 'Şiraz
Büyük Sanayi Kasabası, Üçüncü Meydan, Güney Kooshesh St., 207 St., Sağ,
37740372-071
37740163-071
37740165-071',

            ],
//            [
//                'id' => 20,
//                'name' => 'Qazvin',
//                'fa' => 'قزوين',
//                'en' => 'Qazvin',
//                'ru' => 'قزوين',
//                'tr' => 'Qazvin',
//
//
//            ],
            [
                'id' => 21,
                'name' => 'Qom',
                'fa' => 'قم
جاده قدیم قم- تهران،بلوارخدا کرم،روبروی ترمینال،کوچه ششم،جنب مدرسه شهید فهمیده
4-36642861-025',
                'en' => 'Qom
Old Qom-Tehran road, Khoda Karam Boulevard, in front of the terminal, sixth alley, next to Shahid Fahmideh school
4-36642861-025',
                'ru' => 'Кум
Старая дорога Кум-Тегеран, бульвар Хода Карам, напротив терминала, 6-й переулок, рядом со школой Шахида Фахмиде
4-36642861-025',
                'tr' => 'Kum
Eski Qom-Tahran yolu, Khoda Karam Bulvarı, terminalin önünde, 6. Sokak, Shahid Fahmideh Okulu\'nun yanında
4-36642861-025',
            ],
//            [
//                'id' => 22,
//                'name' => 'Kordestan',
//                'fa' => 'كردستان',
//                'en' => 'Kordestan',
//                'ru' => 'كردستان',
//                'tr' => 'Kordestan',
//
//            ],
            [
                'id' => 23,
                'name' => 'Kerman',
                'fa' => 'کرمان
انتهای بلوار امیرکبیر، بلوارعطا احمدی
4-32150263-034',
                'en' => 'Kerman
The end of Amirkabir Boulevard, Ata Ahmadi Boulevard
4-32150263-034',
                'ru' => 'Керман
Конец бульвара Амиркабир, бульвар Ата Ахмади
4-32150263-034',
                'tr' => 'Kerman
Amir Kabir\'in son Şeriatı, Shari\'a Atta Ahmadi
034-32150263-4',

            ],
            [
                'id' => 24,
                'name' => 'Kermanshah',
                'fa' => 'کرمانشاه
شهرک صنعتی فرامان، بلوار امیرکبیر، نبش جهاد 2
34733799-083
34733592-083
34733817-083',
                'en' => 'Kermanshah
Faraman Industrial Town, Amirkabir Boulevard, corner of Jihad 2
34733799-083
34733592-083
34733817-083',
                'ru' => 'Керманшах
Промышленный городок Фараман, бульвар Амиркабир, угол Джихада 2
34733799-083
34733592-083
34733817-083',
                'tr' => 'Kirmanşah
Faraman Sanayi Kasabası, Amirkabir Bulvarı, Cihad\'ın köşesi 2
34733799-083
34733592-083
34733817-083',

            ],
//            [
//                'id' => 25,
//                'name' => 'Kohgiluyeh and Boyer-Ahmad',
//                'fa' => 'کهگیلویه و بویر احمد',
//                'en' => 'Kohgiluyeh and Boyer-Ahmad',
//                'ru' => 'Кохгилуе и Бойер-Ахмад',
//                'tr' => 'Kohgiloyeh ve Boyerahmad',
//
//            ],
//            [
//                'id' => 26,
//                'name' => 'Golestan',
//                'fa' => 'گلستان',
//                'en' => 'Golestan',
//                'ru' => 'Голестан',
//                'tr' => 'Golestan',
//
//            ],
            [
                'id' => 27,
                'name' => 'Gilan',
                'fa' => 'رشت
کیلومتر 8 جاده تهران،جنب تالار گویا،داخل مجتمع گیلان قوت
2-33691051-013
33690219-013',
                'en' => 'Rasht
8 km of Tehran road, next to Goya Hall, inside Gilan Ghot Complex
2-33691051-013
33690219-013',
                'ru' => 'Рашт
8 км Тегеранской дороги, рядом с Goya Hall, внутри комплекса Gilan Ghot
2-33691051-013
33690219-013',
                'tr' => 'Rasht
Gilan Ghot Kompleksi içinde Goya Hall yanında Tahran yolunun 8 km.
2-33691051-013
33690219-013',

            ],
//            [
//                'id' => 28,
//                'name' => 'Lorestan',
//                'fa' => 'لرستان',
//                'en' => 'Lorestan',
//                'ru' => 'لرستان',
//                'tr' => 'Lorestan',
//            ],
            [
                'id' => 29,
                'name' => 'Mazandaran',
                'fa' => 'بابل
کیلومتر4 جاده قائم شهر،300 متر بعد از دانشگاه آزاد،روبروی شرکت درنا
32318870-011',
                'en' => 'Babol
4 km of Ghaemshahr road, 300 meters after Azad University, in front of Derna company
32318870-011',
                'ru' => 'Вавилон
4 км дороги Гамшахр, в 300 метрах от университета Азад, напротив компании Дерна
32318870-011',
                'tr' => 'Babil
Ghaemshahr yolunun 4 km\'si, Azad Üniversitesi\'nden 300 metre sonra, Derna firmasının önünde
32318870-011',
            ],
//            [
//                'id' => 30,
//                'name' => 'Markazi',
//                'fa' => 'مركزي',
//                'en' => 'Markazi',
//                'ru' => 'مركزي',
//                'tr' => 'Markazi',
//            ],
            [
                'id' => 31,
                'name' => 'Hormozgan',
                'fa' => 'بندرعباس
چهچکور،کیلومتر 5 جاده سیرجان،جنب گروه صنعتی نجاتی (آناتا)
32568027-076',
                'en' => 'Bandar Abbas
Chechkour, 5 km of Sirjan road, next to Nejat Industrial Group (Anata)
32568027-076',
                'ru' => 'Бандар Аббас
Чечкур, 5 км дороги Сирджан, рядом с промышленной группой Неджат (Аната)
32568027-076',
                'tr' => 'Bandar Abbas
Chechkour, Sirjan Yolu\'na 5 km, Nejat Industrial Group (Anata) yanında
32568027-076',
            ],
            [
                'id' => 32,
                'name' => 'Hamedan',
                'fa' => 'همدان
جاده کرمانشاه،200متر جلوتر از پلیس راه قدیم بهار،جنب تالار لاله الوند
34586907-081',
                'en' => 'Hamedan
Kermanshah road, 200 meters in front of the old spring road police, next to Laleh Alvand Hall
34586907-081',
                'ru' => 'Хамедан
Керманшах-роуд, в 200 метрах от старой весенней дорожной полиции, рядом с Laleh Alvand Hall
34586907-081',
                'tr' => 'Hamedan
Kirmanşah yolu, eski bahar yolu polisinin 200 metre önünde, Laleh Alvand salonunun yanında
34586907-081',
            ],
//            [
//                'id' => 33,
//                'name' => 'Yazd',
//                'fa' => 'يزد',
//                'en' => 'Yazd',
//                'ru' => 'Йезд',
//                'tr' => 'Yazd',
//            ],

        ];
        foreach ($States as $State) {

            DB::table('sales_offices')->insert([
                'id' => $State['id'],
            ]);
            foreach (Locales() as $l) {
                DB::table('locale_contents')->insert([
                    'page' => 'sales_office',
                    'section' => 'sales_office',
                    'element_id' => $State['id'],
                    'locale' => $l['locale'],
                    'element_title' => $State['name'],
                    'element_content' => $State[$l['locale']],

                ]);
            }

        }
    }
}
