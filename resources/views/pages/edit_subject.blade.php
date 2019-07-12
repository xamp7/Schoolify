@extends('app')

@section('head_page')
    <style media="screen">
        .uploadButton {
            margin-top:30px;
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
                          <div id="root" class="row">
                                          <div class="col-md-12">
                                              <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                                  <h4 class="c-grey-900 mB-20">Edit Subject</h4>

                                                  <div class="mT-30">

                                                      @include('includes.alerts')



                                                    <form action="/edit_subject" method="post">
                                                      {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $subject->id }}">
                                                        <div class="form-row">

                                                          <div class="form-group col-md-2">
                                                              <label for="inputEmail4">Subject</label>
                                                              <input type="text" class="form-control" id="inputPassword4" placeholder="Subject" name="name" value="{{ $subject->name }}">
                                                              </select>
                                                          </div>

                                                            <div class="form-group col-md-2">
                                                              <label for="inputPassword4">Department</label>
                                                              <input type="text" class="form-control" id="inputPassword4" placeholder="Department" name="dep" value="{{ $subject->dep }}">
                                                            </div>



                                                            <div class="form-group col-md-2" >
                                                                <button type="submit" class="btn btn-primary uploadButton">Edit</button>

                                                            </div>
                                                        </div>



                                              </div>
                                          </div>
                                      </div>
                                    </form>
                                  </div>

                      </div>
                  </div>
              </div>
            @include('includes.footer_content')
            @section('footer_page')
            <script>
                  $(document).ready(function(){

                  });
            </script>
            @stop

        </div>
  </div>

@stop
