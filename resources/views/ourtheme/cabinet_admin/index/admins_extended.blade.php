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
                    <th scope="col">
                        ID
                        @if ($errors->has('id'))
                            <br><strong class="text-danger">{{ $errors->first('id') }}</strong>
                        @endif
                    </th>
                    <th scope="col">
                        profile_id
                        @if ($errors->has('profile_id'))
                            <br><strong class="text-danger">{{ $errors->first('profile_id') }}</strong>
                        @endif
                    </th>
                    <th scope="col">
                        user_id
                        @if ($errors->has('user_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('user_id') }}</strong>
                            </span>
                        @endif
                    </th>
                    <th scope="col">
                        school_id
                        @if ($errors->has('school_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('school_id') }}</strong>
                            </span>
                        @endif
                    </th>
                    <th scope="col">
                        locality_id
                        @if ($errors->has('locality_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('locality_id') }}</strong>
                            </span>
                        @endif
                    </th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($admins as $admin)
                    <tr>
                        <td>
                            {{ $admin['id'] }}
                        </td>
                        <td>
                            {{ $showNULL($admin['profile_id']) }}
                        </td>
                        <td>
                            {{ $showNULL($admin['user_id']) }}
                        </td>
                        <td>
                            {{ $showNULL($admin['school_id']) }}
                        </td>
                        <td>
                            {{ $showNULL($admin['locality_id']) }}
                        </td>

                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.admins_extended.editForm', ['id' => $admin['id']]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.admins_extended.removeForm', ['id' => $admin['id']]) }}">
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
