@php
$MainNav=NavPicker();
@endphp
<div id="mainmenu" class="menu_container">
    @php
    if (App::getLocale()=='fa' || App::getLocale()=='ar') {
    echo '<label class="mobile_collapser">منو</label>';

    } else {
    echo '<label class="mobile_collapser">Menu</label>';

    }
    @endphp

    <!-- Mobile menu title -->
    <ul>
        @foreach ($MainNav as $main_menu)
            <li @if ($main_menu->sub_navs->count()) class="has-dropdown"
        @endif>
        <a @if ($main_menu->sub_navs->count())
            href="#"
        @else
            href="{{ $main_menu->route_name ? route($main_menu->route_name) : $main_menu->url }}"
            @endif>
            {{ $main_menu['content_' . App::getLocale()] }}</a>
        @if ($main_menu->sub_navs->count())
            <div class="dmui_dropdown_block">
                <div class="dmui-container">
                    <div class="dmui-col span1">
                        <div class="dmui-container">
                            <ul class="dmui-submenu">
                                @foreach ($main_menu->sub_navs as $sub_menu)
                                    <li><a href="{{ $sub_menu->route_name ? route($sub_menu->route_name) : $sub_menu->url }}"><img src="{{ asset('Main/images/' . $sub_menu['content_' . App::getLocale()] . '.png') }}" alt=""> {{ $sub_menu['content_' . App::getLocale()] }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        </li>
        @endforeach
    </ul>
</div>
