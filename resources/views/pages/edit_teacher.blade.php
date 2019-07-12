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
                                                  <h4 class="c-grey-900 mB-20">Edit Teacher</h4>

                                                  <div class="mT-30">

                                                      @include('includes.alerts')



                                                    <form action="/edit_teacher" method="post">
                                                      {{ csrf_field() }}

                                                      <input type="hidden" name="id" value="{{ $teacher->id }}">

                                                      <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-1 col-form-label">Name</label>
                                                        <div class="col-sm-5">
                                                          <input type="text" class="form-control" id="inputEmail3" placeholder="Name" name="name" value="{{ $teacher->name }}">
                                                          </div>
                                                        </div>

                                                        <div class="form-group row">
                                                          <label for="inputEmail3" class="col-sm-1 col-form-label">Email</label>
                                                          <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="inputEmail3" placeholder="Email" name="email" value="{{ $teacher->email }}">
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                          <label for="inputEmail3" class="col-sm-1 col-form-label">Password</label>
                                                          <div class="col-sm-5">
                                                            <input type="password" class="form-control" id="inputEmail3" placeholder="Password" name="password" >
                                                            </div>
                                                          </div>



                                                      <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-1 col-form-label">Phone</label>
                                                        <div class="col-sm-5">
                                                          <input type="text" class="form-control" id="inputEmail3" placeholder="Phone" name="phone" value="{{ $teacher->phone }}">
                                                          </div>
                                                        </div>


                                                        <div class="form-group row">
                                                          <div class="col-sm-1">Status</div>
                                                          <div class="col-sm-5">
                                                            <div class="form-check">
                                                              <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" name="status" {{ ($teacher->status) == 1 ? 'checked' : '' }}>
                                                                  Check to give admin status
                                                              </label>
                                                            </div>
                                                          </div>
                                                        </div>



                                                        <div class="form-group row">
                                                          <div class="col-sm-6">
                                                            <button type="submit" class="btn btn-primary btnAdd">Edit</button>
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
