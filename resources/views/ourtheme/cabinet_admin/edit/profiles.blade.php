@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Профиль</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$profile->id }}">
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
                                <input type="text" name="surname" value="{{ @$profile->surname }}" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Имя</span>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="name" value="{{ @$profile->name }}" class="text-dark">
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
                                <input type="text" name="patronymic" value="{{ @$profile->patronymic }}"
                                       class="text-dark">
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
