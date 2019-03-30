@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Школы</h1>
            <a href="{{ route('admin.schools.addForm') }}" class="btn" style="padding-top: 8px;">
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
                        Адрес
                        @if ($errors->has('address'))
                            <br><strong class="text-danger">{{ $errors->first('address') }}</strong>
                        @endif
                    </th>
                    <th scope="col">
                        Название
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </th>
                    <th scope="col">
                        Населенный пункт
                    </th>
                    <th scope="col">Управление учеткой</th>
                </tr>
                </thead>
                <tbody>

                @foreach($schools as $school)
                    <tr>
                        <td>
                            {{ $school['id'] }}
                        </td>
                        <td class="surname">
                            {{ $school['address'] }}
                        </td>
                        <td class="name">
                            {{ $school['name'] }}
                        </td>
                        <td class="name">
                            {{ ($school['locality'] == null) ? 'NULL' : $school['locality']['name'] }}
                        </td>

                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.schools.editForm', ['id' => $school['id']]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.schools.removeForm', ['id' => $school['id']]) }}">
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
