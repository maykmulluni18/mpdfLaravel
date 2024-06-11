@extends('pdf.test.layout')
@section('content')
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th style="
                width: 200px;
            ">Course</th>
            <th>Cycle</th>
            <th> Credits</th>
            <th>Hours</th>
            <th>Teacher</th>
        </tr>
    </thead>
    <tbody>

        @foreach(range(1, 20) as $index)
        @foreach($courses as $course)
        <tr>
            <td>{{ $course['id'] }}</td>
            <td>{{ $course['course'] }}</td>
            <td>{{ $course['cycle'] }}</td>
            <td>{{ $course['credits'] }}</td>
            <td>{{ $course['hours'] }}</td>
            <td>{{ $course['teacher'] }}</td>
        </tr>
        @endforeach
        @endforeach
    </tbody>
</table>

<table border="1">
    <thead>
        <tr>
            <th colspan="2">
                <span>
                    Grupo A
                </span>
            </th>
            <th colspan="2">Grupo B</th>
        </tr>
        <tr>
            <th>
                <div class="text-rotate">

                    <span>Nombre</span>
                </div>


            </th>
            <th>Edad</th>
            <th>Nombre</th>
            <th>Edad</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Persona 1</td>
            <td>25</td>
            <td>Persona 3</td>
            <td>30</td>
        </tr>
        <tr>
            <td>Persona 2</td>
            <td>35</td>
            <td>Persona 4</td>
            <td>40</td>
        </tr>
    </tbody>
</table>

<style>
    /* rotar el texto */
    th {
        height: auto;
    }
    th div.text-rotate span {
        writing-mode: vertical-rl;
        transform: rotate(-45deg);
        white-space: wrap;
    }
    th div{
        background-color: #f2f2f2;
    }
</style>

@endsection