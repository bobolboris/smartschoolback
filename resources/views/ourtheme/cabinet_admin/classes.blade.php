@extends('cabinet_admin.index')

@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Классы</h1>
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
                        Название
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </th>
                    <th scope="col">
                        Школа
                        @if ($errors->has('school_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('school_id') }}</strong>
                            </span>
                        @endif
                    </th>
                    <th scope="col">Управление учеткой</th>
                </tr>
                </thead>
                <tbody>

                <form method="POST" action="{{route('admin.classes.add')}}">
                    @csrf
                    <tr>
                        <td>
                            #
                        </td>
                        <td class="name">
                            <input type="text" name="name" value="">
                        </td>
                        <td>
                            <select name="school_id">
                                @foreach($schools as $school)
                                    <option value="{{$school->id}}">{{$school->address . " - " . $school->name}}</option>
                                @endforeach
                            </select>
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

                @foreach($classes as $class)
                    <form method="POST" action="{{route('admin.classes.save')}}">
                        @csrf
                        <tr>
                            <td>
                                <input type="hidden" name="id" value="{{$class->id}}">
                                {{$class->id}}
                            </td>
                            <td class="name">
                                <input type="text" name="name" value="{{$class->name}}">
                            </td>
                            <td>
                                <select name="school_id">
                                    @foreach($schools as $school)
                                        @if($school->id == $class->school_id)
                                            <option value="{{$school->id}}" selected>{{$school->address . " - " . $school->name}}</option>
                                        @else
                                            <option value="{{$school->id}}">{{$school->address . " - " . $school->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
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
