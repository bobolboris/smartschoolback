@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Администраторы (расширенная)</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$admin['id'] }}">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Поле</th>
                            <th scope="col">Значение</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                profile_id
                                @if ($errors->has('profile_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profile_id') }}</strong>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <select name="profile_id">
                                    @foreach($profiles as $profile)
                                        @if(@$profile['id'] == @$admin['profile_id'])
                                            <option value="{{ @$profile['id'] }}"
                                                    selected>{{ @$profile['full_name'] }}</option>
                                        @else
                                            <option value="{{ @$profile['id'] }}">{{ @$profile['full_name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                user_id
                                @if ($errors->has('user_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <select name="user_id">
                                    @foreach($users as $user)
                                        @if(@$user['id'] == @$admin['user_id'])
                                            <option value="{{ @$user['id'] }}" selected>{{ @$user['email'] }}</option>
                                        @else
                                            <option value="{{ @$user['id'] }}">{{ @$user['email'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Адрес - Школа
                                @if ($errors->has('school_id'))
                                    <br><strong class="text-danger">{{ $errors->first('school_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="school_id">
                                    @foreach($schools as $school)
                                        @if(@$school['id'] == @$admin['school_id'])
                                            <option value="{{ @$school['id'] }}"
                                                    selected>{{ @$school['address'] . " - " . @$school['name'] }}</option>
                                        @else
                                            <option
                                                value="{{ @$school['id'] }}">{{ @$school['address'] . " - " . @$school['name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                locality_id
                                @if ($errors->has('locality_id'))
                                    <br><strong class="text-danger">{{ $errors->first('locality_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="locality_id">
                                    @foreach($localities as $locality)
                                        @if(@$locality['id'] == @$admin['locality_id'])
                                            <option value="{{ @$locality['id'] }}"
                                                    selected>{{ @$locality['name'] }}</option>
                                        @else
                                            <option
                                                value="{{ @$locality['id'] }}">{{ @$locality['name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <input type="submit" class="btn btn-primary" value="Сохранить">
                </form>
            </div>
        </div>
    </div>
@endsection

