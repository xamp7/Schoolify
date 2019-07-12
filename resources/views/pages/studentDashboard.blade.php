@extends('app')



@section('content')
      <!-- Navigation-->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
         <a class="navbar-brand" href="index.html"><img class="logo" src="logo.png"></a>
         <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav color_set" id="">
               <div class="dropdown-divider set_divider_color"></div>
               <li class="nav-item sidesection" data-toggle="tooltip" data-placement="right" title="Upload Attendence">
                  <a class="nav-link" href="view_attendance.html">
                  <i class="fa fa-credit-card icon_color"></i>
                  <span class="nav-link-text spacing">View Attendence</span>
                  </a>
               </li>
               <div class="dropdown-divider set_divider_color"></div>
               <li class="nav-item sidesection" data-toggle="tooltip" data-placement="right" title="Upload Assignment">
                  <a class="nav-link" href="view_assignment.html">
                  <i class="fa fa-cog icon_color"></i>
                  <span class="nav-link-text spacing">View Assignment</span>
                  </a>
               </li>
               <div class="dropdown-divider set_divider_color"></div>
               <li class="nav-item sidesection" data-toggle="tooltip" data-placement="right" title="Upload Assessment">
                  <a class="nav-link" href="view_assessment.html">
                  <i class="fa fa-file icon_color"></i>
                  <span class="nav-link-text spacing">View Assessment</span>
                  </a>
               </li>
               <div class="dropdown-divider set_divider_color"></div>
               <li class="nav-item sidesection" data-toggle="tooltip" data-placement="right" title="Upload Accedmic Record">
                  <a class="nav-link" href="view_accedmic_record.html">
                  <i class="fa fa-file icon_color"></i>
                  <span class="nav-link-text spacing">View Accedmic Record</span>
                  </a>
               </li>
               <div class="dropdown-divider set_divider_color"></div>
               <li class="nav-item sidesection" data-toggle="tooltip" data-placement="right" title="Feedback">
                  <a class="nav-link" href="give_feedback.html">
                  <i class="fa fa-bell icon_color"></i>
                  <span class="nav-link-text spacing">Give Feedback</span>
                  </a>
               </li>
               <div class="dropdown-divider set_divider_color"></div>
               <li class="nav-item sidesection" data-toggle="tooltip" data-placement="right" title="Settings">
                  <a class="nav-link" href="parent_settings.html">
                  <i class="fa fa-cog icon_color"></i>
                  <span class="nav-link-text spacing">Settings</span>
                  </a>
               </li>

               <div class="dropdown-divider set_divider_color"></div>
            </ul>
            <ul class="navbar-nav sidenav-toggler">
               <li class="nav-item">
                  <a class="nav-link text-center" id="sidenavToggler">
                  <i class="fa fa-fw fa-angle-left"></i>
                  </a>
               </li>
            </ul>
            <ul class="navbar-nav ml-auto">

               <li class="nav-item">
                  <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                  <i class="fa fa-fw fa-sign-out"></i>Logout</a>
               </li>
            </ul>
         </div>
      </nav>
      <div class="content-wrapper">
         <div class="container-fluid">
            <h3 style="color: black;">View Assignment!</h3>
            <div class="card mb-3">
               <div class="card-body">
                  <!-- Form start -->
                  <form style="margin: 0 auto;
                     width:350px;">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="form-group">
                              <select class="form-control">
                                 <option style="" selected disabled="true">Choose Subject</option>
                                 <option>Mathematics</option>
                                 <option>Science</option>
                                 <option>Arts</option>
                                 <option>Urdu</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-sm-12">
                           <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                     </div>
                  </form>
                  <!--table view start -->
                  <table class="table" style="margin-top: 20px">
                     <tr>
                        <th>Message</th>
                        <th>File</th>
                        <th>Event Date</th>
                     </tr>
                     <tr>
                        <td>Lorem Ipsum is a dummy text.</td>
                        <td>File from db</td>
                        <td>27-12-2017</td>
                     </tr>
                  </table>
                  <!--table view end -->
                  <!-- Form end -->
               </div>
               <div class="card-footer small text-muted">1</div>
            </div>
         </div>
         <!-- /.container-fluid-->
         <!-- /.content-wrapper-->
         <footer class="sticky-footer">
            <div class="container">
               <div class="text-center" style="color: black;">
                  <small>Copyright@Parent-Teacher-Porta/2017</small>
               </div>
            </div>
         </footer>
         <!-- Scroll to Top Button-->
         <a class="scroll-to-top rounded" href="#page-top">
         <i class="fa fa-angle-up"></i>
         </a>
         <!-- Logout Modal-->
         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                     <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                     </button>
                  </div>
                  <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                  <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                     <a class="btn btn-primary" href="login.html">Logout</a>
                  </div>
               </div>
            </div>
         </div>
@stop

