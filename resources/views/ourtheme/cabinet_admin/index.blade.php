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

    <link rel="stylesheet" href="text/css" href="{{ asset('themes/cabinet_admin/css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/cabinet_admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/cabinet_admin/css/admin.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
<div class="overlay_popup"></div>

<!--удалить родителя -->
<div class="popup" id="popupDelPar">
    <div class="object-delPer">
        <form action="" method="">
            <p class="mb-2 text-primary">Вы уверены, что хотите удалить?</p>
            <p id="fioPlaceDelPar" class="text-danger"></p>
            <input type="submit" id="okDelPer" class="btn btn-primary" value="Да">
            <input type="button" class="closePP btn btn-primary" value="Отмена">
        </form>
    </div>
</div>

<!--изменить родителя -->
<div class="popup" id="popupEditPar">
    <div class="object-editPer">
        <form action="" method="">
            <p>Изменить профиль родителя</p>
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Поле</th>
                    <th scope="col">Значение</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>ФИО</td>
                    <td>
                        <input type="text" id="fioPlaceEditPar" class="text-dark">
                        <!-- <p id="fioPlace" class="text-info"></p> -->
                    </td>
                </tr>
                <tr>
                    <td>Телефон</td>
                    <td>
                        <input type="text" id="phonePlaceEditPar" class="text-dark" value="071-322-12-15">
                    </td>
                </tr>
                </tbody>
            </table>
            <input type="submit" id="okEditPer" class="btn btn-primary" value="Да">
            <input type="button" class="closePP btn btn-primary" value="Отмена">
        </form>
    </div>
</div>

<!--создать родителя -->
<div class="popup" id="popupCreatePar">
    <div class="object-createPer">
        <form action="" method="">
            <p>Создать профиль родителя</p>
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Поле</th>
                    <th scope="col">Значение</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>ФИО</td>
                    <td>
                        <input type="text" id="fioPlaceСreatePar" class="text-dark">
                    </td>
                </tr>
                <tr>
                    <td>Телефон</td>
                    <td>
                        <input type="text" id="phonePlaceCreatePar" class="text-dark">
                    </td>
                </tr>
                </tbody>
            </table>
            <input type="submit" id="okCreatePer" class="btn btn-primary" value="Да">
            <input type="button" class="closePP btn btn-primary" value="Отмена">
        </form>
    </div>
</div>


<!--просмотреть детей родителя -->
<div class="popup" id="popupShowParChild">
    <div class="object-showParChild">
        <form action="" method="">
            <p>Дети <span id="fioPlaceShowChildPar" class="text-dark"></span></p>
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">ФИО</th>
                    <th scope="col">Школа</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>tmp Name</td>
                    <td>57</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>tmp Name</td>
                    <td>112</td>
                </tr>
                </tbody>
            </table>
            <input type="submit" id="okShowChildPer" class="btn btn-primary" value="Да">
            <input type="button" class="closePP btn btn-primary" value="Отмена">
        </form>
    </div>
</div>

<nav id="menuVertical">
    <ul>
        <li>
            <a href="#999">
                <div class="img_n">
                    <img src="earth.png" alt="">
                </div>
                <span>Пользователь</span>
            </a>
        </li>

        <li>
            <a href="#0">
                <div class="img_n">
                    <img src="earth.png" alt="">
                </div>
                <span>Город</span>
            </a>
        </li>

        <li>
            <a href="#1">
                <div class="img_n">
                    <img src="earth.png" alt="">
                </div>
                <span>Школа</span>
            </a>
        </li>

        <li>
            <a href="#2">
                <div class="img_n">
                    <img src="stat.png" alt="">
                </div>
                <span>Зона</span>
            </a>
            <!-- 				<ul>
                                <li><a href="#2-1">Главная</a></li>
                                <li><a href="#2-1">Детальная</a></li>
                            </ul> -->
        </li>

        <li>
            <a href="#3">
                <div class="img_n">
                    <img src="prof.png" alt="">
                </div>
                <span>Точка доступа</span>
            </a>
            <!-- 				<ul>
                                <li><a href="#3-1">Личный кабинет</a></li>
                                <li><a href="#3-1">Настройки</a></li>
                            </ul> -->
        </li>

        <li id="displayParent">
            <a href="#4">
                <div class="img_n">
                    <img src="door.png" alt="">
                </div>
                <span>Родитель</span>
            </a>
        </li>

        <li id="displayChild">
            <a href="#5">
                <div class="img_n">
                    <img src="door.png" alt="">
                </div>
                <span>Ученик</span>
            </a>
        </li>
    </ul>
</nav>


<!-- Родитель -->
<div class="container-fluid content content-parent">
    <div class="row justify-content-center">
        <h1>Родитель</h1>
    </div>
    <div class="row justify-content-end">
        <form class="form-search">
            <input type="text" class="input-medium search-query">
            <button type="submit" class="btn text-white bg-dark">Найти</button>
        </form>
    </div>

    <div class="row justify-content-center">
        <button class="btn text-white bg-dark addBtn show_popup" rel="popupCreatePar">Добавить <i
                class="fas fa-plus"></i></button>
    </div>

    <div class="row justify-content-center">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" width="15%">#</th>
                <th scope="col" width="40%">ФИО родителя</th>
                <th scope="col" width="20%">Управление учеткой</th>
                <th scope="col" width="25%">Дети</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td class="fio">Родичев Р.Ю.</td>
                <td>
                    <div class="icons">
                        <i class="fas fa-user-edit show_popup" rel="popupEditPar"></i>
                        <i class="fas fa-trash-alt show_popup" rel="popupDelPar"></i>
                    </div>
                </td>
                <td>
                    <button class="btn btn-primary show_popup" rel="popupShowParChild">Просмотр</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td class="fio">Петров А.Г.</td>
                <td>
                    <div class="icons">
                        <i class="fas fa-user-edit show_popup" rel="popupEditPar"></i>
                        <i class="fas fa-trash-alt show_popup" rel="popupDelPar"></i>
                    </div>
                </td>
                <td>
                    <button class="btn btn-primary show_popup" rel="popupShowParChild">Просмотр</button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td class="fio">Поличев М.Н.</td>
                <td>
                    <div class="icons">
                        <i class="fas fa-user-edit show_popup" rel="popupEditPar"></i>
                        <i class="fas fa-trash-alt show_popup" rel="popupDelPar"></i>
                    </div>
                </td>
                <td>
                    <button class="btn btn-primary show_popup" rel="popupShowParChild">Просмотр</button>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td class="fio">Коксик О.П.</td>
                <td>
                    <div class="icons">
                        <i class="fas fa-user-edit show_popup" rel="popupEditPar"></i>
                        <i class="fas fa-trash-alt show_popup" rel="popupDelPar"></i>
                    </div>
                </td>
                <td>
                    <button class="btn btn-primary show_popup" rel="popupShowParChild">Просмотр</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


<!-- Ученик -->
<div class="container-fluid content content-child">
    <div class="row justify-content-center">
        <h1>Ученик</h1>
    </div>
    <div class="row justify-content-end">
        <form class="form-search">
            <input type="text" class="input-medium search-query">
            <button type="submit" class="btn text-white bg-dark">Найти</button>
        </form>
    </div>

    <div class="row justify-content-center">
        <button class="btn text-white bg-dark addBtn show_popup" rel="popupCreatePar">Добавить <i
                class="fas fa-plus"></i></button>
    </div>

    <div class="row justify-content-center">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">№</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Имя</th>
                <th scope="col">Отчество</th>
                <th scope="col">Управление учеткой</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td class="surname">child1</td>
                <td class="name">child1</td>
                <td class="patronymic">child1</td>
                <td>
                    <div class="icons">
                        <i class="fas fa-user-edit show_popup" rel="popupEditPar"></i>
                        <i class="fas fa-trash-alt show_popup" rel="popupDelPar"></i>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
