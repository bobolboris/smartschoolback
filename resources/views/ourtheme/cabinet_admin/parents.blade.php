@extends('cabinet_admin.index')

@section('content')
    <!--удалить родителя -->
    <div class="popup" id="popupDelPar">
        <div class="object-delPer">
            <form action="" method="">
                <p class="mb-2 text-primary">Вы уверены, что хотите удалить?</p>
                <p id="fioPlaceDelPar" class="text-danger"></p>
                <input type="submit" id="okDelPer" class="btn btn-primary" value="Да">
                <input type="button" class="closePP btn btn-primary" value="Отмена">
            </form>
        </div>
    </div>

    <!--изменить родителя -->
    <div class="popup" id="popupEditPar">
        <div class="object-editPer">
            <form action="" method="">
                <p>Изменить профиль родителя</p>
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Поле</th>
                        <th scope="col">Значение</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>ФИО</td>
                        <td>
                            <input type="text" id="fioPlaceEditPar" class="text-dark">
                            <!-- <p id="fioPlace" class="text-info"></p> -->
                        </td>
                    </tr>
                    <tr>
                        <td>Телефон</td>
                        <td>
                            <input type="text" id="phonePlaceEditPar" class="text-dark" value="071-322-12-15">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="submit" id="okEditPer" class="btn btn-primary" value="Да">
                <input type="button" class="closePP btn btn-primary" value="Отмена">
            </form>
        </div>
    </div>

    <!--создать родителя -->
    <div class="popup" id="popupCreatePar">
        <div class="object-createPer">
            <form action="" method="">
                <p>Создать профиль родителя</p>
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Поле</th>
                        <th scope="col">Значение</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>ФИО</td>
                        <td>
                            <input type="text" id="fioPlaceСreatePar" class="text-dark">
                        </td>
                    </tr>
                    <tr>
                        <td>Телефон</td>
                        <td>
                            <input type="text" id="phonePlaceCreatePar" class="text-dark">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <input type="submit" id="okCreatePer" class="btn btn-primary" value="Да">
                <input type="button" class="closePP btn btn-primary" value="Отмена">
            </form>
        </div>
    </div>

    <!--просмотреть детей родителя -->
    <div class="popup" id="popupShowParChild">
        <div class="object-showParChild">
            <form action="" method="">
                <p>Дети <span id="fioPlaceShowChildPar" class="text-dark"></span></p>
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Школа</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>tmp Name</td>
                        <td>57</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>tmp Name</td>
                        <td>112</td>
                    </tr>
                    </tbody>
                </table>
                <input type="submit" id="okShowChildPer" class="btn btn-primary" value="Да">
                <input type="button" class="closePP btn btn-primary" value="Отмена">
            </form>
        </div>
    </div>

    <!-- Родитель -->
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Родитель</h1>
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
                        Пользователь (id - email)
                        @if ($errors->has('user_id'))
                            <br><strong class="text-danger">{{ $errors->first('user_id') }}</strong>
                        @endif
                    </th>
                    <th scope="col" width="20%">Управление учеткой</th>
                    <th scope="col" width="25%">Дети</th>
                </tr>
                </thead>
                <tbody>

                <form method="POST" action="{{route('admin.parents.add')}}">
                    @csrf
                    <tr>
                        <td>#</td>
                        <td class="surname">
                            <input type="text" name="surname" value="">
                        </td>
                        <td class="name">
                            <input type="text" name="name" value="">
                        </td>
                        <td class="patronymic">
                            <input type="text" name="patronymic" value="">
                        </td>
                        <td class="user">
                            <select name="user_id">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->id . " - " . $user->email}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <div class="icons">
                                <button type="submit">
                                    <i class="fas fa-user-edit"></i>
                                </button>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                </form>


                @foreach($parents as $parent)

                    <tr>
                        <form method="POST" action="{{route('admin.parents.save')}}">
                            @csrf
                            <td>
                                {{$parent->id}}
                                <input type="hidden" name="id" value="{{$parent->id}}">
                            </td>
                            <td class="surname">
                                <input type="text" name="surname" value="{{$parent->surname}}">
                            </td>
                            <td class="name">
                                <input type="text" name="name" value="{{$parent->name}}">
                            </td>
                            <td class="patronymic">
                                <input type="text" name="patronymic" value="{{$parent->patronymic}}">
                            </td>
                            <td class="user">
                                <select name="user_id">
                                    @foreach($users as $user)
                                        @if($user->id == $parent->user_id)
                                            <option value="{{$user->id}}"
                                                    selected>{{$user->id . " - " . $user->email}}</option>
                                        @else
                                            <option value="{{$user->id}}">{{$user->id . " - " . $user->email}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="icons">
                                    <button>
                                        <i class="fas fa-user-edit"></i>
                                    </button>
                                    <button>
                                        <i class="fas fa-trash-alt show_popup" rel="popupDelPar"></i>
                                    </button>
                                </div>
                            </td>

                        </form>
                        <td>
                            <button class="btn btn-primary show_popup" rel="popupShowParChild">Просмотр</button>
                        </td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
