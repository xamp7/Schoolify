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
                                                  <h4 class="c-grey-900 mB-20">Edit Announcement</h4>




                                                  <div class="mT-30">

                                                    @if (Session::has('flash_message'))
                                                        <div class="alert alert-success">
                                                            {{ Session::get('flash_message') }}
                                                        </div>
                                                    @endif

                                                    @if(empty($announcementId))
                                                      <table class="table table-striped">
                                                          <thead>
                                                              <tr>
                                                                  <th scope="col">#</th>
                                                                  <th scope="col">Title</th>
                                                                  <th scope="col">For</th>
                                                                  <th scope="col">Options</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                            @foreach($announcements as $announcement)
                                                                <tr>
                                                                  <th scope="th"> {{ $loop->iteration }} </th>
                                                                  <td>{{ $announcement->title }}</td>
                                                                  <td>
                                                                      @if( $announcement->classId == 0 && $announcement->sectionId == 0)
                                                                        Everyone
                                                                      @elseif( $announcement->classId != 0 && $announcement->sectionId == 0)
                                                                      Class  {{ \App\Classes::find($announcement->classId)->class }} - All Sections
                                                                      @elseif( $announcement->classId != 0 && $announcement->sectionId != 0)
                                                                      Class   {{ \App\Classes::find($announcement->classId)->class }} - Section  {{ \App\Section::find($announcement->sectionId)->sec }}
                                                                      @endif

                                                                  </td>
                                                                  <td> <a href="edit_announcement/{{ $announcement->id }}"> Edit </a> | <a class="delete" announcementId="{{ $announcement->id }}" href="delete_announcement/{{ $announcement->id }}"> Delete </a> </td>
                                                                </tr>

                                                            @endforeach
                                                          </tbody>
                                                      </table>
                                                    @else
                                                    <form>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Class</label>
                                                                <select class="form-control" name="">
                                                                    <option value="">Everyone</option>
                                                                    <option value="">2</option>
                                                                    <option value="">3</option>
                                                                    <option value="">4</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Section</label>
                                                                <select class="form-control" name="">
                                                                    <option value="">A</option>
                                                                    <option value="">B</option>
                                                                    <option value="">C</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="inputPassword4">Date</label>
                                                                <input type="date" class="form-control" id="inputPassword4" placeholder="Password">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                          <div class="form-group col-md-6">
                                                            <label for="inputPassword4">Title</label>
                                                            <input type="text" class="form-control" id="inputPassword4" placeholder="Title">
                                                          </div>




                                                        </div>
                                                        <div class="form-row">
                                                          <div class="form-group col-md-6" >
                                                              <label for="inputPassword4">Summary</label>

                                                              <textarea name="name" rows="8" cols="80" class="form-control"></textarea>
                                                          </div>

                                                        </div>

                                                        <div class="form-group col-md-2" >
                                                            <button type="submit" class="btn btn-primary">Edit</button>

                                                        </div>

                                                    </form>
                                                  @endif
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
                          announcementId = $(this).attr("announcementId");
                          $.confirm({
                                title: 'Delete Announcement',
                                content: 'You want to delete the annoucement ?',
                                type: 'red',
                                typeAnimated: true,
                                icon: 'fa fa-warning',

                                buttons: {
                                  Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-red',
                                            action: function(){
                                              window.location.href = "/delete_announcement/"+announcementId;

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
