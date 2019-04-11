@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Точки доступа</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$access_point->id }}">
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
                                <span>Название</span>
                                @if ($errors->has('name'))
                                    <br><strong>{{ $errors->first('name') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="name" value="{{ @$access_point->name }}" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>ZoneA</span>
                                @if ($errors->has('zonea'))
                                    <br><strong class="text-danger">{{ $errors->first('zonea') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="number" name="zonea" value="{{ @$access_point->zonea }}"
                                       class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>ZoneB</span>
                                @if ($errors->has('zoneb'))
                                    <br><strong class="text-danger">{{ $errors->first('zoneb') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="number" name="zoneb" value="{{ @$access_point->zoneb }}"
                                       class="text-dark">
                            </td>
                        </tr>
                        <tr class="class">
                            <td>
                                <span>Адрес - Школа</span>
                                @if ($errors->has('school_id'))
                                    <br><strong class="text-danger">{{ $errors->first('school_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="school_id">
                                    @foreach($schools as $school)
                                        @if(@$school->id == @$access_point->school_id)
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
                        <tr class="class">
                            <td>
                                System ID
                                @if ($errors->has('system_id'))
                                    <br><strong class="text-danger">{{ $errors->first('system_id') }}</strong>
                                @endif
                            </td>
                            <td><input type="number" name="system_id" value="{{ @$access_point->system_id }}"></td>
                        </tr>

                        </tbody>
                    </table>
                    <input type="submit" class="btn btn-primary" value="Сохранить">
                </form>
            </div>
        </div>
    </div>
@endsection

