@extends('app')

@section('head_page')
    <style media="screen">
        .uploadButton {
            margin-top:30px;
        }

        .floatRight {
            float:right;
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
                                                  <h4 class="c-grey-900 mB-20">Assign Teacher</h4>



                                                  <div class="mT-30">
                                                    @include('includes.alerts')

                                                    @if (Session::has('flash_message'))
                                                        <div class="alert alert-success">
                                                            {{ Session::get('flash_message') }}
                                                        </div>
                                                    @endif



                                                    <form action="assign_teacher" method="post">
                                                      {{ csrf_field() }}

                                                        <div class="form-row">
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Class</label>
                                                                <select class="form-control classes" name="classId">
                                                                  <option value="0" selected>Select Class </option>
                                                                      @foreach($classes as $class)
                                                                        <option classId="{{ $class->id }}">{{ $class->class }}</option>
                                                                     @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Section</label>
                                                                <select class="form-control sections" name="secId">
                                                                  <option value="0" selected>Select Section </option>
                                                                    @foreach($classes as $class)
                                                                      @foreach($class->sections as $section)
                                                                        <option class="section" classId="{{ $class->id }}" value="{{ $section->id }}"> {{ $section->sec }}  </option>
                                                                      @endforeach
                                                                     @endforeach
                                                                </select>
                                                            </div>



                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Subject</label>
                                                                <select class="form-control subjects" name="subjectId" >
                                                                    <option value="0" disabled selected>Select Subject</option>
                                                                    @foreach($assignedSubjects as $aS)
                                                                      @foreach($aS->subjectIds as $subject)
                                                                        <option class="subject" value="{{ $subject->subjectId }}" classId={{ $aS->classId }}> {{ \App\Subject::find($subject->subjectId)->name }}</option>
                                                                      @endforeach
                                                                     @endforeach
                                                                </select>
                                                            </div>


                                                              <div class="form-group col-md-2">
                                                                  <label for="inputEmail4">Teacher</label>
                                                                  <select class="form-control" name="teacherId">
                                                                      <option value="" disabled selected>Select Teacher</option>
                                                                      @foreach($faculty as $teacher)
                                                                        <option value="{{ $teacher->id }}">{{ $teacher->name}}</option>
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
                                                  <h4 class="c-grey-900 mB-20">Assigned Teachers

                                                    <!-- <div class="btn-group dropleft floatRight">
                                                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Display
                                                      </button>
                                                      <div class="dropdown-menu">
                                                        <a class="dteacherWise dropdown-item" href="#">Teacher Wise</a>
                                                        <a class="dclassWise dropdown-item" href="#">Class Wise</a>
                                                        </div>
                                                    </div> -->


                                                  </h4>
                                                  <!-- Example single danger button -->



                                                  <div class="mT-30">


                                                    <div class="teacherWise">
                                                      <div class="row">
                                                          <div class="col-4">
                                                              <div class="list-group" id="list-tab" role="tablist">
                                                              @foreach($assignedTeachers as $assign)
                                                              <a class="list-group-item list-group-item-action" id="list-{{ $assign->facultyId }}-list" data-toggle="list" href="#list-{{ $assign->facultyId }} " role="tab" aria-controls="home"> {{ \App\Faculty::find($assign->facultyId)->name }}</a>
                                                              @endforeach
                                                              </div>
                                                          </div>
                                                          <div class="col-8">
                                                              <div class="tab-content" id="nav-tabContent">
                                                              @foreach($assignedTeachers as $assign)
                                                              <div class="tab-pane fade " id="list-{{ $assign->facultyId }}" role="tabpanel" aria-labelledby="list-{{ $assign->facultyId }}-list">
                                                                <table class="table table-striped subjectsTable" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Subject</th>
                                                                            <th scope="col">Class</th>

                                                                            <th scope="col">Options</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="subjectsInfo">
                                                                        @foreach($assign->subjectIds as $subject)
                                                                            <tr>
                                                                                <td> {{ $loop->iteration }} </td>
                                                                                <td>   {{ \App\Subject::find($subject->subjectId)->name }} </td>
                                                                                <td> {{ $subject->classIds['class'] }}-{{ \App\Section::find($subject->sectionId)->sec }}  </td>
                                                                                <td> <a href="#" class="delete" sectionId="{{ $subject->sectionId }}" facultyId="{{ $assign->facultyId }}" subjectId="{{ $subject->subjectId }}">Delete</a>  </td>
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



                                                  <div class="classWise" style="display:none;" >
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
                                                                          <th scope="col">Teacher</th>
                                                                          <th scope="col">Options</th>
                                                                      </tr>
                                                                  </thead>
                                                                  <tbody class="subjectsInfo">
                                                                      @foreach($assign->subjectIds as $subject)
                                                                          <tr>
                                                                              <td> {{ $loop->iteration }} </td>
                                                                              <td>   {{ \App\Subject::find($subject->subjectId)->name }} </td>
                                                                              <!-- <td> <a href="#" class="delete" sectionId="" facultyId="{{ $assign->classId }}" subjectId="{{ $subject->subjectId }}">Delete</a>  </td> -->
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
                      </div>
            </main>

                  </div>
              </div>
            @include('includes.footer_content')
            @section('footer_page')
            <script>
                  $(document).ready(function(){

                    // Dropdowns
                    $(".dteacherWise").click(function(){
                        $(".classWise").hide();
                        $(".teacherWise").fadeIn("slow");
                    });


                    $(".dclassWise").click(function(){
                        $(".teacherWise").hide();
                        $(".classWise").fadeIn("slow");
                    });



                    $(".classes").change(function(){
                        $(".sections").val('0');
                        $(".subjects").val('0');

                        var option = $('option:selected', this).attr('classId');
                        classId = option;
                        $(".section[classId="+classId+"]").show();
                        $(".section[classId!="+classId+"]").hide();

                        $(".subject[classId="+classId+"]").show();
                        $(".subject[classId!="+classId+"]").hide();


                    });

                    $(".section").hide();
                    $(".subject").hide();



                    $('.delete').on('click',function(e){
                      e.preventDefault();
                          subjectId = $(this).attr("subjectId");
                          facultyId = $(this).attr("facultyId");
                          sectionId = $(this).attr("sectionId");

                          $.confirm({
                                title: 'Unassign Teacher',
                                content: 'You want to unassign the teacher ?',
                                type: 'red',
                                typeAnimated: true,
                                icon: 'fa fa-warning',
                                buttons: {
                                  Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-red',
                                            action: function(){
                                              window.location.href = "/assign_teacher/remove/"+subjectId+"/"+facultyId+"/"+sectionId;

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
