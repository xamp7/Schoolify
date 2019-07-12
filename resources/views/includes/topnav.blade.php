<div class="header navbar">
        <div class="header-container">
            <ul class="nav-left">
                <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a></li>
                <li class="search-box"><a class="search-toggle no-pdd-right" href="javascript:void(0);"><i class="search-icon ti-search pdd-right-10"></i> <i class="search-icon-close ti-close pdd-right-10"></i></a></li>
                <li class="search-input">
                    <input class="form-control" type="text" placeholder="Search...">
                </li>
            </ul>
            <ul class="nav-right">

                        @if(Auth::guard('students')->check())

                        <li id="notificationCounter" class="notifications dropdown"><span class="counter bgc-red notificationCount">{{ count($notifications)}} </span> <a href="" class="dropdown-toggle no-after" data-toggle="dropdown"><i class="ti-bell"></i></a>
                            <ul class="dropdown-menu">
                                <li class="pX-20 pY-15 bdB"><i class="ti-bell pR-10"></i> <span class="fsz-sm fw-600 c-grey-900">Notifications</span></li>
                                <li>
                                    <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
                                        @foreach($notifications as $notification)
                                        <li>
                                            <a href="{{ $notification->link }}" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                <div class="peer mR-15"><img class="w-3r bdrs-50p" src="#" alt=""></div>
                                                <div class="peer peer-greed">
                                                        <p class="fw-500 mB-0">{{ $notification->notification }}</p>

                                                    <!-- <p class="m-0"><small class="fsz-xs">5 mins ago</small></p> -->
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                        @if($notifications->count() == 0)
                                        <a href="#" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                            <div class="peer mR-15"><img class="w-3r bdrs-50p" src="#" alt=""></div>
                                            <div class="peer peer-greed">
                                                    <p class="fw-500 mB-0">No new notifications</p>

                                                <!-- <p class="m-0"><small class="fsz-xs">5 mins ago</small></p> -->
                                            </div>
                                        </a>
                                        @endif



                                    </ul>
                                </li>
                                <li class="pX-20 pY-15 ta-c bdT"><span><a href="" class="c-grey-600 cH-blue fsz-sm td-n">View All Notifications <i class="ti-angle-right fsz-xs mL-10"></i></a></span></li>
                            </ul>
                        </li>


                        @endif

                        @if(Auth::guard('faculty')->check())
                        <!-- Faculty Portal Nav Icon Options i.e Notifications/Feedback Buttons -->

                        <li id="notificationCounter" class="notifications dropdown"><span class="counter bgc-red notificationCount">{{ count($notifications)}} </span> <a href="" class="dropdown-toggle no-after" data-toggle="dropdown"><i class="ti-bell"></i></a>
                            <ul class="dropdown-menu">
                                <li class="pX-20 pY-15 bdB"><i class="ti-bell pR-10"></i> <span class="fsz-sm fw-600 c-grey-900">Notifications</span></li>
                                <li>
                                    <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
                                        @foreach($notifications as $notification)
                                        <li>
                                            <a href="{{ $notification->link }}" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                <div class="peer mR-15"><img class="w-3r bdrs-50p" src="#" alt=""></div>
                                                <div class="peer peer-greed">
                                                        <p class="fw-500 mB-0">{{ $notification->notification }}</p>

                                                    <!-- <p class="m-0"><small class="fsz-xs">5 mins ago</small></p> -->
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach

                                        @if($notifications->count() == 0)
                                        <a href="#" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                            <div class="peer mR-15"><img class="w-3r bdrs-50p" src="#" alt=""></div>
                                            <div class="peer peer-greed">
                                                    <p class="fw-500 mB-0">No new notifications</p>

                                                <!-- <p class="m-0"><small class="fsz-xs">5 mins ago</small></p> -->
                                            </div>
                                        </a>
                                        @endif


                                    </ul>
                                </li>
                                <li class="pX-20 pY-15 ta-c bdT"><span><a href="" class="c-grey-600 cH-blue fsz-sm td-n">View All Notifications <i class="ti-angle-right fsz-xs mL-10"></i></a></span></li>
                            </ul>
                        </li>



                        <li class="notifications dropdown" id="feedbackCounter"><span class="counter bgc-blue feedbackCount" >{{ count($feedbacks) }}</span> <a href="" class="dropdown-toggle no-after" data-toggle="dropdown"><i class="ti-email"></i></a>

                        <ul class="dropdown-menu">
                            <li class="pX-20 pY-15 bdB"><i class="ti-email pR-10"></i> <span class="fsz-sm fw-600 c-grey-900">Feedback</span></li>
                            <li>
                                <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
                                        @foreach($feedbacks as $feedback)
                                        <li>
                                                <a href="/feedback" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                                    <div class="peer mR-15"><img class="w-3r bdrs-50p" src="#" alt=""></div>
                                                    <div class="peer peer-greed">
                                                        <div>
                                                            <div class="peers jc-sb fxw-nw mB-5">
                                                                <div class="peer">
                                                                    <p class="fw-500 mB-0">{{ $feedback->title }}</p>
                                                                </div>
                                                                <!-- <div class="peer"><small class="fsz-xs">5 mins ago</small></div> -->
                                                        </div><span class="c-grey-600 fsz-sm">{{ str_limit($feedback->feedback, 70) }} ... </span></div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                        @if($feedbacks->count() == 0)
                                        <a href="#" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                            <div class="peer mR-15"><img class="w-3r bdrs-50p" src="#" alt=""></div>
                                            <div class="peer peer-greed">
                                                    <p class="fw-500 mB-0">No new feedback</p>

                                                <!-- <p class="m-0"><small class="fsz-xs">5 mins ago</small></p> -->
                                            </div>
                                        </a>
                                        @endif

                                </ul>
                            </li>
                            <li class="pX-20 pY-15 ta-c bdT"><span><a href="/feedback" class="c-grey-600 cH-blue fsz-sm td-n">View All Feedbacks <i class="fs-xs ti-angle-right mL-10"></i></a></span></li>
                        </ul>
                        @endif


                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                        <div class="peer mR-10"><img class="w-2r bdrs-50p" src="#" alt=""></div>
                        <div class="peer"><span class="fsz-sm c-grey-900">{{ $user->name }}</span></div>
                    </a>
                    <ul class="dropdown-menu fsz-sm">
                        <li><a href="/settings" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-settings mR-10"></i> <span>Settings</span></a></li>
                        <!-- <li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-user mR-10"></i> <span>Profile</span></a></li> -->
                        <!-- <li><a href="email.html" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-email mR-10"></i> <span>Messages</span></a></li> -->
                        <li role="separator" class="divider"></li>




                        <li><a  href="{{ route('logout') }}"    onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-power-off mR-10"></i> <span>Logout</span></a></li>

                                                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                     @csrf
                                                                 </form>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
