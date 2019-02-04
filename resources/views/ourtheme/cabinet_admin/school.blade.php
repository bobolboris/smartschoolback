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

                <form method="POST" action="{{route('admin.schools.add')}}">
                    @csrf
                    <tr>
                        <td>
                            #
                        </td>
                        <td class="address" style="width: 150%;">
                            <input type="text" name="address" value="" style="width: 100%;">
                        </td>
                        <td class="name">
                            <input type="text" name="name" value="">
                        </td>
                        <td>
                            <div class="icons">
                                <button type="submit">
                                    <i class="fas fa-save"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </form>

                @foreach($schools as $school)
                    <form method="POST" action="{{route('admin.schools.save')}}">
                        @csrf
                        <tr>
                            <td>
                                <input type="hidden" name="id" value="{{$school->id}}">
                                {{$school->id}}
                            </td>
                            <td class="surname">
                                <input type="text" name="address" value="{{$school->address}}" style="width: 100%;">
                            </td>
                            <td class="name">
                                <input type="text" name="name" value="{{$school->name}}">
                            </td>

                            <td>
                                <div class="icons">
                                    <button type="submit">
                                        <i class="fas fa-save"></i>
                                    </button>
                                    <button>
                                        <i class="fas fa-trash-alt show_popup" rel="popupDelPar"></i>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    </form>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
