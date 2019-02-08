@extends('cabinet_admin.index')

@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Ученики</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$child['id'] }}">
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
                                <input type="text" name="surname" value="{{ @$child['surname'] }}" class="text-dark">
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
                                <input type="text" name="name" value="{{ @$child['name'] }}" class="text-dark">
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
                                <input type="text" name="patronymic" value="{{ @$child['patronymic'] }}"
                                       class="text-dark">
                            </td>
                        </tr>
                        <tr class="class">
                            <td>
                                Класс
                                @if ($errors->has('class_id'))
                                    <br><strong class="text-danger">{{ $errors->first('class_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="class_id">
                                    @foreach($classes as $class)
                                        @if($class['id'] == @$child['class_id'])
                                            <option value="{{ @$class['id'] }}"
                                                    selected>{{ $class['name'] . " - " . $class['school']['name'] }}</option>
                                        @else
                                            <option
                                                value="{{ @$class['id'] }}">{{ $class['name'] . " - " . $class['school']['name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
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
                                        @if($user['id'] == @$child['user_id'])
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
                        <tr class="class">
                            <td>
                                System ID
                                @if ($errors->has('system_id'))
                                    <br><strong class="text-danger">{{ $errors->first('system_id') }}</strong>
                                @endif
                            </td>
                            <td><input type="text" name="system_id" value="{{ @$child['system_id'] }}"></td>
                        </tr>

                        </tbody>
                    </table>
                    <input type="submit" class="btn btn-primary" value="Сохранить">
                </form>
            </div>
        </div>
    </div>
@endsection
