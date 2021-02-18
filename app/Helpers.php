<?php

use App\Models\LocaleContent;
use App\Models\MainMenu;
use App\Models\MainNav;
use Illuminate\Support\Facades\App;

/**
 *
 *
 * @return void
 */
function Locales()
{
    return config('locale.languages');
}

/**
 * set default locale to first item in locale file in config. => fa
 *
 * @return void
 */
function DefaultLocale()
{
    return Locales()[0]['locale'];
}

/**
 * get menus for Dashboard Panel
 *
 * @return void
 */
function MenuPicker()
{
    return MainMenu::with('sub_menus')->get();
}

/**
 * get menus for Main Site
 *
 * @return void
 */
function NavPicker()
{
    if (App::getLocale() == 'fa' || App::getLocale() == 'ar')
        return  MainNav::with('sub_navs')->get();
    else
        return MainNav::with('sub_navs')->orderBy('id', 'DESC')->get();
}

/**
 * get content of page based on (page, section, element_id, and language that user selected)
 * if selected locale oes not have contents in db, contents related to 'fa' locale
 * will be selected and show to user
 *
 * @return void
 */
function AllContentOfLocale()
{
    if (!empty(LocaleContent::where('locale', App::getLocale())->get()->toArray())) {
        return LocaleContent::where('locale', App::getLocale())->get()->toArray();
    } else {
        return LocaleContent::where('locale', DefaultLocale())->get()->toArray();
    }
}

/**
 * function for replace persian digits with english
 * because persian digits cannot validate in laravel
 *
 * @param string $per_digits
 * @return void
 */
function per_digit_conv(string $per_digits)
{
    $result = "";
    $rep = [
        '۰',
        '۱',
        '۲',
        '۳',
        '۴',
        '۵',
        '۶',
        '۷',
        '۸',
        '۹',
    ];
    $en_digits = \range(0, 9);
    $result = \str_replace($rep, $en_digits, $per_digits);
    return $result;
}