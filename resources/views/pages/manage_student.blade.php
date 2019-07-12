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
                                                  <h4 class="c-grey-900 mB-20">Manage Students</h4>

                                                  <div class="mT-30">

                                                      @include('includes.alerts')


                                                      <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                                          <thead>
                                                                              <tr>
                                                                                  <th>#</th>
                                                                                  <th>Name</th>
                                                                                  <th>Email</th>
                                                                                  <th>Options</th>

                                                                              </tr>
                                                                          </thead>

                                                                          <tbody>

                                                                                @foreach($students as $student)
                                                                                <tr>
                                                                                    <td> {{ $loop->iteration }} </td>
                                                                                    <td> {{ $student->name }} </td>
                                                                                    <td> {{ $student->email }} </td>
                                                                                    <td> <a href="/manage_student/edit/{{ $student->id }}"> Edit </a> | <a href="/manage_student/delete/{{ $student->id }}" class="delete" studentId="{{ $student->id }}" > Delete </a>  </td>
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
                          studentId = $(this).attr("studentId");
                          $.confirm({
                                title: 'Delete Student',
                                content: 'Do you want to delete the student ?',
                                type: 'red',
                                typeAnimated: true,
                                icon: 'fa fa-warning',

                                buttons: {
                                  Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-red',
                                            action: function(){
                                              window.location.href = "/manage_student/delete/"+studentId;

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
