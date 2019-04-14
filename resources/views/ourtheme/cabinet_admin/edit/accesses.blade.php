@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Проходы</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$access->id }}">
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
                                <span>Время</span>
                                @if ($errors->has('time'))
                                    <br><strong>{{ $errors->first('time') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="time" name="time" value="{{ @$access->time }}" step="1" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Дата</span>
                                @if ($errors->has('date'))
                                    <br><strong class="text-danger">{{ $errors->first('date') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="date" name="date" value="{{ @$access->date }}" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Направление</span>
                                @if ($errors->has('direction'))
                                    <br><strong class="text-danger">{{ $errors->first('direction') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="direction">
                                    @foreach($directionsArray as $key => $value)
                                        @if($key == @$access->direction)
                                            <option value="{{ $key }}" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Причина</span>
                                @if ($errors->has('cause'))
                                    <br><strong class="text-danger">{{ $errors->first('cause') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="number" value="{{ @$access->cause }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Ребенок</span>
                                @if ($errors->has('child_id'))
                                    <br><strong class="text-danger">{{ $errors->first('child_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="child_id">
                                    @foreach ($children as $child)
                                        @if ($child->id == @$access->child_id )
                                            <option value="{{ $child->id }}"
                                                    selected>
                                                {{ ($child->id != null) ? $child->id . ' - ' . @$child->profile->full_name  : 'NULL' }}
                                            </option>
                                        @else
                                            <option
                                                value="{{ $child->id }}">
                                                {{ ($child->id != null) ? $child->id . ' - ' . @$child->profile->full_name  : 'NULL' }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Пропускной пункт</span>
                                @if ($errors->has('access_point_id'))
                                    <br><strong class="text-danger">{{ $errors->first('access_point_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="access_point_id">
                                    @foreach ($accessPoints as $accessPoint)
                                        @if ($accessPoint->id == @$access->access_point_id )
                                            <option value="{{ $accessPoint->id }}"
                                                    selected>{{ ($accessPoint->id != null) ? $accessPoint->id . ' - ' . @$accessPoint->name : 'NULL' }}
                                            </option>
                                        @else
                                            <option
                                                value="{{ $accessPoint->id }}">
                                                {{ ($accessPoint->id != null) ? $accessPoint->id . ' - ' . @$accessPoint->name : 'NULL' }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>System id</span>
                                @if ($errors->has('system_id'))
                                    <br><strong class="text-danger">{{ $errors->first('system_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="number" name="system_id" value="{{ @$access->system_id }}">
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
