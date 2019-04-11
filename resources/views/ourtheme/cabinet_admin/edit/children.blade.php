@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Ученики</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$child->id }}">
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
                                <input type="text" name="surname" value="{{ @$child->profile->surname }}"
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
                                <input type="text" name="name" value="{{ @$child->profile->name }}"
                                       class="text-dark">
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
                                <input type="text" name="patronymic" value="{{ @$child->profile->patronymic }}"
                                       class="text-dark">
                            </td>
                        </tr>
                        <tr class="class">
                            <td>
                                <span>Класс</span>
                                @if ($errors->has('class_id'))
                                    <br><strong class="text-danger">{{ $errors->first('class_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="class_id">
                                    @foreach($classes as $class)
                                        @if($class['id'] == @$child['class_id'])
                                            <option value="{{ @$class->id }}"
                                                    selected>{{ $class->name . ' - ' . $class->school->name }}</option>
                                        @else
                                            <option
                                                value="{{ @$class->id }}">{{ $class->name . ' - ' . $class->school->name  }}</option>
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
