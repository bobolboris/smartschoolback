<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Кабинет администратора - {{ env('APP_NAME', 'LARAVEL') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript" src="{{ asset('themes/cabinet_admin/js/jQuery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('themes/cabinet_admin/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('themes/cabinet_admin/js/bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('themes/cabinet_admin/js/adminPopup.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('themes/cabinet_admin/css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/cabinet_admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/cabinet_admin/css/admin.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
<div>
    <select>
        <option>Выберите населенный пункт</option>
    </select>
    <select>
        <option>Выберите УЗ</option>
    </select>
    <select>
        <option>Выберите Класс</option>
    </select>
</div>
<div class="overlay_popup"></div>

<nav id="menuVertical">
    <ul>
        <li>
            <a href="{{ route('admin.users') }}"><span>Пользователи</span></a>
        </li>

        <li>
            <a href="{{ route('admin.children') }}"><span>Ученики</span></a>
        </li>

        <li>
            <a href="{{ route('admin.schools') }}"><span>Школы</span></a>
        </li>

        <li>
            <a href="{{ route('admin.classes') }}"><span>Классы</span></a>
        </li>

        <li>
            <a href="{{ route('admin.access_points') }}"><span>Точки доступа</span></a>
        </li>

        <li>
            <a href="{{ route('admin.parents') }}"><span>Родители</span></a>
        </li>


    </ul>
</nav>

@yield('content')

</body>
</html>
