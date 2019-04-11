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
                    <th scope="col">Фамилия</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Отчество</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Адрес - Школа</th>
                    <th scope="col">Местоположение</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($admins as $admin)
                    <tr>
                        <td>
                            {{ $admin->id }}
                        </td>
                        <td>
                            {{ $admin->profile->surname ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $admin->profile->name ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $admin->profile->patronymic ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $admin->user->email ?? 'NULL' }}
                        </td>
                        <td>
                            @if ($admin->school_id == null)
                                {{ $admin->school->address . ' - ' . $admin->school->name }}
                            @else
                                {{ 'NULL' }}
                            @endif
                        </td>
                        <td>
                            {{ $admin->locality->name ?? 'NULL' }}
                        </td>
                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.access_points.editForm', ['id' => $admin->id]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.access_points.removeForm', ['id' => $admin->id]) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        {{ $access_points->links() }}
    </div>
@endsection
