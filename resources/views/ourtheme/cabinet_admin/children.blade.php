@extends('cabinet_admin.index')

@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Ученики</h1>
        </div>
        <div class="row justify-content-end">
            <form class="form-search">
                <input type="text" class="input-medium search-query">
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
                            <br><strong class="text-danger">{{ $errors->first('patronymic') }}</strong>
                        @endif
                    </th>
                    <th scope="col">
                        Класс
                        @if ($errors->has('class_id'))
                            <br><strong class="text-danger">{{ $errors->first('class_id') }}</strong>
                        @endif
                    </th>
                    <th scope="col">
                        Пользователь (id - email)
                        @if ($errors->has('user_id'))
                            <br><strong class="text-danger">{{ $errors->first('user_id') }}</strong>
                        @endif
                    </th>
                    <th scope="col">
                        System ID
                        @if ($errors->has('system_id'))
                            <br><strong class="text-danger">{{ $errors->first('system_id') }}</strong>
                        @endif
                    </th>
                    <th scope="col">Управление учеткой</th>
                </tr>
                </thead>
                <tbody>

                <form method="POST" action="{{route('admin.children.add')}}">
                    @csrf
                    <tr>
                        <td>
                            #
                        </td>
                        <td class="surname">
                            <input type="text" name="surname" value="">
                        </td>
                        <td class="name">
                            <input type="text" name="name" value="">
                        </td>
                        <td class="patronymic">
                            <input type="text" name="patronymic" value="">
                        </td>
                        <td class="class">
                            <select name="class_id">
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="user">
                            <select name="user_id">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->id . " - " . $user->email}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="system_id">
                            <input type="text" name="system_id" value="" style="width: 100%;">
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

                @foreach($children as $child)
                    <form method="POST" action="{{route('admin.children.save')}}">
                        @csrf
                        <tr>
                            <td>
                                <input type="hidden" name="id" value="{{$child->id}}">
                                {{$child->id}}
                            </td>
                            <td class="surname">
                                <input type="text" name="surname" value="{{$child->surname}}">
                            </td>
                            <td class="name">
                                <input type="text" name="name" value="{{$child->name}}">
                            </td>
                            <td class="patronymic">
                                <input type="text" name="patronymic" value="{{$child->patronymic}}">
                            </td>
                            <td class="class">
                                <select name="class_id">
                                    @foreach($classes as $class)
                                        @if($class->id == $child->class_id)
                                            <option value="{{$class->id}}" selected>{{$class->name}}</option>
                                        @else
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td class="user">
                                <select name="user_id">
                                    @foreach($users as $user)
                                        @if($user->id == $child->user_id)
                                            <option value="{{$user->id}}"
                                                    selected>{{$user->id . " - " . $user->email}}</option>
                                        @else
                                            <option value="{{$user->id}}">{{$user->id . " - " . $user->email}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td class="system_id">
                                <input type="text" name="system_id" value="{{$child->system_id}}" style="width: 100%;">
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
