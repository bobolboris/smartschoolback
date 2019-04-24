@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Специальные возможности</h1>
        </div>


        <div class="row justify-content-center">
            <form method="post" action="{{ route('admin.db.recreate') }}">
                @csrf
                <input type="submit" class="btn btn-primary" value="Пересоздать БД">
            </form>
        </div>

        <p class="h1 text-center" style="margin-top: 50px;">Загрузка данных из файла</p>
        <div class="row justify-content-center">
            <form method="post" action="{{ route('admin.db.load_children') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>
                        <span>Верхняя левая координата:</span>
                        <input type="text" name="start" class="form-control" placeholder="A1">
                    </label>
                    @if ($errors->has('start'))
                        <br><strong>{{ $errors->first('start') }}</strong>
                    @endif
                </div>
                <div class="form-group">
                    <label>
                        <span>Нижняя правая координата:</span>
                        <input type="text" name="finish" class="form-control" placeholder="L1">
                    </label>
                    @if ($errors->has('finish'))
                        <br><strong>{{ $errors->first('finish') }}</strong>
                    @endif
                </div>
                <div class="form-group">
                    <input type="file" name="file" accept=".xlsx, .xls, .ods">
                    @if ($errors->has('file'))
                        <br><strong>{{ $errors->first('file') }}</strong>
                    @endif
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Загрузить">
                </div>
            </form>
        </div>
    </div>
@endsection
