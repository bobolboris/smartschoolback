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
                        Включен
                        @if ($errors->has('enabled'))
                            <br><strong class="text-danger">{{ $errors->first('enabled') }}</strong>
                        @endif
                    </th>

                    <th scope="col">Управление учеткой</th>
                </tr>
                </thead>
                <tbody>


                @foreach($users as $user)
                    <tr>
                        <td>
                            {{$user['id']}}
                        </td>
                        <td class="roles">
                            {{ $user['roles'] }}
                        </td>
                        <td class="email">
                            {{ $user['email'] }}
                        </td>
                        <td class="phone">
                            {{ $user['phone'] }}
                        </td>
                        <td class="enabled">
                            @if($user['enabled'] == 0)
                                Нет
                            @else
                                Да
                            @endif
                        </td>

                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.users.editForm', ['id' => @$user['id']]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.users.removeForm', ['id' => @$user['id']]) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
