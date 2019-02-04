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
<div class="overlay_popup"></div>

<div class="row menuBlock">
    <div class="col-2">
        <a href="{{ route('admin.users') }}" class="menuLink"><span>Пользователи</span></a>
    </div>
    <div class="col-2">
        <a href="{{ route('admin.children') }}" class="menuLink"><span>Ученики</span></a>
    </div>
    <div class="col-2">
        <a href="{{ route('admin.schools') }}" class="menuLink"><span>Школы</span></a>
    </div>
    <div class="col-2">
        <a href="{{ route('admin.classes') }}" class="menuLink"><span>Классы</span></a>
    </div>
    <div class="col-2">
        <a href="{{ route('admin.access_points') }}" class="menuLink"><span>Точки доступа</span></a>
    </div>
    <div class="col-2">
        <a href="{{ route('admin.parents') }}" class="menuLink"><span>Родители</span></a>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <h1>Пользователи</h1>
    </div>
    <div class="row justify-content-end">
        <form class="form-search" action="{{ url()->full() }}">
            <input type="text" name="search" class="input-medium search-query" value="{{request('search')}}">
            <button type="submit" class="btn text-white bg-dark">Найти</button>
        </form>
    </div>

    <div class="row">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">
                    ID
                    @if ($errors->has('id'))
                        <br><strong class="text-danger">{{ $errors->first('id') }}</strong>
                    @endif
                </th>
                <th scope="col">
                    Роли
                    @if ($errors->has('roles'))
                        <br><strong class="text-danger">{{ $errors->first('roles') }}</strong>
                    @endif
                </th>
                <th scope="col">
                    E-mail
                    @if ($errors->has('email'))
                        <br><strong class="text-danger">{{ $errors->first('email') }}</strong>
                    @endif
                </th>
                <th scope="col">
                    Телефон
                    @if ($errors->has('phone'))
                        <br><strong class="text-danger">{{ $errors->first('phone') }}</strong>
                    @endif
                </th>
                <th scope="col">
                    Пароль
                    @if ($errors->has('password'))
                        <br><strong class="text-danger">{{ $errors->first('password') }}</strong>
                    @endif
                </th>
                <th scope="col">
                    Дата верификации e-mail
                    @if ($errors->has('email_verified_at'))
                        <br><strong class="text-danger">{{ $errors->first('email_verified_at') }}</strong>
                    @endif
                </th>
                <th scope="col">
                    Вклю-<br>чен
                    @if ($errors->has('enabled'))
                        <br><strong class="text-danger">{{ $errors->first('enabled') }}</strong>
                    @endif
                </th>
                <th scope="col">
                    Тип
                    @if ($errors->has('type'))
                        <br><strong class="text-danger">{{ $errors->first('type') }}</strong>
                    @endif
                </th>
                <th scope="col">
                    Remember Token
                    @if ($errors->has('remember_token'))
                        <br><strong class="text-danger">{{ $errors->first('remember_token') }}</strong>
                    @endif
                </th>

                <th scope="col">
                    Создана
                    @if ($errors->has('created_at'))
                        <br><strong class="text-danger">{{ $errors->first('created_at') }}</strong>
                    @endif
                </th>

                <th scope="col">
                    Обновлена
                    @if ($errors->has('updated_at'))
                        <br><strong class="text-danger">{{ $errors->first('updated_at') }}</strong>
                    @endif
                </th>

                <th scope="col">Управление учеткой</th>
            </tr>
            </thead>
            <tbody>

            <form method="POST" action="{{route('admin.users.add')}}">
                @csrf
                <tr>
                    <td>
                        #
                    </td>

                    <td class="roles">
                        <textarea name="roles"></textarea>
                    </td>
                    <td class="email">
                        <input type="text" name="email">
                    </td>
                    <td class="phone">
                        <input type="text" name="phone" value="38071" style="width: 110px;">
                    </td>
                    <td class="password">
                        <input type="password" name="password">
                    </td>
                    <td class="email_verified_at">
                        <input type="datetime-local" name="email_verified_at" style="width: 180px;">
                    </td>
                    <td class="enabled">
                        <select name="enabled">
                            <option value="0">Нет</option>
                            <option value="1">Да</option>
                        </select>
                    </td>
                    <td class="type">
                        <input type="number" name="type" style="width: 50px;">
                    </td>
                    <td class="remember_token">
                        <textarea name="remember_token"></textarea>
                    </td>
                    <td class="created_at">
                        <input type="datetime-local" name="created_at" style="width: 180px;">
                    </td>
                    <td class="updated_at">
                        <input type="datetime-local" name="updated_at" style="width: 180px;">
                    </td>

                    <td>
                        <div class="icons">
                            <button type="submit">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </form>

            @foreach($users as $user)
                <form method="POST" action="{{route('admin.users.save')}}">
                    @csrf
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            {{$user->id}}
                        </td>
                        <td class="roles">
                            <textarea name="roles">{{ $user->roles }}</textarea>
                        </td>
                        <td class="email">
                            <input type="text" name="email" value="{{ $user->email }}">
                        </td>
                        <td class="phone">
                            <input type="text" name="phone" value="{{ $user->phone }}" style="width: 110px;">
                        </td>
                        <td class="password">
                            <input type="password" name="password">
                        </td>
                        <td class="email_verified_at">
                            <input type="datetime-local" name="email_verified_at"
                                   value="{{ isset($user->email_verified_at) ? DateTime::createFromFormat('Y-m-d H:i:s', $user->email_verified_at)->format('Y-m-d\Th:m') : null }}"
                                   style="width: 200px;">
                        </td>
                        <td class="enabled">
                            <select name="enabled">
                                @if($user->enabled == 0)
                                    <option value="0" selected>Нет</option>
                                    <option value="1">Да</option>
                                @else
                                    <option value="0">Нет</option>
                                    <option value="1" selected>Да</option>
                                @endif
                            </select>
                        </td>
                        <td class="type">
                            <input type="number" name="type" value="{{ $user->type }}" style="width: 50px;">
                        </td>
                        <td class="remember_token">
                            <textarea name="remember_token">{{ $user->remember_token }}</textarea>
                        </td>
                        <td class="created_at">
                            <input type="datetime-local" name="created_at"
                                   value="{{ isset($user->created_at) ? DateTime::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d\Th:m') : null }}"
                                   style="width: 200px;">
                        </td>
                        <td class="updated_at">
                            <input type="datetime-local" name="updated_at"
                                   value="{{ isset($user->updated_at) ? DateTime::createFromFormat('Y-m-d H:i:s', $user->updated_at)->format('Y-m-d\Th:m') : null }}"
                                   style="width: 200px;">
                        </td>

                        <td>
                            <div class="icons">
                                <button type="submit">
                                    <i class="fas fa-save"></i>
                                </button>
                                <button>
                                    <i class="fas fa-trash-alt show_popup" rel="popupDelPar"></i>
                                </button>

                            </div>
                        </td>
                    </tr>
                </form>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
