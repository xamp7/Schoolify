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
                                            <h4 class="c-grey-900 mB-20">Settings</h4>

                                            <div class="mT-30">
                                              @if (Session::has('flash_message'))
                                                  <div class="alert alert-success">
                                                      {{ Session::get('flash_message') }}
                                                  </div>
                                              @endif


                                              <form class="" action="/changeSettings" method="post">
                                                {{ csrf_field() }}

                                                <div class="form-row">
                                                  <div class="form-group col-md-4">
                                                    <label for="inputPassword4">Current Password</label>
                                                    <input type="password" class="form-control" id="inputPassword4" placeholder="Current Password" name="cPassword">
                                                  </div>
                                                </div>
                                                <div class="form-row">
                                                  <div class="form-group col-md-4">
                                                    <label for="inputPassword4">New Password</label>
                                                    <input type="password" class="form-control" id="inputPassword4" placeholder="New Password" name="nPassword">
                                                  </div>
                                                </div>
                                                <div class="form-row">
                                                  <div class="form-group col-md-4">
                                                    <label for="inputPassword4">Re-Enter New Password</label>
                                                    <input type="password" class="form-control" id="inputPassword4" placeholder="Re-Enter New Password" name="nRPassword">
                                                  </div>
                                                </div>
                                                <div class="form-row">
                                                  <div class="form-group col-md-2" >
                                                      <button type="submit" class="btn btn-primary uploadButton">Update</button>
                                                    </div>
                                                </div>


                                              </form>

                                            </div>


                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
            </main>
            @include('includes.footer_content')
        </div>
  </div>


@stop
