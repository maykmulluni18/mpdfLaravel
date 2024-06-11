<table class="HeaderTitles">
  <tbody>
    <tr>
      <th class="headerLogo">
        <div class="contenedor">
          <img src="{{ $imgLogo }}" alt="Logo" style="max-width:200px; max-height: 100px;" class="superpuesta">
        </div>
      </th>
      <th class="headerTitle">
        <div class="title">
          <p class="title_1">
            UNIVERSIDAD NACIONAL DEL ALTIPLANO - PUNO
          </p>
          <p class="title_2">ESCUELA DE POSGRADO</p>
          <p class="title_3">
            COORDINACIÓN ACADEMICA
          </p>
          <table class="actasHeader">
            <tbody>
              <tr>
                <th class="actasHeadeCode1">
                  <p class="box_item paginate"></p>
                </th>
                <th class="actasHeaderTotle">
                  <p class="title_4">ACTA DE EVALUACION</p>
                </th>
                <th class="actasHeadeCode2">
                  <p class="box_item paginate">CODIGO: {PAGENO}</p>
                </th>
              </tr>
            </tbody>
          </table>
        </div>
      </th>
      <th class="headerLogo">
        <div class="contenedor">
          <img src="{{ $imgLogo }}" alt="Logo" style="max-width:200px; max-height: 100px;" class="superpuesta">
        </div>
      </th>
    </tr>
  </tbody>
</table>


<div>
  <div class="head">
    <table class="headerDetaillsCourse">

      <tr>
        <th class="leftHeader" colspan="2">

          <table class="head_conten">
            <tbody>
              <tr>
                <td>
                  <div class="head_left">

                    <p class="head_1">FACULTAD: </p>
                  </div>
                </td>
                <td>
                  <div class="head_left">

                    <p class="head_2"> {{ $faculity['academicalProgram'] }} </p>
                  </div>

                </td>
              </tr>
            </tbody>
          </table>

        </th>
        <th class="rightHeader">
          <table class="head_conten">
            <tbody>
              <tr>
                <td>
                  <div class="head_right">

                    <p class="head_1">MODALIDAD: </p>
                  </div>

                </td>
                <td>
                  <div class="head_right">

                    <p class="head_2">MODALID</p>
                  </div>

                </td>
              </tr>
            </tbody>
          </table>
        </th>
      </tr>
      <tr>
        <th class="leftHeader" colspan="2">
          <table class="head_conten">
            <tbody>
              <tr>
                <td>
                  <div class="head_left">
                    <p class="head_1">PROGRAMA:</p>
                  </div>
                </td>
                <td>
                  <div class="head_left">
                    <p class="head_2">{{ $faculity['faculty'] }}</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

        </th>
        <th class="rightHeader">
          <table class="head_conten">
            <tbody>
              <tr>
                <td>
                  <div class="head_right">
                    <p class="head_1">CREDITOS:</p>
                  </div>
                </td>
                <td>
                  <div class="head_right">
                    <p class="head_2">{{$dataCourese['courseCredits']}}</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </th>
      </tr>
      <tr>
        <th class="leftHeader" colspan="2">
          <table class="head_conten">
            <tbody>
              <tr>
                <td>
                  <div class="head_left">
                    <p class="head_1">MENCION:</p>
                  </div>
                </td>
                <td>
                  <div class="head_left">
                    <p class="head_2">asddddddddddddddddd asd sd wa adasdasasda as dasad ad adaa a adada dwqrf fdfsf sad adas dsaddas asdsa asfwadas as sa aasd adasda</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </th>
        <th class="rightHeader">
          <table class="head_conten">
            <tbody>
              <tr>
                <td>
                  <div class="head_right">
                    <p class="head_1">SEMESTRE:</p>
                  </div>
                </td>
                <td>
                  <div class="head_right">
                    <p class="head_2">{{$dataCourese['courseCycle']}}</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </th>
      </tr>
      <tr>
        <th class="leftHeader" colspan="2">
          <table class="head_conten">
            <tbody>
              <tr>
                <td>

                  <div class="head_left">
                    <p class="head_1">CURSO:</p>
                  </div>
                </td>
                <td>
                  <div class="head_riht">
                    <p class="head_2">{{$dataCourese['courseName']}}</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>


        </th>
        <th class="rightHeader">
          <table class="head_conten">
            <tbody>
              <tr>
                <td>
                  <div class="head_right">
                    <p class="head_1">AÑO ACADEMICO:</p>
                  </div>
                </td>
                <td>
                  <div class="head_right">
                    <p class="head_2">{{$dataCourese['academicalYear']}}</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>


        </th>
      </tr>
      <tr>
        <th class="leftHeader" colspan="2">
          <table class="head_conten">
            <tbody>
              <tr>
                <td>

                  <div class="head_left">
                    <p class="head_1">DOCENTE:</p>
                  </div>
                </td>
                <td>
                  <div class="head_riht">
                    <p class="head_2">{{$dataCourese['professorSurname']}} {{$dataCourese['professorSurnameM']}}, {{$dataCourese['professorName']}}</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>


        </th>
        <th class="rightHeader">
          <table class="head_conten">
            <tbody>
              <tr>
                <td>
                  <div class="head_right">
                    <p class="head_1">GRUPO:</p>
                  </div>
                </td>
                <td>
                  <div class="head_right">
                    <p class="head_2">{{$dataCourese['group']}}</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>


        </th>
      </tr>
    </table>
  </div>
</div>

