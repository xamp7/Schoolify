@extends('app')

@section('head_page')
    <style media="screen">
        .uploadButton {
            margin-top:30px;
        }
    </style>

    <link href="/assets/css/froala_editor.min.css" rel="stylesheet">
    <link href="/assets/css/froala_editor.pkgd.min.css" rel="stylesheet">


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

                                                    @include('includes.alerts')


                                                    <form action="/update_announcement" method="post" enctype="multipart/form-data">
                                                      {{ csrf_field() }}
                                                      <input type="hidden" name="announcementId" value="{{ $announcement->id }}">
                                                      <div class="form-row">
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Class</label>
                                                                <select class="form-control classes" name="classId" disabled >
                                                                     <option sectionId="" value="{{ $announcement->classId }}" selected >  {{ ($announcement->classId != 0 ? \App\Classes::find($announcement->classId)->class : "All Classes") }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="inputEmail4">Section</label>
                                                                <select class="form-control sections" name="sectionId" disabled>
                                                                     <option   value="{{ $announcement->sectionId }}" selected > {{ ($announcement->sectionId != 0 ? \App\Section::find($announcement->sectionId)->sec : "All Sections") }} </option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-6">
                                                              <label for="inputPassword4">Title</label>
                                                              <input type="text" class="form-control" id="inputPassword4" name="title" placeholder="Title" value="{{ $announcement->title }}">
                                                            </div>


                                                        </div>



                                                        <div class="form-row">
                                                          <div class="form-group col-md-10" >
                                                              <label for="inputPassword4">Summary</label>

                                                              <textarea id="froala-editor" name="summary" rows="20" cols="80" class="form-control"> {!! $announcement->summary !!} </textarea>
                                                          </div>

                                                        </div>

                                                        <div class="form-row">
                                                          <br />
                                                          <div class="form-group col-md-10" >
                                                              <label for="inputPassword4">Attachments</label> <br />
                                                              <input type="checkbox" class="addAttachment" name="editAttachment" value="1" checked> Use same attachments


                                                            <div class="existingAttachment">
                                                              <br />                                                               @foreach($announcement->attachment as $attachment)
                                                                <a href="/uploads/attachments/{{ $attachment }}" target="_blank">{{ $attachment }}</a> <br />
                                                              @endforeach
                                                            </div>

                                                            </div>


                                                            <div class="showAttachment form-group col-md-10" style="display:none;" >
                                                                <input type="file" name="attachments[]"  class="form-control" multiple />
                                                            </div>

                                                        </div>


                                                        <div class="form-group col-md-2" >
                                                          <br />
                                                            <button type="submit" class="btn btn-primary">Edit</button>

                                                        </div>

                                                    </form>
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

                    $(".addAttachment").click(function(){
                        if( $(this).prop('checked')) {
                           $(".showAttachment").hide();
                           $(".existingAttachment").fadeIn("slow");

                        }
                        else {
                          $(".existingAttachment").hide();

                          $(".showAttachment").fadeIn("slow");
                        }
                    })


                    sectionId = $(".classes option:selected").attr('sectionId');

                      $(".classes").change(function(){

                          var option = $('option:selected', this).attr('sectionId');
                          sectionId = option;
                          $(".section[sectionid="+sectionId+"]").show();
                          $(".section[sectionid!="+sectionId+"]").hide();


                      });

                      $(".section[sectionid!="+sectionId+"]").hide();

                  });
            </script>
            <script type="text/javascript" src="/assets/js/froala_editor.min.js"></script>
            <script type="text/javascript" src="/assets/js/froala_editor.pkgd.min.js"></script>
            <!-- <script type="text/javascript" src="/assets/js/image.min.js"></script> -->

            <script>
              $(function() {
                $('textarea#froala-editor').froalaEditor({
                  imageUpload: false,
                  imagePaste: false,
                  imageInsertButtons: false,
                  quickInsertTags: [''],
                  toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'fontFamily', 'fontSize', 'color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', '-', 'insertLink',  'embedly',  '|', 'emoticons', 'specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|', 'print', 'spellChecker', 'help', 'html', '|', 'undo', 'redo']

                });
              });
            </script>

            @stop

        </div>
  </div>


@stop
