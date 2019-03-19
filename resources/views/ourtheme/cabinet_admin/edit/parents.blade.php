@extends('cabinet_admin.index')

@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Родители</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$parent['id'] }}">
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
                                Фамилия
                                @if ($errors->has('surname'))
                                    <br><strong class="text-danger">{{ $errors->first('surname') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="surname" value="{{ @$parent['surname'] }}" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Имя
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="name" value="{{ @$parent['name'] }}" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Отчество
                                @if ($errors->has('patronymic'))
                                    <br><strong class="text-danger">{{ $errors->first('patronymic') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="patronymic" value="{{ @$parent['patronymic'] }}"
                                       class="text-dark">
                            </td>
                        </tr>
                        <tr class="class">
                            <td>
                                Пользователь
                                @if ($errors->has('user_id'))
                                    <br><strong class="text-danger">{{ $errors->first('user_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="user_id">
                                    @foreach($users as $user)
                                        @if($user['id'] == @$parent['user_id'])
                                            <option value="{{ @$user['id'] }}"
                                                    selected>{{ @$user['id'] . " - " . @$user['email'] }}</option>
                                        @else
                                            <option
                                                value="{{ @$user['id'] }}">{{ @$user['id'] . " - " . @$user['email'] }}</option>
                                        @endif
                                    @endforeach
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