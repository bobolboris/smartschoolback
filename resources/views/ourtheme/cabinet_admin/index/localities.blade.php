@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Местоположения</h1>
            <a href="{{ route('admin.localities.addForm') }}" class="btn" style="padding-top: 8px;">
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
                        Тип
                    </th>
                    <th scope="col">
                        Название
                    </th>
                    <th scope="col">
                        Родительское местоположение
                    </th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($localities as $locality)
                    <tr>
                        <td>
                            {{ $locality->id }}
                        </td>
                        <td class="name">
                            {{ $locality->type_name }}
                        </td>
                        <td>
                            {{ $locality->name }}
                        </td>
                        <td>
                            {{ $showNULL(@$locality->locality->name) }}
                        </td>
                        <td>
                            <div class="icons">
                                <div class="icons">
                                    <a href="{{ route('admin.localities.editForm', ['id' => $locality->id]) }}">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <pre>       </pre>
                                    <a href="{{ route('admin.localities.removeForm', ['id' => $locality->id]) }}">
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
        {{ $localities->links() }}
    </div>
@endsection
