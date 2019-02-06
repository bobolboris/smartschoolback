@extends('cabinet_admin.index')

@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Точки доступа</h1>
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

                <form method="POST" action="{{route('admin.access_points.add')}}">
                    @csrf
                    <tr>
                        <td>
                            #
                        </td>
                        <td class="name">
                            <input type="text" name="name" value="">
                        </td>
                        <td class="zonea">
                            <input type="number" name="zonea" value="" style="width: 50px">
                        </td>
                        <td class="zoneb">
                            <input type="number" name="zoneb" value="" style="width: 50px">
                        </td>
                        <td>
                            <select name="school_id">
                                @foreach($schools as $school)
                                    <option
                                        value="{{$school->id}}">{{$school->address . " - " . $school->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="system_id">
                            <input type="number" name="system_id" value="" style="width: 80px">
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

                @foreach($access_points as $access_point)
                    <form method="POST" action="{{route('admin.access_points.save')}}">
                        @csrf
                        <tr>
                            <td>
                                <input type="hidden" name="id" value="{{$access_point->id}}">
                                {{$access_point->id}}
                            </td>
                            <td class="name">
                                <input type="text" name="name" value="{{$access_point->name}}">
                            </td>
                            <td class="zonea">
                                <input type="number" name="zonea" value="{{$access_point->zonea}}" style="width: 50px">
                            </td>
                            <td class="zoneb">
                                <input type="number" name="zoneb" value="{{$access_point->zoneb}}" style="width: 50px">
                            </td>
                            <td>
                                <select name="school_id">
                                    @foreach($schools as $school)
                                        @if($school->id == $access_point->school_id)
                                            <option value="{{$school->id}}"
                                                    selected>{{$school->address . " - " . $school->name}}</option>
                                        @else
                                            <option
                                                value="{{$school->id}}">{{$school->address . " - " . $school->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input name="system_id" type="number" value="{{$access_point->system_id}}"
                                       style="width: 80px">
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
