@extends('cabinet_admin.index')

@section('content')

    <div class="container content">
        <div class="row justify-content-center">
            <h1>Ученики</h1>
            <a href="{{ route('admin.children_extended.addForm') }}" class="btn" style="padding-top: 8px;">
                <i class="fas fa-plus" style="font-size: 30px;"></i>
            </a>
        </div>

        <div class="row justify-content-center">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">profile_id</th>
                    <th scope="col">class_id</th>
                    <th scope="col">photo_id</th>
                    <th scope="col">user_id</th>
                    <th scope="col">ИНН</th>
                    <th scope="col">system_id</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($children as $child)
                    <tr>
                        <td>
                            {{ $child->id }}
                        </td>
                        <td>
                            {{  $child->profile_id ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $child->class_id ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $child->photo_id ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $child->user_id ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $child->inn ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $child->system_id ?? 'NULL' }}
                        </td>
                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.children_extended.editForm', ['id' => $child->id]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.children_extended.removeForm', ['id' => $child->id]) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="row justify-content-center" style="margin-top: 20px;">
            {{ $children->links() }}
        </div>
    </div>
@endsection
