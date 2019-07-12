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
                          <div class="row">
                                          <div class="col-md-12">
                                              <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                                  <h4 class="c-grey-900 mB-20">Assign Subject</h4>



                                                  <div class="mT-30">
                                                    @include('includes.alerts')

                                                    @if (Session::has('flash_message'))
                                                        <div class="alert alert-success">
                                                            {{ Session::get('flash_message') }}
                                                        </div>
                                                    @endif




                                                    <form action="assign_subject" method="post">
                                                      {{ csrf_field() }}

                                                        <div class="form-row">
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Class</label>
                                                                <select class="form-control" name="class">
                                                                  <option value="" disabled selected>Select Class</option>
                                                                  @foreach($classes as $class)
                                                                    <option value="{{ $class->class }}">{{ $class->class}}</option>
                                                                   @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Subject</label>
                                                                <select  class="form-control" name="subject"  >
                                                                    @foreach($subjects as $subject)
                                                                      <option value="{{ $subject->id }}">{{ $subject->name}}</option>
                                                                     @endforeach
                                                                </select>
                                                            </div>





                                                            <div class="form-group col-md-2" >
                                                                <button type="submit" class="btn btn-primary uploadButton">Assign</button>

                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>




                                              </div>
                                          </div>
                                      </div>
                      </div>

                      <div class="container-fluid">
                          <!-- <h4 class="c-grey-900 mT-10 mB-30">Attendance</h4> -->
                          <div class="row">
                                          <div class="col-md-12">
                                              <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                                  <h4 class="c-grey-900 mB-20">Assigned Subject</h4>

                                                  <div class="mT-30">


                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="list-group" id="list-tab" role="tablist">
                                                            @foreach($assignedSubjects as $assign)
                                                            <a class="list-group-item list-group-item-action" id="list-{{ $assign->classId }}-list" data-toggle="list" href="#list-{{ $assign->classId }} " role="tab" aria-controls="home">Class {{ \App\Classes::find($assign->classId)->class }}</a>
                                                            @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="tab-content" id="nav-tabContent">
                                                            @foreach($assignedSubjects as $assign)
                                                            <div class="tab-pane fade " id="list-{{ $assign->classId }}" role="tabpanel" aria-labelledby="list-{{ $assign->classId }}-list">
                                                              <table class="table table-striped subjectsTable" >
                                                                  <thead>
                                                                      <tr>
                                                                          <th scope="col">#</th>
                                                                          <th scope="col">Subject</th>
                                                                          <th scope="col">Options</th>
                                                                      </tr>
                                                                  </thead>
                                                                  <tbody class="subjectsInfo">
                                                                      @foreach($assign->subjectIds as $subject)
                                                                          <tr>
                                                                              <td> {{ $loop->iteration }} </td>
                                                                              <td>   {{ \App\Subject::find($subject->subjectId)->name }} </td>
                                                                              <td> <a href="#" class="delete" classId="{{ $assign->classId }}" subjectId="{{ $subject->subjectId }}">Delete</a>  </td>
                                                                          </tr>

                                                                      @endforeach
                                                                  </tbody>
                                                              </table>
                                                            </div>
                                                            @endforeach
                                                            </div>
                                                        </div>
                                                        </div>


                                                </div>




                                              </div>
                                          </div>
                                      </div>
                      </div>
            </main>

                  </div>
              </div>
            @include('includes.footer_content')
            @section('footer_page')
            <script>
                  $(document).ready(function(){

                    $('.delete').on('click',function(e){
                      e.preventDefault();
                          subjectId = $(this).attr("subjectId");
                          classId = $(this).attr("classId");
                          $.confirm({
                                title: 'Unassign Subject',
                                content: 'You want to unassign the subject ?',
                                type: 'red',
                                typeAnimated: true,
                                icon: 'fa fa-warning',
                                buttons: {
                                  Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-red',
                                            action: function(){
                                              window.location.href = "/assign_subject/remove/"+subjectId+"/"+classId;

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

            <script type="text/javascript">
              $(document).ready(function(){
                $('.multipleSelect').fastselect();

              });

            </script>

            @stop



        </div>
  </div>


@stop
