@extends('app')

@section('head_page')
    <style media="screen">
        .uploadButton {
            margin-top:30px;
        }

        .sectionsTable {
          display:none;
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
                                                  <h4 class="c-grey-900 mB-20">Manage Section</h4>

                                                  <div class="mT-30">

                                                      @include('includes.alerts')

                                                      <div class="form-row">
                                                          <div class="form-group col-md-2">
                                                              <label for="inputEmail4">Class</label>
                                                              <select class="form-control classes" name="classId">
                                                                <option value="0" selected disabled>Select Class </option>

                                                                  @foreach($classes as $class)
                                                                   <option classId="{{ $class->id }}" value="{{ $class->id }}">  {{ $class->class }} </option>
                                                                  @endforeach

                                                              </select>
                                                          </div>


                                                          <div class="form-group col-md-2" >
                                                              <button type="submit" class="btn btn-primary uploadButton sectionSearch">Search</button>
                                                          </div>
                                                      </div>


                                                      <table class="table table-striped sectionsTable">
                                                          <thead>
                                                              <tr>
                                                                  <th scope="col">#</th>
                                                                  <th scope="col">Sections</th>
                                                                  <th scope="col">Options</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody class="sectionsInfo">
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
                    $('.sectionSearch').click(function(){
                        var classId = $(".classes option:selected").val();
                        $.ajax({
                          method: 'post',
                          data: { _token: "<?php echo csrf_token() ?>", classId: classId },
                          url: '/get_sections',
                          })
                          .done(function( data ) {
                            x = 1;
                            $.each(data, function(i, item){
                              $(".sectionsInfo").append('<tr><td>'+x+'</td><td>'+item.sec+'</td><td><a id="edit" sectionId="'+item.id+'" href="/manage_section/edit/'+item.id+'" sectionName="'+item.sec+'"> Edit </a> | <a href="/manage_section/delete/'+item.id+'" id="delete" sectionId="'+item.id+'" > Delete </a> </td></tr>');
                                x++;
                            });
                            $(".sectionsTable").fadeIn("slow");
                              // console.log(data);
                          });
                    });


                    $(document).on('click', '#edit', function(e){
                        e.preventDefault();
                          sectionId = $(this).attr("sectionId");
                          sectionName = $(this).attr("sectionName");
                          $.confirm({
                                title: 'Edit Section',
                                content: '<br /> <form id="editSectionForm" action="/edit_section" method="post">{{ csrf_field() }} <input type="hidden" name="secId" value="'+sectionId+'">   <div class="form-group col-md-12"><label for="inputPassword4">Section</label><input type="text" class="form-control" id="inputPassword4" name="sec" value="'+sectionName+'" ></div></form>',
                                type: 'blue',
                                typeAnimated: true,
                                icon: 'fa fa-edit',

                                buttons: {
                                  Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-blue',
                                            action: function(){
                                                $("#editSectionForm").submit();
                                            }
                                        },

                                    cancel: function () {
                                        //
                                    },

                                }
                            });

                    });




                    $(document).on('click', '#delete', function(e){
                      e.preventDefault();
                          sectionId = $(this).attr("sectionId");
                          $.confirm({
                                title: 'Delete Section',
                                content: 'You want to delete the section ?',
                                type: 'red',
                                typeAnimated: true,
                                icon: 'fa fa-warning',

                                buttons: {
                                  Confirm: {
                                            text: 'Confirm',
                                            btnClass: 'btn-red',
                                            action: function(){
                                              window.location.href = "/manage_section/delete/"+sectionId;

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
