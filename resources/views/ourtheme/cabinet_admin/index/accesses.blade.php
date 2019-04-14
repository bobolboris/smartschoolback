@extends('cabinet_admin.index')

@section('content')
    <div class="container content">
        <div class="row justify-content-center">
            <h1>Проходы</h1>
            <a href="{{ route('admin.accesses.addForm') }}" class="btn" style="padding-top: 8px;">
                <i class="fas fa-plus" style="font-size: 30px;"></i>
            </a>
        </div>

        <div class="row justify-content-center">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Время</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Направление</th>
                    <th scope="col">Причина</th>
                    <th scope="col">Ребенок</th>
                    <th scope="col">Пропускной пункт</th>
                    <th scope="col">System ID</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($accesses as $access)
                    <tr>
                        <td>
                            {{ $access->id }}
                        </td>
                        <td>
                            {{ $access->time }}
                        </td>
                        <td>
                            {{ $access->date }}
                        </td>
                        <td>
                            {{ $directionsArray[$access->direction] }}
                        </td>
                        <td>
                            {{ $access->cause }}
                        </td>
                        <td>
                            {{ $access->child->profile->full_name ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $access->access_point->name ?? 'NULL' }}
                        </td>
                        <td>
                            {{ $access->system_id }}
                        </td>
                        <td>
                            <div class="icons">
                                <a href="{{ route('admin.accesses.editForm', ['id' => $access->id]) }}">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{ route('admin.accesses.removeForm', ['id' => $access->id]) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="row justify-content-center" style="margin-top: 20px;">
            {{ $accesses->links() }}
        </div>
    </div>
@endsection
