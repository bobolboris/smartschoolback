@extends('cabinet_admin.index')

@section('content')

    <!-- Родитель -->
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <h1>Точки доступа</h1>
        </div>
        <div class="row justify-content-end">
            <form class="form-search">
                <input type="text" class="input-medium search-query">
                <button type="submit" class="btn text-white bg-dark">Найти</button>
            </form>
        </div>

        <div class="row justify-content-center">
            <button class="btn text-white bg-dark addBtn show_popup" rel="popupCreatePar">Добавить <i
                    class="fas fa-plus"></i></button>
        </div>

        <div class="row justify-content-center">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" width="15%">#</th>
                    <th scope="col" width="40%">ФИО родителя</th>
                    <th scope="col" width="20%">Управление учеткой</th>
                    <th scope="col" width="25%">Дети</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td class="fio">Родичев Р.Ю.</td>
                    <td>
                        <div class="icons">
                            <i class="fas fa-user-edit show_popup" rel="popupEditPar"></i>
                            <i class="fas fa-trash-alt show_popup" rel="popupDelPar"></i>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-primary show_popup" rel="popupShowParChild">Просмотр</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="fio">Петров А.Г.</td>
                    <td>
                        <div class="icons">
                            <i class="fas fa-user-edit show_popup" rel="popupEditPar"></i>
                            <i class="fas fa-trash-alt show_popup" rel="popupDelPar"></i>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-primary show_popup" rel="popupShowParChild">Просмотр</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="fio">Поличев М.Н.</td>
                    <td>
                        <div class="icons">
                            <i class="fas fa-user-edit show_popup" rel="popupEditPar"></i>
                            <i class="fas fa-trash-alt show_popup" rel="popupDelPar"></i>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-primary show_popup" rel="popupShowParChild">Просмотр</button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td class="fio">Коксик О.П.</td>
                    <td>
                        <div class="icons">
                            <i class="fas fa-user-edit show_popup" rel="popupEditPar"></i>
                            <i class="fas fa-trash-alt show_popup" rel="popupDelPar"></i>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-primary show_popup" rel="popupShowParChild">Просмотр</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
