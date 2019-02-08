@extends('cabinet_admin.index')

@section('content')
    <div class="container-fluid content">
        <div class="object-delPer">
            <form action="{{ $action }}" method="POST">
                @csrf
                <p class="mb-2 text-primary">Вы уверены, что хотите удалить?</p>
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="submit" class="btn btn-primary" value="Да">
                <a href="{{ $backurl }}" class="btn btn-primary">Отмена</a>
            </form>
        </div>
    </div>

@endsection

