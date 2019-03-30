<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Кабинет администратора - {{ env('APP_NAME', 'LARAVEL') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('themes/cabinet_admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/cabinet_admin/css/admin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/cabinet_admin/css/cabinet_admin.css') }}">
    <script type="text/javascript" src="{{ asset('themes/cabinet_admin/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('themes/cabinet_admin/js/jQuery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('themes/cabinet_admin/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('themes/cabinet_admin/js/adminPopup.js') }}"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

{{--<div>--}}
    {{--<select>--}}
        {{--<option>Выберите населенный пункт</option>--}}
    {{--</select>--}}
    {{--<select>--}}
        {{--<option>Выберите УЗ</option>--}}
    {{--</select>--}}
    {{--<select>--}}
        {{--<option>Выберите Класс</option>--}}
    {{--</select>--}}
{{--</div>--}}
{{--<div class="overlay_popup"></div>--}}

<input type="checkbox" name="mobile-nav" id="mobile-nav" class="gaadiexp-check">
<label for="mobile-nav" class="gaadiexp white" tabindex="0"><span></span></label>

<nav role="navigation" class="header-nav">
    <div class="fixed-nav ">
        <div class="menu">
            <ul>
                <li>
                    <a href="{{ route('admin.users') }}">
                        <span>Пользователи</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.children') }}">
                        <span>Ученики</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.children_extended') }}">
                        <span>Ученики (Расширенная)</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.schools') }}">
                        <span>Школы</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.classes') }}">
                        <span>Классы</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.access_points') }}">
                        <span>Точки доступа</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.parents') }}">
                        <span>Родители</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="d-flex justify-content-end">
            <input type="checkbox" name="search-nav" id="search-nav">
            <label for="search-nav">
                <i class="fas fa-search"></i>
            </label>

            <div>
                <form class="form-inline admin_search" method="GET" action="{{ url()->full() }}">
                    <input class="form-control mr-sm-2" type="search" name="search" value="{{ request('search') }}">
                    <button type="submit" class="btn text-white bg-dark">Найти</button>
                </form>
            </div>
            <a href="{{ route('logout') }}" class="btn out_link">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>

    </div>

</nav>

@yield('content')


</html>
