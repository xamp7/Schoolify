@extends('app')

@section('head_page')
    <style media="screen">
        .uploadButton {
            margin-top:30px;
        }

        .btnAdd {
          width:100%;
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
                                                  <h4 class="c-grey-900 mB-20">New Student</h4>

                                                  <div class="mT-30">

                                                      @include('includes.alerts')



                                                    <form action="/add_student" method="post">
                                                      {{ csrf_field() }}

                                                      <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-1 col-form-label">Name</label>
                                                        <div class="col-sm-5">
                                                          <input type="text" class="form-control" id="inputEmail3" placeholder="Name" name="name">
                                                          </div>



                                                        </div>

                                                        <div class="form-group row">
                                                          <label for="inputEmail3" class="col-sm-1 col-form-label">Father Name</label>
                                                          <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="inputEmail3" placeholder="Father Name" name="fatherName">
                                                            </div>
                                                          </div>


                                                          <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-1 col-form-label">Class</label>
                                                            <div class="col-sm-2">
                                                              <select class="form-control classes" name="classId">
                                                                <option value="0" selected>Select Class </option>
                                                                    @foreach($classes as $class)
                                                                      <option classId="{{ $class->id }}">{{ $class->class }}</option>
                                                                   @endforeach
                                                              </select>
                                                             </div>
                                                              <div class="col-sm-3">
                                                                <select class="form-control sections" name="secId">
                                                                  <option value="0" selected>Select Section </option>
                                                                    @foreach($classes as $class)
                                                                      @foreach($class->sections as $section)
                                                                        <option class="section" classId="{{ $class->id }}" value="{{ $section->id }}"> {{ $section->sec }}  </option>
                                                                      @endforeach
                                                                     @endforeach
                                                                </select>
                                                              </div>



                                                            </div>

                                                        <div class="form-group row">
                                                          <label for="inputEmail3" class="col-sm-1 col-form-label">Email</label>
                                                          <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="inputEmail3" placeholder="Email" name="email">
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                          <label for="inputEmail3" class="col-sm-1 col-form-label">Password</label>
                                                          <div class="col-sm-5">
                                                            <input type="password" class="form-control" id="inputEmail3" placeholder="Password" name="password">
                                                            </div>



                                                          </div>



                                                      <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-1 col-form-label">Phone</label>
                                                        <div class="col-sm-5">
                                                          <input type="text" class="form-control" id="inputEmail3" placeholder="Phone" name="phone">
                                                          </div>
                                                        </div>

                                                        <div class="form-group row">
                                                          <label for="inputEmail3" class="col-sm-1 col-form-label">Address</label>
                                                          <div class="col-sm-5">
                                                            <textarea type="text" class="form-control" id="inputEmail3"  name="address"></textarea>
                                                            </div>
                                                          </div>

                                                          <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-1 col-form-label">Join</label>
                                                            <div class="col-sm-5">
                                                              <input type="date" class="form-control" id="inputEmail3" name="joined">
                                                              </div>
                                                            </div>


                                                

                                                        <div class="form-group row">
                                                          <div class="col-sm-6">
                                                            <button type="submit" class="btn btn-primary btnAdd">Add</button>
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

                    $(".classes").change(function(){
                        $(".sections").val('0');


                        var option = $('option:selected', this).attr('classId');
                        classId = option;
                        $(".section[classId="+classId+"]").show();
                        $(".section[classId!="+classId+"]").hide();


                    });

                    $(".section").hide();
                  });
            </script>
            @stop

        </div>
  </div>

@stop
