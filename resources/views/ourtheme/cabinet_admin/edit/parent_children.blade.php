@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Добавить ребенка</h1>
        </div>

        <div class="row justify-content-center">
            <form method="POST" action="{{ route('admin.parent_children.addChild') }}">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <div class="form-group">
                    <select name="child_id">
                        @foreach($children as $child)
                            <option value="{{ $child['id'] }}">
                                {{ $child['profile']['surname'] . " " . $child['profile']['name'] . " " . $child['profile']['patronymic']
                                . " - " . $child['class']['name'] . " - " . $child['class']['school']['name']  }}
                            </option>
                        @endforeach

                    </select>
                    @if ($errors->has('child_id'))
                        <br><strong class="text-danger">{{ $errors->first('child_id') }}</strong>
                    @endif
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>

            </form>
        </div>
    </div>
@endsection
