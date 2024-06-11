<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba xlsx</title>
</head>
<style>
    .test{
        text-align: center;
        font-size: 15px;
    }
</style>
<body>

<div class="container">
    @foreach($data as $itemPlan)
        <table>
            <tr>
                <th colspan="12" style="text-align: center; height: 50px; font-size: 14px;border: solid; vertical-align: middle">{{$itemPlan['planName']}}</th>
                <th colspan="3" style="font-size: 14px; text-align: center; border: solid; vertical-align: middle">Plan: {{$itemPlan['planVersion']}}</th>
            </tr>
            <thead>

            <tr>
                <th style="border: solid; text-align: center; font-size: 13; vertical-align: middle" rowspan="2">Codigo</th>
                <th style="border: solid; text-align: center; font-size: 13; vertical-align: middle" rowspan="2">Nombre de Curso</th>
                <th style="border: solid; text-align: center; font-size: 13; vertical-align: middle" rowspan="2">Ciclo</th>
                <th style="text-align: center; border: solid; font-size: 13" colspan="12">Grupos</th>
            </tr>
            <tr>
                @foreach($data[0]['courses'][0]['groups'] AS $groups)
                    <th style="text-align: center; border: solid">{{$groups['groupName']}}</th>
                @endforeach
                <th style="text-align: center; border: solid">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $itemPlan['courses'] AS $courses)
                <tr>
                    <td style="text-align: center;border: solid">{{$courses['courseCode']}}</td>
                    <td style="width: 400px;border: solid">{{$courses['courseName']}}</td>
                    <td style="text-align: center;border: solid">{{$courses['courseCycle']}}</td>
                    @foreach($courses['groups'] AS $countGroup)
                        <td style="text-align: center;border: solid">
                            @if($countGroup['count'] != 0)
                                {{$countGroup['count']}}
                            @else
                                -
                            @endif
                        </td>
                    @endforeach
                    <td style="text-align: center;border: solid">{{$courses['total']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach
</div>

</body>

</html>


