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
                                                  <h4 class="c-grey-900 mB-20">Add Evaluation</h4>

                                                  <div class="mT-30">

                                                    @if (Session::has('flash_message'))
                                                        <div class="alert alert-success">
                                                            {{ Session::get('flash_message') }}
                                                        </div>
                                                    @endif

                                                    @include('includes.alerts')


                                                    <form action="/submit_evaluation" method="post">
                                                      {{ csrf_field() }}
                                                        <div class="form-row">
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Class</label>
                                                                <select class="form-control classes" name="sectionId">
                                                                  <option value="0" selected disabled>Select Class </option>

                                                                    @foreach($classes as $class)
                                                                     <option sectionId="{{ $class->sectionId }}" value="{{ $class->sectionId }}">  {{ $class->class }}-{{ $class->sec }} </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Subject</label>
                                                                <select class="form-control subjects" name="subjectId">
                                                                  <option value="0" selected disabled>Select Subject </option>
                                                                  @foreach($classes as $class)
                                                                   <option sectionId="{{ $class->sectionId }}"  class="subject"  value="{{ $class->subjectId }}">  {{ $class->name }} </option>
                                                                  @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                              <label for="inputPassword4">Title</label>
                                                              <input type="text" class="form-control" id="inputPassword4" placeholder="Title" name="title">
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                              <label for="inputPassword4">Total Marks</label>
                                                              <input type="text" class="form-control" id="inputPassword4" placeholder="Marks" name="totalMarks">
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                              <label for="inputPassword4">Weightage</label>
                                                              <input type="text" class="form-control" id="inputPassword4" placeholder="Weightage" name="weightage">
                                                            </div>
                                                            <!-- <div class="form-group col-md-2">
                                                                <label for="inputPassword4">Date</label>
                                                                <input type="date" class="form-control" id="inputPassword4" placeholder="Password" name="date">
                                                            </div> -->

                                                            <div class="form-group col-md-2" >
                                                                <button type="submit" class="btn btn-primary uploadButton">Upload</button>

                                                            </div>
                                                        </div>




                                                        <table class="table table-striped studentsTable">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Student Name</th>
                                                                    <th scope="col">Parent Name</th>
                                                                    <th scope="col">Marks Obtained</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="studentsInfo">
                                                            </tbody>
                                                        </table>
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
                      // Hide Students table
                      $(".studentsTable").hide();

                      function callAjax(sectionId){

                        $.ajax({
                          method: "POST",
                          url: "/get_students",


                          data: { _token: '<?php echo csrf_token() ?>', sectionId: sectionId },

                          })
                          .done(function( data ) {
                            $(".studentsTable").fadeIn("slow");
                            $(".studentsInfo").html("");
                              x = 1;
                              $.each(data, function(i, item){

                                  $(".studentsInfo").append('<tr><td>'+x+'</td><td>'+item.name+'</td><td>'+item.fatherName+'</td><td> <input type="hidden" name="studentId[]" value="'+item.id+'" /><input type="text" class="form-control" placeHolder="Marks Obtained" name="obtainedMarks[]" /></td></tr>');
                                  x++;
                              });
                          });

                      }

                      sectionId = $(".classes option:selected").attr('sectionId');

                      $(".classes").change(function(){

                          var option = $('option:selected', this).attr('sectionId');
                          sectionId = option;
                          $(".subject[sectionid="+sectionId+"]").show();
                          $(".subject[sectionid!="+sectionId+"]").hide();

                          callAjax(sectionId);

                      });

                      $(".subject[sectionid!="+sectionId+"]").hide();

                  });
            </script>
            @stop
        </div>
  </div>


@stop
