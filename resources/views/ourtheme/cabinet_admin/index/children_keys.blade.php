@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Пропуска</h1>
            <a href="{{ route('admin.children_keys.addForm') }}" class="btn" style="padding-top: 8px;">
                <i class="fas fa-plus" style="font-size: 30px;"></i>
            </a>
        </div>

        <div class="row justify-content-center">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">
                        ID
                        @if ($errors->has('id'))
                            <br><strong class="text-danger">{{ $errors->first('id') }}</strong>
                        @endif
                    </th>
                    <th scope="col">
                        CodeKey
                        @if ($errors->has('codekey'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('codekey') }}</strong>
                            </span>
                        @endif
                    </th>

                    <th scope="col">
                        Короткий codekey
                        @if ($errors->has('short_codekey'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('short_codekey') }}</strong>
                            </span>
                        @endif
                    </th>

                    <th scope="col">
                        Дата создания
                        @if ($errors->has('codekeytime'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('codekeytime') }}</strong>
                            </span>
                        @endif
                    </th>

                    <th scope="col">
                        Время истечения
                        @if ($errors->has('expires'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('expires') }}</strong>
                            </span>
                        @endif
                    </th>

                    <th scope="col">
                        Включен
                        @if ($errors->has('status'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('status') }}</strong>
                            </span>
                        @endif
                    </th>
                    <th scope="col">
                        Ученик
                        @if ($errors->has('child_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('child_id') }}</strong>
                            </span>
                        @endif
                    </th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($children_keys as $children_key)
                    <tr>
                        <td>
                            {{ $children_key->id }}
                        </td>
                        <td>
                            0x{{ bin2hex($children_key->codekey) ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $children_key->short_codekey }}
                        </td>
                        <td>
                            {{ $children_key->codekeytime }}
                        </td>
                        <td>
                            {{ $children_key->expires ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $children_key->status }}
                        </td>
                        <td>
                            {{ $children_key->child->profile->full_name ?? 'NULL' }}
                        </td>
                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.children_keys.editForm', ['id' => $children_key->id]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.children_keys.removeForm', ['id' => $children_key->id]) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $children_keys->links() }}
    </div>
@endsection
