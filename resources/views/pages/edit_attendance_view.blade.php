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
                                                  <h4 class="c-grey-900 mB-20">Add Attendance</h4>

                                                  <div class="mT-30">

                                                    @if (Session::has('flash_message'))
                                                        <div class="alert alert-success">
                                                            {{ Session::get('flash_message') }}
                                                        </div>
                                                    @endif

                                                    @include('includes.alerts')


                                                    <form action="/update_attendance" method="post">
                                                      {{ csrf_field() }}

                                                        <div class="form-row">
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Class</label>

                                                                <input type="hidden" name="sectionId" value="{{ $attendances[0]->sectionId  }}">
                                                                <input type="hidden" name="date" value="{{ \Carbon\Carbon::parse($attendances[0]->date)->format('Y-m-d') }}">
                                                                <input type="hidden" name="subjectId" value="{{ $attendances[0]->subjectId }}">

                                                                <select class="form-control classes" name="sectionId" disabled>

                                                                     <option value="{{ $attendances[0]->sectionId  }}" selected>  {{ $class }} - {{ $section }} </option>

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Subject</label>
                                                                <select class="form-control subjects" name="subjectId" disabled>
                                                                   <option  class="subject"  value="{{ $attendances[0]->subjectId }}" selected>  {{ $subject }} </option>

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                              <label for="inputPassword4">Topic</label>
                                                              <input type="text" class="form-control" id="inputPassword4" placeholder="Topic" name="topic" value="{{ $attendances[0]->topic }}">
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="inputPassword4">Date</label>

                                                                <input type="date" class="form-control" id="inputPassword4" name="date" selected disabled value="{{ \Carbon\Carbon::parse($attendances[0]->date)->format('Y-m-d') }}" >
                                                            </div>

                                                            <div class="form-group col-md-2" >
                                                                <button type="submit" class="btn btn-primary uploadButton">Update</button>

                                                            </div>
                                                        </div>



                                                  <table class="table table-striped studentsTable">
                                                      <thead>
                                                          <tr>
                                                              <th scope="col">#</th>
                                                              <th scope="col">Student Name</th>
                                                              <th scope="col">Parent Name</th>
                                                              <th scope="col">Attendance</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody class="studentsInfo">
                                                        @foreach($attendances as $attendance)
                                                          <tr>
                                                            <td>{{ $loop->iteration }}</td>

                                                            <td>{{ \App\Student::find($attendance->studentId)->name }}</td>
                                                            <td>{{ \App\Student::find($attendance->studentId)->fatherName }}</td>
                                                            <td>
                                                                <input type="hidden" name="studentId[]" value="{{ $attendance->studentId   }}" />
                                                                <input type="checkbox" name="status[]" {{ (($attendance->status == 1 ? 'checked' : '')) }}>
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
