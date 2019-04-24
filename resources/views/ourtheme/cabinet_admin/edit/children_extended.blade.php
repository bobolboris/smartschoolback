@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Ученики</h1>
        </div>

        <div class="row justify-content-center">
            <div class="object-editPer">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $child->id }}">
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
                                <span>profile_id</span>
                                @if ($errors->has('profile_id'))
                                    <br><strong class="text-danger">{{ $errors->first('profile_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="profile_id">
                                    @foreach($profiles as $profile)
                                        @if($profile->id == @$child->class_id)
                                            <option value="{{ @$profile->id }}"
                                                    selected>{{ @$profile->id . ' ' . @$profile->full_name }}</option>
                                        @else
                                            <option
                                                value="{{ @$profile->id }}">{{ @$profile->id . ' ' . @$profile->full_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span>class_id</span>
                                @if ($errors->has('class_id'))
                                    <br><strong class="text-danger">{{ $errors->first('class_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="class_id">
                                    @foreach($classes as $class)
                                        @if(@$class->id == @$child->class_id)
                                            <option value="{{ @$class->id  }}"
                                                    selected>{{ @$class->name . " - " . @$class->school->name }}</option>
                                        @else
                                            <option
                                                value="{{ @$class->id  }}">{{ @$class->name . " - " . @$class->school->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span>photo_id</span>
                                @if ($errors->has('photo_id'))
                                    <br><strong class="text-danger">{{ $errors->first('photo_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="photo_id">
                                    @foreach($photos as $photo)
                                        @if(@$photo->id == @$child->photo_id)
                                            <option value="{{ @$photo->id }}" selected>{{ @$photo->path }}</option>
                                        @else
                                            <option value="{{ @$photo->id }}">{{ @$photo->path }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span>user_id</span>
                                @if ($errors->has('user_id'))
                                    <br><strong class="text-danger">{{ $errors->first('user_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <select name="user_id">
                                    @foreach($users as $user)
                                        @if(@$user->id == @$child->user_id)
                                            <option value="{{ @$user->id }}" selected>{{ @$user->email }}</option>
                                        @else
                                            <option value="{{ @$user->id }}">{{ @$user->email }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span>ИНН</span>
                                @if ($errors->has('inn'))
                                    <br><strong class="text-danger">{{ $errors->first('inn') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="text" name="inn" value="{{ @$child->inn }}" class="text-dark">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span>system_id</span>
                                @if ($errors->has('system_id'))
                                    <br><strong class="text-danger">{{ $errors->first('system_id') }}</strong>
                                @endif
                            </td>
                            <td>
                                <input type="number" name="system_id" value="{{ @$child->system_id }}">
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
