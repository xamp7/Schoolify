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
                                                  <h4 class="c-grey-900 mB-20">Manage subjects</h4>

                                                  <div class="mT-30">

                                                      @include('includes.alerts')


                                                      <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                                          <thead>
                                                                              <tr>
                                                                                  <th>#</th>
                                                                                  <th>Name</th>
                                                                                  <th>Department</th>
                                                                                  <th>Options</th>

                                                                              </tr>
                                                                          </thead>

                                                                          <tbody>

                                                                                @foreach($subjects as $subject)
                                                                                <tr>
                                                                                    <td> {{ $loop->iteration }} </td>
                                                                                    <td> {{ $subject->name }} </td>
                                                                                    <td> {{ $subject->dep }} </td>
                                                                                    <td> <a href="/manage_subject/edit/{{ $subject->id }}"> Edit </a> | <a href="/manage_subject/delete/{{ $subject->id }}" class="delete" subjectId="{{ $subject->id }}" > Delete </a>  </td>
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
                          subjectId = $(this).attr("subjectId");
                          $.confirm({
                                title: 'Delete Subject',
                                content: 'Do you want to delete the subject ?',
                                type: 'red',
                                typeAnimated: true,
                                icon: 'fa fa-warning',
                                buttons: {
                                  Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-red',
                                            action: function(){
                                              window.location.href = "/manage_subject/delete/"+subjectId;

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
