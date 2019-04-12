@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Администраторы</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$admin->id }}">
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
                                <span>Роли</span>
                                @if ($errors->has('roles'))
                                    <br><strong>{{ $errors->first('roles') }}</strong>
                                @endif
                            </td>
                            <td>
                                @foreach($roles as $key => $value)
                                    <label class="row">
                                        <span>{{ $key }}</span>
                                        @if (in_array($value, @$admin->user->roles_array ?? []))
                                            <input type="checkbox" name="roles[]" class="form-check-input"
                                                   value="{{ $value }}" checked>
                                        @else
                                            <input type="checkbox" name="roles[]" class="form-check-input"
                                                   value="{{ $value }}">
                                        @endif
                                    </label>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>E-mail</span>
                                @if ($errors->has('email'))
                                    <br><strong class="text-danger">{{ $errors->first('email') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="email" value="{{ @$admin->user->email }}" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Телефон</span>
                                @if ($errors->has('phone'))
                                    <br><strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="phone" value="{{ @$admin->user->phone }}" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Пароль</span>
                                @if ($errors->has('password'))
                                    <br><strong class="text-danger">{{ $errors->first('password') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="password" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Фамилия</span>
                                @if ($errors->has('surname'))
                                    <br><strong class="text-danger">{{ $errors->first('surname') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="surname" value="{{ @$admin->profile->surname }}"
                                       class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Имя</span>
                                @if ($errors->has('name'))
                                    <br><strong>{{ $errors->first('name') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="name" value="{{ @$admin->profile->name }}" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Отчество</span>
                                @if ($errors->has('patronymic'))
                                    <br><strong class="text-danger">{{ $errors->first('patronymic') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="patronymic" value="{{ @$admin->profile->patronymic }}"
                                       class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Адрес - Школа</span>
                                @if ($errors->has('school_id'))
                                    <br><strong class="text-danger">{{ $errors->first('school_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="school_id">
                                    @foreach($schools as $school)
                                        @if(@$school->id == @$admin->school_id)
                                            <option value="{{ @$school->id }}"
                                                    selected>{{ @$school->address . " - " . @$school->name }}</option>
                                        @else
                                            <option
                                                value="{{ @$school->id }}">{{ @$school->address . " - " . @$school->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>locality_id</span>
                                @if ($errors->has('locality_id'))
                                    <br><strong class="text-danger">{{ $errors->first('locality_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="locality_id">
                                    @foreach($localities as $locality)
                                        @if(@$locality->id == @$admin->locality_id)
                                            <option value="{{ @$locality->id }}"
                                                    selected>{{ @$locality->name }}</option>
                                        @else
                                            <option
                                                value="{{ @$locality->id }}">{{ @$locality->name }}</option>
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
