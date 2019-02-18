<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <style>
        * {
            font-family: times;
            font-size: 50%;
        }

        .logoWrapper {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            margin-top: 40px;
        }

        .logoWrapper img {
            text-align: right;
            margin-right: 50px;
        }

        table {
            width: 80%;
            margin: 50px auto;
            border: 1px solid black;
            border-collapse: collapse;
            text-align: left;
        }

        td, th {
            border-bottom: 1px solid gray;
            border-left: 1px solid black;
            padding: 3px;
            text-align: left;
        }

        th {
            background-color: #8e9cb2;
            border-bottom: 1px solid black;
            padding: 5px;
        }

        caption {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table-2 td {
            text-align: left;
        }

        .col-1 {
            width: 40%;
        }

        .col-2 {
            width: 60%;
        }

        .addressBlock {
            margin-left: 75px;
            float: left;
        }

        .addressBlock p {
            margin: 0;
        }

    </style>
</head>
<body>
<div class="logoWrapper">
    <div class="addressBlock">
        <p>Донецкая Народная Республика</p>
        <p>{{$school}}</p>
        <p>Адрес: {{$address}}</p>
    </div>
    <img style="float: right;" ;
         src="data:image/png;base64,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">
    <div style="clear: both"></div>
</div>

<table class="table-1">
    <caption>Отчет о посещении учебного заведения</caption>
    <tr>
        <td class="col-1">Дата формирования отчета:</td>
        <td class="col-2">{{$dateFormation}}</td>
    </tr>
    <tr>
        <td>ФИО ученика:</td>
        <td>{{$fullNameChild}}</td>
    </tr>
    <tr>
        <td>ФИО родителя:</td>
        <td>{{$fullNameParent}}</td>
    </tr>
    <tr>
        <td>Учебное заведение:</td>
        <td>{{$school}}</td>
    </tr>
    <tr>
        <td>Класс:</td>
        <td>{{$class}}</td>
    </tr>
    <tr>
        <td>Начало периода:</td>
        <td>{{$startDate}}</td>
    </tr>
    <tr>
        <td>Конец периода:</td>
        <td>{{$finishDate}}</td>
    </tr>
</table>


<table class="table-2">
    <tr>
        <th colspan="4">Электронная проходная</th>
    </tr>
    <tr>
        <th width="30%">Дата</th>
        <th width="10%">Время</th>
        <th>Точка доступа</th>
        <th width="15%">Направление</th>
    </tr>

    @foreach($dates as $date => $accesses)
        @foreach($accesses as $access)
            <tr>
                <td>{{$date}}</td>
                <td>{{$access['time']}}</td>
                <td>{{$access['access_point']}}</td>
                <td>{{$access['direction']}}</td>
            </tr>
        @endforeach
    @endforeach

</table>


</body>
</html>
