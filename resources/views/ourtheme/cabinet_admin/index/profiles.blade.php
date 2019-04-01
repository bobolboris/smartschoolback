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
                    <th scope="col">
                        ID
                        @if ($errors->has('id'))
                            <br><strong class="text-danger">{{ $errors->first('id') }}</strong>
                        @endif
                    </th>
                    <th scope="col">
                        Фамилия
                        @if ($errors->has('surname'))
                            <br><strong class="text-danger">{{ $errors->first('surname') }}</strong>
                        @endif
                    </th>
                    <th scope="col">
                        Имя
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </th>
                    <th scope="col">
                        Отчество
                        @if ($errors->has('patronymic'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('patronymic') }}</strong>
                            </span>
                        @endif
                    </th>
                    <th scope="col">Управление учеткой</th>
                </tr>
                </thead>
                <tbody>

                @foreach($profiles as $profile)
                    <tr>
                        <td>
                            {{ $profile['id'] }}
                        </td>
                        <td>
                            {{ $profile['surname'] }}
                        </td>
                        <td>
                            {{ $profile['name'] }}
                        </td>
                        <td>
                            {{ $profile['patronymic'] }}
                        </td>
                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.profiles.editForm', ['id' => $profile['id']]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.profiles.removeForm', ['id' => $profile['id']]) }}">
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

