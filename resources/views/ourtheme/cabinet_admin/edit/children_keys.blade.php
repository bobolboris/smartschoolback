@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Пропуска</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$children_key->id }}">
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
                                <span>CodeKey</span>
                                @if ($errors->has('codekey'))
                                    <br><strong>{{ $errors->first('codekey') }}</strong>
                                @endif
                            </td>
                            <td>
                                <span>0x</span>
                                <input type="text" name="codekey" value="{{ bin2hex(@$children_key->codekey) }}" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Короткий CodeKey</span>
                                @if ($errors->has('short_codekey'))
                                    <br><strong class="text-danger">{{ $errors->first('short_codekey') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="short_codekey" value="{{ @$children_key->short_codekey }}"
                                       class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Дата создания</span>
                                @if ($errors->has('codekeytime'))
                                    <br><strong class="text-danger">{{ $errors->first('codekeytime') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="datetime-local" name="codekeytime" value="{{ @$children_key->codekeytime }}"
                                       step="1" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Время истечения</span>
                                @if ($errors->has('expires'))
                                    <br><strong class="text-danger">{{ $errors->first('expires') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="datetime-local" name="expires" value="{{ @$children_key->expires }}"
                                       step="1" class="text-dark">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Включен</span>
                                @if ($errors->has('status'))
                                    <br><strong class="text-danger">{{ $errors->first('status') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="status">
                                    @if(@$children_key->status == 0)
                                        <option value="0" selected>Нет</option>
                                        <option value="1">Да</option>
                                    @else
                                        <option value="0">Нет</option>
                                        <option value="1" selected>Да</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Ученик</span>
                                @if ($errors->has('child_id'))
                                    <br><strong class="text-danger">{{ $errors->first('child_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="child_id">
                                    @foreach($children as $child)
                                        @if(@$child->id == @$children_key->child_id)
                                            <option value="{{ @$child->id }}"
                                                    selected>{{ @$child->id . ' ' . @$child->profile->full_name}}</option>
                                        @else
                                            <option
                                                value="{{ @$child->id }}">{{ @$child->id . ' ' . @$child->profile->full_name }}</option>
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
