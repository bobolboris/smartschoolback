@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Точки доступа</h1>
            <a href="{{ route('admin.access_points.addForm') }}" class="btn" style="padding-top: 8px;">
                <i class="fas fa-plus" style="font-size: 30px;"></i>
            </a>
        </div>

        <div class="row justify-content-center">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Название</th>
                    <th scope="col">ZoneA</th>
                    <th scope="col">ZoneB</th>
                    <th scope="col">Адрес - Школа</th>
                    <th scope="col">System ID</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($access_points as $access_point)
                    <tr>
                        <td>
                            {{ $access_point->id }}
                        </td>
                        <td>
                            {{ $access_point->name }}
                        </td>
                        <td>
                            {{ $access_point->zonea }}
                        </td>
                        <td>
                            {{ $access_point->zoneb }}
                        </td>
                        <td>
                            {{ $access_point->school->address . ' - ' . $access_point->school->name }}
                        </td>
                        <td>
                            {{ $access_point->system_id }}
                        </td>
                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.access_points.editForm', ['id' => $access_point->id]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.access_points.removeForm', ['id' => $access_point->id]) }}">
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
            {{ $access_points->links() }}
        </div>
    </div>
@endsection
