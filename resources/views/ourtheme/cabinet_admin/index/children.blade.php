@extends('cabinet_admin.index')

@section('content')

    <div class="container content">
        <div class="row justify-content-center">
            <h1>Ученики</h1>
            <a href="{{ route('admin.children.addForm') }}" class="btn" style="padding-top: 8px;">
                <i class="fas fa-plus" style="font-size: 30px;"></i>
            </a>
        </div>

        <div class="row justify-content-center">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Отчество</th>
                    <th scope="col">Класс</th>
                    <th scope="col">ИНН</th>
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
                            {{ $child->profile->surname ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $child->profile->name ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $child->profile->patronymic ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $child->class->name ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $child->inn ?? 'NULL' }}
                        </td>
                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.children.editForm', ['id' => $child->id]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.children.removeForm', ['id' => $child->id]) }}">
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
