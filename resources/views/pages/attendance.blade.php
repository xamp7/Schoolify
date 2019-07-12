@extends('app')

@section('head_page')
    <style media="screen">
        .uploadButton {
            margin-top:30px;
        }

        #chart {
           padding: 20px;
           color: black !important;
           text-align: center;
           width: 50%;
           margin: 0 auto;
           }
           @media(max-width: 480px){
           #chart {
           padding: 20px;
           color: black !important;
           text-align: center;
           width: 100%;
           margin: 0 auto;
           font-size: 10px;
           }
           }
           .barTable {
           width: 100%;
           height: 400px;
           }
           .charttitle {
           text-align: center;
           font-size: 10px;
           color:#FFF;
           }
           .bars td {
           vertical-align: bottom;
           }
           .bars div:hover {
           opacity: 0.6;
           }
           .legend {
           vertical-align: bottom;
           padding-left: 20px;
           text-align: left;
           }
           .legbox {
           display: block;
           clear: both;
           }
           .xaxisname {
           margin: 5px;
           color: #fff;
           font-size: 77%;
           padding: 5px;
           float: left;
           }
           /*Flat UI colors*/
           .one {
           background: #16A085;
           }
           .two {
           background: #2ECC71;
           }
           .three {
           background: #27AE60;
           }
           .four {
           background: #3498DB;
           }
           .five {
           background: #2980B9;
           }
           .six {
           background: #9B59B6;
           }
    </style>
@stop


@section('content')

  @include('includes.spinner')

  <div>
    @include('includes.sidebar')

    <div class="page-container">
            @include('includes.topnav')



              <main class="main-content bgc-grey-100">
                  <div id="mainContent">
                      <div class="container-fluid">
                          <!-- <h4 class="c-grey-900 mT-10 mB-30">Attendance</h4> -->
                          <div class="row">
                                          <div class="col-md-12">
                                              <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                                  <h4 class="c-grey-900 mB-20">Attendance</h4>

                                                  <div class="mT-30">
                                                    <div id="chart"></div>

                                                </div>
                                                <script type="text/javascript">
                                                     var chartjson = {
                                                       "title": "Attendence",
                                                       "data": [
                                                       @foreach($subjects as $subject)
                                                          {
                                                          "name": "{{$subject->name}}",
                                                          "score": {{$subject->score}}
                                                        },
                                                       @endforeach
                                                       ],
                                                       "xtitle": "Attendence",
                                                       "ytitle": "Marks",
                                                       "ymax": 100,
                                                       "ykey": 'score',
                                                       "xkey": "name",
                                                       "prefix": "%"
                                                     }

                                                     //chart colors
                                                     var colors = ['one', 'two', 'three', 'four','five','six'];

                                                     //constants
                                                     var TROW = 'tr',
                                                       TDATA = 'td';

                                                     var chart = document.createElement('div');
                                                     //create the chart canvas
                                                     var barchart = document.createElement('table');
                                                     barchart.className = "barTable";

                                                     //create the title row
                                                     var titlerow = document.createElement(TROW);
                                                     //create the title data
                                                     var titledata = document.createElement(TDATA);
                                                     //make the colspan to number of records
                                                     titledata.setAttribute('colspan', chartjson.data.length + 1);
                                                     titledata.setAttribute('class', 'charttitle');
                                                     titledata.innerText = chartjson.title;
                                                     titlerow.appendChild(titledata);
                                                     barchart.appendChild(titlerow);
                                                     chart.appendChild(barchart);

                                                     //create the bar row
                                                     var barrow = document.createElement(TROW);

                                                     //lets add data to the chart
                                                     for (var i = 0; i < chartjson.data.length; i++) {
                                                       barrow.setAttribute('class', 'bars');
                                                       var prefix = chartjson.prefix || '';
                                                       //create the bar data
                                                       var bardata = document.createElement(TDATA);
                                                       var bar = document.createElement('div');
                                                       bar.setAttribute('class', colors[i]);
                                                       bar.style.height = chartjson.data[i][chartjson.ykey] + prefix;
                                                       bardata.innerText = chartjson.data[i][chartjson.ykey] + prefix;
                                                       bardata.appendChild(bar);
                                                       barrow.appendChild(bardata);
                                                     }

                                                     //create legends
                                                     var legendrow = document.createElement(TROW);
                                                     var legend = document.createElement(TDATA);
                                                     legend.setAttribute('class', 'legend');
                                                     legend.setAttribute('colspan', chartjson.data.length);

                                                     //add legend data
                                                     for (var i = 0; i < chartjson.data.length; i++) {
                                                       var legbox = document.createElement('span');
                                                       legbox.setAttribute('class', 'legbox');
                                                       var barname = document.createElement('span');
                                                       barname.setAttribute('class', colors[i] + ' xaxisname');
                                                       var bartext = document.createElement('span');
                                                       bartext.innerText = chartjson.data[i][chartjson.xkey];
                                                       legbox.appendChild(barname);
                                                       legbox.appendChild(bartext);
                                                       legend.appendChild(legbox);
                                                     }
                                                     barrow.appendChild(legend);
                                                     barchart.appendChild(barrow);
                                                     barchart.appendChild(legendrow);
                                                     chart.appendChild(barchart);
                                                     document.getElementById('chart').innerHTML = chart.outerHTML;
                                                  </script>

                                                  <table class="table table-striped">
                                                      <thead>
                                                          <tr>
                                                              <th scope="col">#</th>
                                                              <th scope="col">Subject</th>
                                                              <th scope="col">Presents</th>
                                                              <th scope="col">Absents</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>



                                                        @foreach($subjects as $subject)
                                                          <tr>
                                                              <th scope="row">{{ $loop->iteration }}</th>
                                                              <td>{{ $subject->name }}</td>
                                                              <td>{{ $subject->present }}</td>
                                                              <td>{{ $subject->absent }}</td>
                                                          </tr>

                                                          @endforeach


                                                      </tbody>
                                                  </table>
                                              </div>
                                          </div>
                                      </div>
                      </div>
                  </div>
              </div>
            @include('includes.footer_content')
        </div>
  </div>


@stop
