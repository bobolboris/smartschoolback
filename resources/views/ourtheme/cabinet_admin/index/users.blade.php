@extends('cabinet_admin.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Пользователи</h1>
            <a href="{{ route('admin.users.addForm') }}" class="btn" style="padding-top: 8px;">
                <i class="fas fa-plus" style="font-size: 30px;"></i>
            </a>
        </div>
        <div class="row justify-content-center">
            <p>Для получения большего количество информации о пользователе перейдите в режим редактирования</p>
        </div>

        {{--<div class="row justify-content-center">--}}
        {{--<a href="{{ route('admin.users.addForm') }}" class="btn text-white bg-dark addBtn">--}}
        {{--<span>Добавить</span>--}}
        {{--<i class="fas fa-plus"></i>--}}
        {{--</a>--}}
        {{--</div>--}}

        <div class="row justify-content-center">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Роли</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Включен</th>
                    <th scope="col">Настройки</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            {{ $user->roles }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->phone }}
                        </td>
                        <td>
                            @if($user->enabled == 0)
                                Нет
                            @else
                                Да
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.settings', ['id' => $user->id]) }}" class="btn btn-primary">Просмотр</a>
                        </td>
                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.users.editForm', ['id' => $user->id]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.users.removeForm', ['id' => $user->id]) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
@endsection
