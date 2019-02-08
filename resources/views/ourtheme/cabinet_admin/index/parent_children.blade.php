@extends('cabinet_admin.index')

@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Дети</h1>
        </div>

        <div class="row justify-content-center">
            <a href="{{ route('admin.parent_children.addChildForm', ['id' => $id]) }}" class="btn text-white bg-dark addBtn">
                Добавить
                <i class="fas fa-plus"></i>
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
                    <th scope="col">Школа</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody id="childBody">
                @foreach($children as $child)
                    <tr>
                        <td>{{ $child['id'] }}</td>
                        <td>{{ $child['surname'] }}</td>
                        <td>{{ $child['name'] }}</td>
                        <td>{{ $child['patronymic'] }}</td>
                        <td>{{ $child['school_class']['name'] }}</td>
                        <td>{{ $child['school_class']['school']['name'] }}</td>
                        <td>
                            <a href="{{ route('admin.parents.removeForm', ['id' => $child['id']]) }}">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

