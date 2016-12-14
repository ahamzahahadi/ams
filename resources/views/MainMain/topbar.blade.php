<!-- **********************************************************************************************************************************************************
TOP BAR CONTENT & NOTIFICATIONS
*********************************************************************************************************************************************************** -->
<!--header start-->
<header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
      <!--logo start-->
      <a href="/" class="logo"><b>ASSET MANAGEMENT SYSTEM</b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
          <!--  notification start -->
          <ul class="nav top-menu">
              <!-- settings start -->
              <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                      <i class="fa fa-tasks"></i>
                      <span class="badge bg-theme">4</span>
                  </a>
                  <ul class="dropdown-menu extended tasks-bar">
                      <div class="notify-arrow notify-arrow-green"></div>
                      <li>
                          <p class="green">You have 4 pending tasks</p>
                      </li>
                      <li>
                          <a href="index.html#">
                              <div class="task-info">
                                  <div class="desc">DashGum Admin Panel</div>
                                  <div class="percent">40%</div>
                              </div>
                              <div class="progress progress-striped">
                                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                      <span class="sr-only">40% Complete (success)</span>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a href="index.html#">
                              <div class="task-info">
                                  <div class="desc">Database Update</div>
                                  <div class="percent">60%</div>
                              </div>
                              <div class="progress progress-striped">
                                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                      <span class="sr-only">60% Complete (warning)</span>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a href="index.html#">
                              <div class="task-info">
                                  <div class="desc">Product Development</div>
                                  <div class="percent">80%</div>
                              </div>
                              <div class="progress progress-striped">
                                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                      <span class="sr-only">80% Complete</span>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a href="index.html#">
                              <div class="task-info">
                                  <div class="desc">Payments Sent</div>
                                  <div class="percent">70%</div>
                              </div>
                              <div class="progress progress-striped">
                                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                      <span class="sr-only">70% Complete (Important)</span>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <li class="external">
                          <a href="#">See All Tasks</a>
                      </li>
                  </ul>
              </li>
              <!-- settings end -->
              <!-- inbox dropdown start-->
              <li id="header_inbox_bar" class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                      <i class="fa fa-envelope-o"></i>
                      <span class="badge bg-theme">5</span>
                  </a>
                  <ul class="dropdown-menu extended inbox">
                      <div class="notify-arrow notify-arrow-green"></div>
                      <li>
                          <p class="green">You have 5 new messages</p>
                      </li>
                      <li>
                          <a href="index.html#">
                              <span class="photo"><img alt="avatar" src="{{ URL::asset('img/ui-UserMale.jpg') }}"></span>
                              <span class="subject">
                              <span class="from">Amir Hamzah</span>
                              <span class="time">Just now</span>
                              </span>
                              <span class="message">
                                  Hi mate, how is everything?
                              </span>
                          </a>
                      </li>
                      <li>
                          <a href="index.html#">
                              <span class="photo"><img alt="avatar" src="{{ URL::asset('img/ui-UserFemale.jpg') }}"></span>
                              <span class="subject">
                              <span class="from">Ustaz Mimi</span>
                              <span class="time">40 mins.</span>
                              </span>
                              <span class="message">
                               KYAHH~! NOTICE ME AMIR SENPAI!!
                              </span>
                          </a>
                      </li>
                      <li>
                          <a href="index.html#">See all messages</a>
                      </li>
                  </ul>
              </li>
              <!-- inbox dropdown end -->
          </ul>
          <!--  notification end -->
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li>
              <a href="{{ url('/logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();" class="logout">
                           <span class="glyphicon glyphicon-off"> Logout</span>
              </a>

              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
          </li>
        </ul>
      </div>
  </header>
<!--header end-->
