@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Настройки - {{ $email }}</h1>
        </div>

        <div class="row justify-content-center">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Ключ</th>
                    <th scope="col">Значение</th>
                    <th scope="col">Управление учеткой</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <form method="POST" action="{{ route('admin.settings.add') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ request('id') }}">
                        <td>
                            #
                        </td>
                        <td>
                            <input type="text" name="key" placeholder="Ключ" required>
                        </td>
                        <td>
                            <input type="text" name="value" placeholder="Значение" required>
                        </td>
                        <td>
                            <div class="icons">
                                <input type="submit" value="Добавить" class="btn btn-success">
                            </div>
                        </td>
                    </form>
                </tr>

                @foreach($settings as $setting)
                    <tr>
                        <form method="POST" action="{{ route('admin.settings.save') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $setting->id }}">
                            <input type="hidden" name="user_id" value="{{ $setting->user_id }}">
                            <td>
                                {{ $setting->id }}
                            </td>
                            <td>
                                {{ $setting->key }}
                            </td>
                            <td>
                                <input name="value" type="text" value="{{ $setting->value }}" placeholder="Значение"
                                       required>
                            </td>
                            <td>
                                <div class="icons">
                                    <input type="submit" value="Сохранить" class="btn btn-success">
                                    <a href="{{ route('admin.settings.remove' , ['id' => $setting->id, 'user_id' => request('id')]) }}"
                                       class="btn btn-danger">Удалить</a>
                                </div>
                            </td>
                        </form>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="row justify-content-center" style="margin-top: 20px;">
            {{ $settings->links() }}
        </div>
    </div>
@endsection
