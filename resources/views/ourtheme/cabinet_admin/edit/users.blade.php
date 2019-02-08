@extends('cabinet_admin.index')

@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Пользователи</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf

                    <input type="hidden" name="email_verified_at" value="{{ @$user['email_verified_at'] }}">
                    <input type="hidden" name="type" value="{{ @$user['type'] }}">
                    <input type="hidden" name="remember_token" value="{{ @$user['remember_token'] }}">
                    <input type="hidden" name="created_at" value="{{ @$user['created_at'] }}">
                    <input type="hidden" name="updated_at" value="{{ @$user['updated_at'] }}">

                    <input type="hidden" name="id" value="{{ @$user['id'] }}">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Поле</th>
                            <th scope="col">Значение</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                Роли
                                @if ($errors->has('roles'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <textarea name="roles" class="text-dark">{{ @$user['roles'] }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                email
                                @if ($errors->has('email'))
                                    <br><strong class="text-danger">{{ $errors->first('email') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="email" value="{{ @$user['email'] }}" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Телефон
                                @if ($errors->has('phone'))
                                    <br><strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="phone" value="{{ @$user['phone'] }}" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Пароль
                                @if ($errors->has('password'))
                                    <br><strong class="text-danger">{{ $errors->first('password') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="password" class="text-dark">
                            </td>
                        </tr>

                        <tr>
                            <td>Включен</td>
                            <td>
                                <select name="enabled">
                                    @if(@$user['enabled'] == 0)
                                        <option value="0" selected>Нет</option>
                                        <option value="1">Да</option>
                                    @else
                                        <option value="0">Нет</option>
                                        <option value="1" selected>Да</option>
                                    @endif
                                </select>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <input type="submit" class="btn btn-primary" value="Сохранить">
                </form>
            </div>
        </div>
    </div>
@endsection
