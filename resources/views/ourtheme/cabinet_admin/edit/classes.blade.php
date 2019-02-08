@extends('cabinet_admin.index')

@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Классы</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$class['id'] }}">
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
                                Имя
                                @if ($errors->has('name'))
                                    <br><strong class="text-danger">{{ $errors->first('name') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="name" value="{{ @$class['name'] }}" class="text-dark">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Школа
                                @if ($errors->has('school_id'))
                                    <br><strong class="text-danger">{{ $errors->first('school_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="school_id">
                                    @foreach($schools as $school)
                                        @if(@$school['id'] == @$class['school_id'])
                                            <option value="{{ @$school['id'] }}"
                                                    selected>{{ @$school['address'] . " - " . @$school['name'] }}</option>
                                        @else
                                            <option
                                                value="{{ @$school['id'] }}">{{ @$school['address'] . " - " . @$school['name'] }}</option>
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
