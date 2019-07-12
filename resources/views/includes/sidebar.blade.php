<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="index.html">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo"><img src="#" alt="" /></div>
                            </div>
                            <div class="peer peer-greed">
                                <h5 class="lh-1 mB-0 logo-text">Schoolify</h5></div>
                        </div>
                    </a>
                </div>
                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a></div>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu scrollable pos-r">

            <li class="nav-item mT-30 active"><a class="sidebar-link" href="index.html"><span class="icon-holder"><i class="c-blue-500 ti-home"></i> </span><span class="title">Dashboard</span></a></li>


            <!-- Student Navs -->

            @if(Auth::guard('students')->check())
            <li class="nav-item "><a class="sidebar-link" href="/attendance"><span class="icon-holder"><i class="c-orange-500 ti-pencil"></i> </span><span class="title">Attendance</span></a></li>
            <li class="nav-item "><a class="sidebar-link" href="/academic"><span class="icon-holder"><i class="c-deep-orange-500 ti-medall"></i> </span><span class="title">Academic</span></a></li>
            <li class="nav-item "><a class="sidebar-link" href="/announcement"><span class="icon-holder"><i class="c-deep-purple-500 ti-announcement"></i> </span><span class="title">Announcement</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="/give_feedback"><span class="icon-holder"><i class="c-brown-500 ti-email"></i> </span><span class="title">Feedback</span></a></li>

            @elseif(Auth::guard('faculty')->check() && $user->status == 1)
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-teal-500 ti-view-list-alt"></i> </span><span class="title">Classes</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown"><a href="/add_class"><span>Add Class</span></a></li>
                    <li class="nav-item dropdown"><a href="/manage_class"><span>Manage Class</span></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-teal-500 ti-view-list-alt"></i> </span><span class="title">Sections</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown"><a href="/add_section"><span>Add Section</span></a></li>
                    <li class="nav-item dropdown"><a href="/manage_section"><span>Manage Section</span></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-teal-500 ti-view-list-alt"></i> </span><span class="title">Teachers</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown"><a href="/add_teacher"><span>Add Teacher</span></a></li>
                    <li class="nav-item dropdown"><a href="/manage_teacher"><span>Manage Teacher</span></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-teal-500 ti-view-list-alt"></i> </span><span class="title">Students</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown"><a href="/add_student"><span>Add Student</span></a></li>
                    <li class="nav-item dropdown"><a href="/manage_student"><span>Manage Student</span></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-teal-500 ti-view-list-alt"></i> </span><span class="title">Subjects</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown"><a href="/add_subject"><span>Add Subject</span></a></li>
                    <li class="nav-item dropdown"><a href="/manage_subject"><span>Manage Subject</span></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-light-blue-500 ti-pencil"></i> </span><span class="title">Assign</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown"><a href="assign_subject"><span>Assign Subject</span></a></li>
                    <li class="nav-item dropdown"><a href="assign_teacher"><span>Assign Teacher</span></a></li>
                </ul>
            </li>


            @elseif( Auth::guard('faculty')->check())
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-orange-500 ti-pencil"></i> </span><span class="title">Attendance</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown"><a href="/add_attendance"><span>Add Attendance</span></a></li>
                    <li class="nav-item dropdown"><a href="/edit_attendance"><span>Edit Attendance</span></a></li>
                </ul>
            </li>

            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-deep-orange-500 ti-medall"></i> </span><span class="title">Evaluations</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown"><a href="/add_evaluation"><span>Add Evaluations</span></a></li>
                    <li class="nav-item dropdown"><a href="/edit_evaluation"><span>Edit Evaluations</span></a></li>
                </ul>
            </li>

            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-deep-purple-500 ti-announcement"></i> </span><span class="title">Announcement</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown"><a href="/make_announcement"><span>Make Announcement</span></a></li>
                    <li class="nav-item dropdown"><a href="/edit_announcement"><span>Edit Announcement</span></a></li>
                </ul>
            </li>
            <li class="nav-item"><a class="sidebar-link" href="feedback"><span class="icon-holder"><i class="c-brown-500 ti-email"></i> </span><span class="title">Feedback</span></a></li>

            @endif












            <!-- <li class="nav-item"><a class="sidebar-link" href="email.html"><span class="icon-holder"><i class="c-brown-500 ti-email"></i> </span><span class="title">Email</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="compose.html"><span class="icon-holder"><i class="c-blue-500 ti-share"></i> </span><span class="title">Compose</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="calendar.html"><span class="icon-holder"><i class="c-deep-orange-500 ti-calendar"></i> </span><span class="title">Calendar</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="chat.html"><span class="icon-holder"><i class="c-deep-purple-500 ti-comment-alt"></i> </span><span class="title">Chat</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="charts.html"><span class="icon-holder"><i class="c-indigo-500 ti-bar-chart"></i> </span><span class="title">Charts</span></a></li>
            <li class="nav-item"><a class="sidebar-link" href="forms.html"><span class="icon-holder"><i class="c-light-blue-500 ti-pencil"></i> </span><span class="title">Forms</span></a></li>
            <li class="nav-item dropdown"><a class="sidebar-link" href="ui.html"><span class="icon-holder"><i class="c-pink-500 ti-palette"></i> </span><span class="title">UI Elements</span></a></li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-orange-500 ti-layout-list-thumb"></i> </span><span class="title">Tables</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li><a class="sidebar-link" href="basic-table.html">Basic Table</a></li>
                    <li><a class="sidebar-link" href="datatable.html">Data Table</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-purple-500 ti-map"></i> </span><span class="title">Maps</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li><a href="google-maps.html">Google Map</a></li>
                    <li><a href="vector-maps.html">Vector Map</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-red-500 ti-files"></i> </span><span class="title">Pages</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li><a class="sidebar-link" href="blank.html">Blank</a></li>
                    <li><a class="sidebar-link" href="404.html">404</a></li>
                    <li><a class="sidebar-link" href="500.html">500</a></li>
                    <li><a class="sidebar-link" href="signin.html">Sign In</a></li>
                    <li><a class="sidebar-link" href="signup.html">Sign Up</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown"><a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="c-teal-500 ti-view-list-alt"></i> </span><span class="title">Multiple Levels</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item dropdown"><a href="javascript:void(0);"><span>Menu Item</span></a></li>
                    <li class="nav-item dropdown"><a href="javascript:void(0);"><span>Menu Item</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);">Menu Item</a></li>
                            <li><a href="javascript:void(0);">Menu Item</a></li>
                        </ul>
                    </li>
                </ul>
            </li>


             -->
        </ul>
    </div>
</div>
