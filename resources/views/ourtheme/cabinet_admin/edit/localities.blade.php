@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Местоположения</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$locality->id }}">
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
                                <span>Тип</span>
                                @if ($errors->has('type'))
                                    <br><strong class="text-danger">{{ $errors->first('type') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="type">
                                    @foreach($types as $key => $type)
                                        @if(@$key == @$locality['admin_id'])
                                            <option value="{{ @$key }}" selected>{{ @$type }}</option>
                                        @else
                                            <option value="{{ @$key }}">{{ @$type }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Название</span>
                                @if ($errors->has('name'))
                                    <br><strong class="text-danger">{{ $errors->first('name') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="name" value="{{ $locality->name }}" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Насленный пункт</span>
                                @if ($errors->has('locality_id'))
                                    <br><strong class="text-danger">{{ $errors->first('locality_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="locality_id">
                                    @foreach($localities as $value)
                                        @if (@$value->id == @$locality->locality_id)
                                            <option value="{{ @$value->id }}" selected>{{ @$value->name }}</option>
                                        @else
                                            <option value="{{ @$value->id }}">{{ @$value->name }}</option>
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
