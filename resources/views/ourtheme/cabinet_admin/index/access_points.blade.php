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
                    <th scope="col">
                        ID
                        @if ($errors->has('id'))
                            <br><strong class="text-danger">{{ $errors->first('id') }}</strong>
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
                        ZoneA
                        @if ($errors->has('zonea'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('zonea') }}</strong>
                            </span>
                        @endif
                    </th>

                    <th scope="col">
                        ZoneB
                        @if ($errors->has('zoneb'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('zoneb') }}</strong>
                            </span>
                        @endif
                    </th>

                    <th scope="col">
                        Адрес - Школа
                        @if ($errors->has('school_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('school_id') }}</strong>
                            </span>
                        @endif
                    </th>

                    <th scope="col">
                        System ID
                        @if ($errors->has('system_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('system_id') }}</strong>
                            </span>
                        @endif
                    </th>
                    <th scope="col">Управление учеткой</th>
                </tr>
                </thead>
                <tbody>


                @foreach($access_points as $access_point)
                    <tr>
                        <td>
                            {{ $access_point->id }}
                        </td>
                        <td class="name">
                            {{ $access_point->name }}
                        </td>
                        <td class="zonea">
                            {{ $access_point->zonea }}
                        </td>
                        <td class="zoneb">
                            {{ $access_point->zoneb }}
                        </td>
                        <td>
                            {{ $access_point->school->address . " - " . $access_point->school->name }}
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
        {{ $access_points->links() }}
    </div>
@endsection
