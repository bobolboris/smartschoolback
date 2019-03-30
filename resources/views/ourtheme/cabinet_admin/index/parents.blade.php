@extends('cabinet_admin.index')

@section('content')

    <!-- Родитель -->
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Родитель</h1>
            <a href="{{ route('admin.parents.addForm') }}" class="btn" style="padding-top: 8px;">
                <i class="fas fa-plus" style="font-size: 30px;"></i>
            </a>
        </div>

        <div class="row justify-content-center">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">
                        ID
                    </th>
                    <th scope="col">
                        Фамилия
                    </th>
                    <th scope="col">
                        Имя
                    </th>
                    <th scope="col">
                        Отчество
                    </th>
                    <th scope="col">
                        Пользователь<br>(id - email)
                    </th>
                    <th scope="col" width="20%">Управление учеткой</th>
                    <th scope="col" width="25%">Дети</th>
                </tr>
                </thead>
                <tbody>

                @foreach($parents as $parent)
                    <tr>
                        <td>
                            {{ $parent['id'] }}
                        </td>
                        <td class="surname">
                            {{ $parent['profile']['surname'] }}
                        </td>
                        <td class="name">
                            {{ $parent['profile']['name'] }}
                        </td>
                        <td class="patronymic">
                            {{$parent['profile']['patronymic'] }}
                        </td>
                        <td class="user">
                            {{ $parent['user']['id'] . " - " . $parent['user']['email'] }}
                        </td>
                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.parents.editForm', ['id' => $parent['id']]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.parents.removeForm', ['id' => $parent['id']]) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>

                        <td>
                            <a href="{{route('admin.parent_children', ['id' => $parent['id']])}}" class="btn btn-primary">Просмотр</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
