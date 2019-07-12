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
                                                  <h4 class="c-grey-900 mB-20">Feedback</h4>

                                                  @foreach($feedback as $fb)
                                                  <div class="email-content-wrapper" style="border-left:3px solid #3498db;">
                                                      <div class="peers ai-c jc-sb pX-40 pY-30">
                                                          <div class="peers peer-greed">
                                                              <div class="peer mR-20">
                                                                <!-- <img class="bdrs-50p w-3r h-3r" alt="" src="https://randomuser.me/api/portraits/men/11.jpg"> -->
                                                                <i class="fa fa-envelope fa-3x" style=""></i>
                                                              </div>
                                                              <div class="peer"><small> {{ \Carbon\Carbon::parse($fb->created_at)->format("d-m-Y")  }}</small>
                                                                  <h5 class="c-grey-900 mB-5">{{ $fb->name }}</h5><span></span></div>
                                                          </div>
                                                          <!-- <div class="peer"><a href="" class="btn btn-danger bdrs-50p p-15 lh-0"><i class="fa fa-trash"></i></a></div> -->
                                                      </div>
                                                      <div class=" pX-40 pY-30">
                                                          <h4>{{ $fb->title }}</h4>
                                                          <p>
                                                              {{ $fb->feedback }}
                                                          </p>
                                                     </div>
                                                  </div>
                                                  <br />
                                                  @endforeach

                                                  <div class="text-center">
                                                    <br />
                                                    
                                                    {{ $feedback->links() }}
                                                  </div>

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
