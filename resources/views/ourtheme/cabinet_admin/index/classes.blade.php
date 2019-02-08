@extends('cabinet_admin.index')

@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Классы</h1>
        </div>
        <div class="row justify-content-end">
            <form class="form-search" action="{{ url()->full() }}">
                <input type="text" name="search" class="input-medium search-query" value="{{request('search')}}">
                <button type="submit" class="btn text-white bg-dark">Найти</button>
            </form>
        </div>

        <div class="row justify-content-center">
            <a href="{{ route('admin.classes.addForm') }}" class="btn text-white bg-dark addBtn">Добавить <i
                    class="fas fa-plus"></i></a>
        </div>

        <div class="row justify-content-center">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">
                        ID
                    </th>
                    <th scope="col">
                        Название
                    </th>
                    <th scope="col">
                        Школа
                    </th>
                    <th scope="col">Управление учеткой</th>
                </tr>
                </thead>
                <tbody>

                @foreach($classes as $class)
                    <tr>
                        <td>
                            {{ $class['id'] }}
                        </td>
                        <td class="name">
                            {{ $class['name'] }}
                        </td>
                        <td>
                            {{ $class['school']['name'] }}
                        </td>
                        <td>
                            <div class="icons">
                                <div class="icons">
                                    <a href="{{ route('admin.classes.editForm', ['id' => $class['id']]) }}">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <pre>       </pre>
                                    <a href="{{ route('admin.classes.removeForm', ['id' => $class['id']]) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
