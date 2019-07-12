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
                                                  <h4 class="c-grey-900 mB-20">Manage Class</h4>

                                                  <div class="mT-30">

                                                      @include('includes.alerts')


                                                      <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                                          <thead>
                                                                              <tr>
                                                                                  <th>#</th>
                                                                                  <th>Class</th>
                                                                                  <th>Total Strength</th>
                                                                                  <th>Options</th>

                                                                              </tr>
                                                                          </thead>

                                                                          <tbody>

                                                                                @foreach($classes as $class)
                                                                                <tr>
                                                                                    <td> {{ $loop->iteration }} </td>
                                                                                    <td> {{ $class->class }} </td>
                                                                                    <td> {{ $class->totalStrength }} </td>
                                                                                    <td> <a href="/manage_class/edit/{{ $class->id }}"> Edit </a> | <a href="/manage_class/delete/{{ $class->id }}" class="delete" classId="{{ $class->id }}" > Delete </a>  </td>
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
              </div>
            @include('includes.footer_content')
            @section('footer_page')
            <script>
                  $(document).ready(function(){

                    $('.delete').on('click',function(e){
                      e.preventDefault();
                          classId = $(this).attr("classId");
                          $.confirm({
                                title: 'Delete Class',
                                content: 'You want to delete the class ?',
                                type: 'red',
                                typeAnimated: true,
                                icon: 'fa fa-warning',

                                buttons: {
                                  Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-red',
                                            action: function(){
                                              window.location.href = "/manage_class/delete/"+classId;

                                            }
                                        },

                                    cancel: function () {
                                        //
                                    },

                                }
                            });

                    });


                  });
            </script>
            @stop

        </div>
  </div>

@stop
