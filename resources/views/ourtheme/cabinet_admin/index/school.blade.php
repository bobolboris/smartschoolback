@extends('cabinet_admin.index')

@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Школы</h1>
        </div>
        <div class="row justify-content-end">
            <form class="form-search" action="{{ url()->full() }}">
                <input type="text" name="search" class="input-medium search-query" value="{{request('search')}}">
                <button type="submit" class="btn text-white bg-dark">Найти</button>
            </form>
        </div>

        <div class="row justify-content-center">
            <a href="{{ route('admin.schools.addForm') }}" class="btn text-white bg-dark addBtn">Добавить
                <i class="fas fa-plus"></i></a>
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