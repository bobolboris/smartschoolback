@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Профили</h1>
            <a href="{{ route('admin.profiles.addForm') }}" class="btn" style="padding-top: 8px;">
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
                    <th scope="col">Управление учеткой</th>
                </tr>
                </thead>
                <tbody>

                @foreach($profiles as $profile)
                    <tr>
                        <td>
                            {{ $profile->id }}
                        </td>
                        <td>
                            {{ $profile->surname }}
                        </td>
                        <td>
                            {{ $profile->name }}
                        </td>
                        <td>
                            {{ $profile->patronymic }}
                        </td>
                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.profiles.editForm', ['id' => $profile->id]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.profiles.removeForm', ['id' => $profile->id]) }}">
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
            {{ $profiles->links() }}
        </div>
    </div>
@endsection

