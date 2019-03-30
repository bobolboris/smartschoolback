@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Школы</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$school['id'] }}">
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
                                Адрес
                                @if ($errors->has('address'))
                                    <br><strong class="text-danger">{{ $errors->first('address') }}</strong>
                                @endif
                            </td>
                            <td>
                                <textarea name="address">{{ @$school['address'] }}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Имя
                                @if ($errors->has('name'))
                                    <br><strong class="text-danger">{{ $errors->first('name') }}</strong>
                                @endif
                            </td>
                            <td>
                                <textarea name="name">{{ @$school['name'] }}</textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Насленный пункт
                                @if ($errors->has('locality_id'))
                                    <br><strong class="text-danger">{{ $errors->first('locality_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="locality_id">
                                    @foreach($localities as $locality)
                                        @if ($locality['id'] == @$school['locality_id'])
                                            <option value="{{ $locality['id'] }}"
                                                    selected>{{ $locality['name'] }}</option>
                                        @else
                                            <option value="{{ $locality['id'] }}">{{ $locality['name'] }}</option>
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

