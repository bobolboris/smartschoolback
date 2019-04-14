@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Администраторы (расширенная)</h1>
            <a href="{{ route('admin.admins_extended.addForm') }}" class="btn" style="padding-top: 8px;">
                <i class="fas fa-plus" style="font-size: 30px;"></i>
            </a>
        </div>

        <div class="row justify-content-center">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">profile_id</th>
                    <th scope="col">user_id</th>
                    <th scope="col">school_id</th>
                    <th scope="col">locality_id</th>
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
                            {{ $admin->profile_id ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $admin->user_id ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $admin->school_id ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $admin->locality_id ?? 'NULL' }}
                        </td>
                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.admins_extended.editForm', ['id' => $admin->id]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.admins_extended.removeForm', ['id' => $admin->id]) }}">
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
            {{ $admins->links() }}
        </div>
    </div>
@endsection
