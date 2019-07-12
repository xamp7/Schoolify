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



                                                    <form action="/update_evaluation" method="post">
                                                      {{ csrf_field() }}

                                                      <input type="hidden" name="sectionId" value="{{ $evaluations[0]->sectionId  }}">
                                                      <input type="hidden" name="subjectId" value="{{  $evaluations[0]->subjectId }}">
                                                      <input type="hidden" name="evaluationId" value="{{  $evaluation_id }}">



                                                        <div class="form-row">
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Class</label>
                                                                <select class="form-control classes" name="sectionId" disabled>

                                                                     <option value="{{ $evaluations[0]->sectionId  }}"   selected>  {{ $class }}-{{ $section }} </option>

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Subject</label>
                                                                <select class="form-control subjects" name="subjectId" disabled>
                                                                   <option value="{{ $evaluations[0]->subjectId  }}"   class="subject"  selected >  {{ $subject }} </option>

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                              <label for="inputPassword4">Title</label>
                                                              <input type="text" class="form-control" id="inputPassword4" placeholder="Title" value="{{ $evaluations[0]->name }}" name="title">
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                              <label for="inputPassword4">Total Marks</label>
                                                              <input type="text" class="form-control" id="inputPassword4" placeholder="Marks" name="totalMarks" value="{{ $evaluations[0]->totalMarks }}" >
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                              <label for="inputPassword4">Weightage</label>
                                                              <input type="text" class="form-control" id="inputPassword4" placeholder="Weightage" name="weightage" value="{{ $evaluations[0]->weightage }}">
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
                                                              @foreach($evaluations as $evaluation)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ \App\Student::find($evaluation->studentId)->name }}</td>
                                                                    <td>{{ \App\Student::find($evaluation->studentId)->fatherName }}</td>

                                                                    <td>
                                                                        <input type="hidden" name="studentId[]" value="{{ $evaluation->studentId }}" />
                                                                        <input type="text" class="form-control" placeHolder="Marks Obtained" name="obtainedMarks[]" value="{{ $evaluation->obtained }}"/>
                                                                    </td>

                                                                </tr>
                                                              @endforeach
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

            @stop
        </div>
  </div>


@stop
