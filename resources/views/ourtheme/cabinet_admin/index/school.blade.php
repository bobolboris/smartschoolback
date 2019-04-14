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
                    <th scope="col">ID</th>
                    <th scope="col">Адрес</th>
                    <th scope="col">Название</th>
                    <th scope="col">Населенный пункт</th>
                    <th scope="col">Управление учеткой</th>
                </tr>
                </thead>
                <tbody>

                @foreach($schools as $school)
                    <tr>
                        <td>
                            {{ $school->id }}
                        </td>
                        <td>
                            {{ $school->address }}
                        </td>
                        <td>
                            {{ $school->name }}
                        </td>
                        <td>
                            {{ $school->locality->name ?? 'NULL' }}
                        </td>

                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.schools.editForm', ['id' => $school->id]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.schools.removeForm', ['id' => $school->id]) }}">
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
            {{ $schools->links() }}
        </div>
    </div>
@endsection
