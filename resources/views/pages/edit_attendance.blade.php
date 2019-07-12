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
                                                  <h4 class="c-grey-900 mB-20">Edit Attendance</h4>

                                                  <div class="mT-30">

                                                    @if (Session::has('flash_message'))
                                                        <div class="alert alert-success">
                                                            {{ Session::get('flash_message') }}
                                                        </div>
                                                    @endif


                                                      {{ csrf_field() }}
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label for="inputEmail4">Class</label>
                                                                <select class="form-control classes" name="sectionId">
                                                                  <option value="0" selected disabled>Select Class </option>

                                                                    @foreach($classes as $class)
                                                                     <option sectionId="{{ $class->sectionId }}" value="{{ $class->sectionId }}">  {{ $class->class }}-{{ $class->sec }} </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="inputEmail4">Subject</label>
                                                                <select class="form-control subjects" name="subjectId">
                                                                  <option value="0" selected disabled>Select Subject </option>
                                                                  @foreach($classes as $class)
                                                                   <option sectionId="{{ $class->sectionId }}"  class="subject"  value="{{ $class->subjectId }}">  {{ $class->name }} </option>
                                                                  @endforeach

                                                                </select>
                                                            </div>


                                                            <div class="form-group col-md-2" >
                                                                <button type="submit" class="btn btn-primary uploadButton getResults">Go</button>

                                                            </div>
                                                        </div>



                                                        <table class="table table-striped attendanceTable">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Topic</th>
                                                                    <th scope="col">Date</th>
                                                                    <th scope="col">Options</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="attendanceInfo">
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
                      // Hide Students table
                      $(".attendanceTable").hide();

                      function callAjax(sectionId, subjectId){

                        $.ajax({
                          method: "POST",
                          url: "/get_attendances",


                          data: { _token: '<?php echo csrf_token() ?>', sectionId: sectionId, subjectId: subjectId },

                          })
                          .done(function( data ) {
                            $(".attendanceTable").fadeIn("slow");
                            $(".attendanceInfo").html("");
                              x = 1;

                              $.each(data, function(i, item){

                                  $(".attendanceInfo").append('<tr><td>'+x+'</td><td>'+item.topic+'</td><td>'+item.date+'</td><td> <a href="/edit_attendance/'+item.id+'"> Edit </a> </td></tr>');
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


                      });



                      $(".subject[sectionid!="+sectionId+"]").hide();


                      $(".getResults").click(function(){
                          sectionId = $(".classes option:selected").attr('sectionId');
                          subjectId = $(".subjects option:selected").val();

                          callAjax(sectionId, subjectId);


                      });



                  });
            </script>
            @stop
        </div>
  </div>


@stop
