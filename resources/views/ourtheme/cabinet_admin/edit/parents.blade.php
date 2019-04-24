@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Родители</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$parent->id }}">
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
                                <span>Фамилия</span>
                                @if ($errors->has('surname'))
                                    <br><strong class="text-danger">{{ $errors->first('surname') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="surname" value="{{ @$parent->profile->surname }}"
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
                                <input type="text" name="name" value="{{ @$parent->profile->name }}" class="text-dark">
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
                                <input type="text" name="patronymic" value="{{ @$parent->profile->patronymic }}"
                                       class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>ИНН</span>
                                @if ($errors->has('inn'))
                                    <br><strong class="text-danger">{{ $errors->first('inn') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="inn" value="{{ @$parent->inn }}" class="text-dark">
                            </td>
                        </tr>
                        <tr class="class">
                            <td>
                                <span>Пользователь</span>
                                @if ($errors->has('user_id'))
                                    <br><strong class="text-danger">{{ $errors->first('user_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="user_id">
                                    @foreach($users as $user)
                                        @if($user->id == @$parent->user_id)
                                            <option value="{{ @$user->id }}"
                                                    selected>{{ @$user->id . ' - ' . @$user->email }}</option>
                                        @else
                                            <option
                                                value="{{ @$user->id }}">{{ @$user->id . ' - ' . @$user->email }}</option>
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
