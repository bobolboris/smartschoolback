@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Классы</h1>
            <a href="{{ route('admin.classes.addForm') }}" class="btn" style="padding-top: 8px;">
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
                        Название
                    </th>
                    <th scope="col">
                        Админ
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
                            {{ ($class['admin'] == null) ? 'NULL' : $class['admin']['user']['email'] }}
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
