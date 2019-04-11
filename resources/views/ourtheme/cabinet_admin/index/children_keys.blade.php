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
                    <th scope="col">ID</th>
                    <th scope="col">CodeKey</th>
                    <th scope="col">Короткий CodeKey</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Время истечения</th>
                    <th scope="col">Включен</th>
                    <th scope="col">Ученик</th>
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
