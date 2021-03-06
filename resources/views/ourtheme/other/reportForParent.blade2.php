<html>

<head>
    <meta charset="utf-8">
</head>

<style>
    * {
        font-family: times;
    }

    body {
        padding-left: 60px;
        padding-right: 60px;
    }

    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
        text-align: center;
    }

    h2 {
        text-align: center;
    }

    .right {
        text-align: right;
    }

    img {
        float: left;
    }
</style>

<body>
<img
    src="data:image/png;base64,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">

<div class="right">
    <p>{{$fullName}}</p>
    <p>Дата формирования: {{$dateFormation}}</p>
    <p>Начальная дата: {{$startDate}}</p>
    <p>Конечная дата: {{$finishDate}}</p>
</div>


<h2>Отчет о посещении:</h2>

@foreach($dates as $date => $accesses)
    <p>{{$date}}</p>
    <table>
        <thead>
        <tr>
            <td>№</td>
            <td>Время</td>
            <td>Направление</td>
        </tr>
        </thead>
        <tbody>
        @foreach($accesses as $access)
            <tr>
                <td>{{$access['number']}}</td>
                <td>{{$access['time']}}</td>
                <td>{{$access['direction']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endforeach

</body>

</html>
