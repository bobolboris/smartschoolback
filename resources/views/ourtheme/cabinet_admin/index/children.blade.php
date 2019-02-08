@extends('cabinet_admin.index')

@section('content')

    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Ученики</h1>
        </div>
        <div class="row justify-content-end">
            <form class="form-search" action="{{ url()->full() }}">
                <input type="text" name="search" class="input-medium search-query" value="{{request('search')}}">
                <button type="submit" class="btn text-white bg-dark">Найти</button>
            </form>
        </div>

        <div class="row justify-content-center">
            <a href="{{ route('admin.children.addForm') }}" class="btn text-white bg-dark addBtn">Добавить <i class="fas fa-plus"></i></a>
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
                        Класс
                    </th>
                    <th scope="col">
                        Пользователь<br>(id - email)
                    </th>
                    <th scope="col">
                        System ID
                    </th>
                    <th scope="col">Управление учеткой</th>
                </tr>
                </thead>
                <tbody>

                @foreach($children as $child)
                    <tr>
                        <td>
                            {{ $child['id'] }}
                        </td>
                        <td class="surname">
                            {{ $child['surname'] }}
                        </td>
                        <td class="name">
                            {{ $child['name'] }}
                        </td>
                        <td class="patronymic">
                            {{ $child['patronymic'] }}
                        </td>
                        <td class="class">
                            {{ $child['school_class']['name'] }}
                        </td>
                        <td class="user">
                            @if ($child['user_id'] != null)
                                {{ $child['user']['id'] . " - " . $child['user']['email'] }}
                            @else
                                NULL
                            @endif
                        </td>
                        <td class="system_id">
                            {{ $child['system_id'] }}
                        </td>

                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.children.editForm', ['id' => $child['id']]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.children.removeForm', ['id' => $child['id']]) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
