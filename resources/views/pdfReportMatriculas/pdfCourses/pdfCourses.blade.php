<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba </title>
</head>

<style>
    .HeaderTitles {
        width: 100%;
        /* border: #000;
        border: 1px solid black;
        border-collapse: collapse;
        border-color: black; */
    }

    .headerLogo {
        width: 10%;
        /* border: 1px solid black;
        border-collapse: collapse;
        border-color: black; */
    }

    .headerTitle {
        width: 100%;
        /* border: 1px solid black;
        border-collapse: collapse;
        border-color: black; */
    }

    .headerLogo {
        width: 10%;
        /* border: 1px solid black;
        border-collapse: collapse;
        border-color: black; */
    }

    .actasHeader {
        width: 100%;
        /* border: 1px solid black;
        border-collapse: collapse;
        border-color: black; */
    }

    .actasHeaderTotle {
        width: 60%;
        /* border: 1px solid black;
        border-collapse: collapse;
        border-color: black; */
    }

    .actasHeadeCode1 {
        width: 30%;

    }

    .actasHeadeCode2 {
        width: 30%;

    }

    .contenedor {
        position: relative;
    }

    .superpuesta {
        position: absolute;
        top: 0;
        left: 0;
    }

    .title {
        /* Estilos para el contenedor div */
        font-weight: bold;
    }

    .title p {
        margin: 0;
        /* Eliminar el margen por defecto de los párrafos */
    }

    .title {
        color: black;
        text-align: center;
    }

    .title_1 {
        font-size: 23px;
    }

    .title_2 {
        font-size: 18px;
    }

    .title_3 {
        font-size: 15px;
    }

    .title_4 {
        font-size: 21px;
    }

    .head {
        margin-top: 1px;

    }

    .headerDetaillsCourse {
        width: 100%;
    }


    .head_conten {
        font-size: 13px;
        text-align: left;
        margin-top: -8px;

    }

    .head_1 {
        /* color: red; */
        font-weight: bold;
    }

    .head_2 {
        text-transform: uppercase;

    }

    .rightHeader .head_conten {
        font-size: 11px;
        text-align: left;
        margin-top: -8px;
        text-transform: uppercase;
    }

    .leftHeader1 .head_conten {
        font-size: 11px;
        text-align: left;
        text-transform: uppercase;

    }

    .leftHeader2 .head_conten {
        font-size: 11px;
        text-align: left;
        text-transform: uppercase;

    }

    .leftHeader3 .head_conten {
        font-size: 11px;
        text-align: left;
        text-transform: uppercase;

    }


    .rightHeader {
        width: 30%;
        font-size: 11px;

        /* border: 1px solid black;
        border-collapse: collapse;
        border-color: black; */
        text-align: left;
        text-transform: uppercase;


    }

    .leftHeader1 {
        width: 50%;
        font-size: 11px;
        text-align: left;

    }

    .leftHeader2 {
        width: 30%;
        font-size: 11px;
        text-align: left;
        text-transform: uppercase;


    }

    .leftHeader3 {
        width: 20%;
        font-size: 11px;
        text-align: left;

    }


    .headContend {
        float: left;
        /* Flotar a la izquierda */
        /* width: 70%; */
        /* Ocupar el 50% del ancho */
        box-sizing: border-box;
        /* Incluye el padding y border en el ancho */
        font-size: 12px;
        display: flex;

    }

    .headContend_right {
        float: right;
        /* Flotar a la derecha */
        width: 30%;
        /* Ocupar el 50% del ancho */
        box-sizing: border-box;
        /* Incluye el padding y border en el ancho */
        font-size: 10px;

    }


    .paginate {
        margin-right: 0;
        /* Puedes ajustar el margen para el elemento paginate si es necesario */
    }

    .container1 {
        display: flex;
        justify-content: center;
    }

    .col {
        width: 100%;
        /* Ajusta el ancho según sea necesario */
    }

    .contenDetaill {
        width: 100%;
        /* Cambiado a 100% para que se ajuste al ancho de .col */
        border-collapse: collapse;
        /* Esto elimina el espacio entre las celdas de la tabla */
    }

    .in-p {
        font-size: 10px;
        text-align: left;
        /* Esto alineará el texto a la izquierda */
    }


    .table_head {
        color: #000;
        font-size: 8px;

    }

    .table_contend {
        width: 100%;
    }

    .table_contend,
    .th,
    .td {
        border: 1px solid black;
        border-collapse: collapse;
        border-color: black;
        padding: 3px 4px;
        word-wrap: break-word;
        font-size: 10px;
    }

    .th {
        text-align: center;
    }

    .index {
        width: 3%;
        text-align: center;

    }

    .code {
        width: 9%;
        text-align: center;

    }

    .status {
        width: 5%;

    }

    .names {
        width: 40%;
    }

    .groups {
        width: 5%;
    }

    .promedioPracial {
        width: 13%;
        font-size: 9px;
    }

    .promedioFinal {
        width: 11%;
        font-size: 10px;

    }

    .promedio {
        width: 100px;

    }


    .promediotd {
        font-size: 14px;
    }

    .promedioString {
        width: 50px;
    }

    .promedio1 {
        width: 15%;
        font-size: 10px;
    }

    .promedioString {
        width: 15%;
    }

    /* Footer */
    .formulaFooter {
        width: 100%;


        font-size: 11px;
    }

    .formula1 {
        width: 5%;
        font-size: 14px;
        font-weight: bold;

    }

    .formula2 {
        width: 38%;
        font-size: 15px;
        font-weight: bold;
        border: 1px solid black;
        border-collapse: collapse;
        border-color: black;
        padding: 3px 4px;
        word-wrap: break-word;
    }

    .formula3 {
        width: 50%;
        text-align: right;
    }

    .formula1_d {
        width: 5%;
        font-size: 7px;
        text-align: left;
    }

    .formula2_d {
        width: 38%;
    }

    .formula3_d {
        width: 50%;
        text-align: right;

    }

    .firmaFooter {
        width: 100%;
    }

    .firma0 {
        width: 10%;
    }

    .firmaall {
        width: 80%;
        text-align: center;
        /* border: 1px solid black;
        border-collapse: collapse;
        border-color: black; */
        padding: 43px 14px;
        word-wrap: break-word;
        font-size: 15px;
    }
</style>

<body>
    <div class="body_cont">
        <div class="table_head">
            <table class="table_contend">
                <thead class="table_thead">
                    <tr class="tr">
                        <th scope="col" class="index th">
                            N°
                        </th>
                        <th scope="col" class="code th">
                            NUM. MATRICULA
                        </th>
                        <th scope="col" class="names th">
                            APELLIDOS Y NOMBRES
                        </th>
                        <th scope="col" class="promedioFinal th">
                            MODALIDAD MATRICULA
                        </th>
                        <th scope="col" class="promedioFinal th">
                            FECHA MATRICULA
                        </th>
                    </tr>

                </thead>
                <tbody>
                    @php $numeration = 1; @endphp

                    @foreach($datas as $data)
                    <tr>
                        <td class="index td">{{ $numeration++ }}</td>
                        <td class="code td">{{ $data['studentCode'] }}</td>
                        <td class="names td">{{ $data['lastName1'] }} {{ $data['lastName2'] }} {{ $data['name'] }}</td>
                        <td class="promediotd td" style="text-align: center;  font-weight: bold;">{{ $data['studentCondition'] }}</td>
                        <td class="promediotd td" style="text-align: center;  font-weight: bold;">{{ $data['enrollmentDate'] }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>


<!-- <img src="{{ asset('assets/images/logoPosGrado.png') }}" alt="Tu Imagen" width="300" height="200"> -->