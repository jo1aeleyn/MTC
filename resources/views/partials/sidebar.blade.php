<div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" style="background-color:#326C79 ; color:white">
        <div class="sidebar-logo">

        <div style="padding-top:10px;">
          <!-- Logo Header -->
          <div class="logo-header" style="background-color:#326C79">
            <a href="{{ route('dashboard') }}" class="logo">
            <img
    src="{{ asset('assets/img/mtc/mtc logo.png') }}"
    alt="navbar brand"
    class="navbar-brand mt-2"
    width="90%"
    Style="padding-top:10px;"
/>

            </a>
            <div class="nav-toggle" >
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right" style="color: #ffffff;"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left" style="color: #ffffff;"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt" style="color: #ffffff;"></i>
            </button>
          </div>
          <!-- End Logo Header -->
</div>


        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h" style="color: #ffffff;"></i>
                </span>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#base">
                <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                  <p style="color: #ffffff;">Employee Management</p>
                  <span class="caret" style="color: #ffffff;"></span>
                </a>
                <div class="collapse" id="base">
                  <ul class="nav nav-collapse" style="color: #ffffff;">
                    <li>
                      <a href="{{ route('employees.index') }}">
                        <span class="sub-item" style="color: #ffffff;">Employee List</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('employee.create') }}">
                        <span class="sub-item" style="color: #ffffff;">Register New Employee</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>



              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLayouts">
                  <i class="fas fa-th-list" style="color: #ffffff;"></i>
                  <p style="color: #ffffff;">User Management</p>
                  <span class="caret" style="color: #ffffff;"></span>
                </a>
                <div class="collapse" id="sidebarLayouts">
                  <ul class="nav nav-collapse" style="color: #ffffff;">
                  <li>
                      <a href="{{ route('users.index') }}">
                        <span class="sub-item" style="color: #ffffff;">User List</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('users.create') }}">
                        <span class="sub-item" style="color: #ffffff;">Register New User</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#forms">
                  <i class="fas fa-pen-square" style="color: #ffffff;"></i>
                  <p style="color: #ffffff;">Client Management</p>
                  <span class="caret" style="color: #ffffff;"></span>
                </a>
                <div class="collapse" id="forms">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{ route('clients.index') }}">
                        <span class="sub-item" style="color: #ffffff;">Client List</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('clients.create') }}">
                        <span class="sub-item" style="color: #ffffff;">Client Information Sheet</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#submenu">
                  <i class="fas fa-bars" style="color: #ffffff;"></i>
                  <p style="color: #ffffff;">Applications</p>
                  <span class="caret" style="color: #ffffff;"></span>
                </a>
                <div class="collapse" id="submenu">
                  <ul class="nav nav-collapse">
                    <li>
                      <a data-bs-toggle="collapse" href="#subnav1">
                        <span class="sub-item" style="color: #ffffff;">Overtime Request</span>
                        <span class="caret" style="color: #ffffff;"></span>
                      </a>
                      <div class="collapse" id="subnav1">
                        <ul class="nav nav-collapse subnav">
                          <li>
                            <a href="#">
                              <span class="sub-item" style="color: #ffffff;">Pending Overtime Request</span>
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <span class="sub-item" style="color: #ffffff;">Overtime Request Form</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#subnav2">
                          <span class="sub-item" style="color: #ffffff;">Reimbursements</span>
                          <span class="caret" style="color: #ffffff;"></span>
                        </a>
                        <div class="collapse" id="subnav2">
                          <ul class="nav nav-collapse subnav">
                            <li>
                              <a href="#">
                                <span class="sub-item" style="color: #ffffff;">Pending Reimbursements</span>
                              </a>
                            </li>
                            <li>
                              <a href="#">
                                <span class="sub-item" style="color: #ffffff;">Reimbursement Form</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li>
                        <a data-bs-toggle="collapse" href="#subnav3">
                          <span class="sub-item" style="color: #ffffff;">Employee Leave</span>
                          <span class="caret" style="color: #ffffff;"></span>
                        </a>
                        <div class="collapse" id="subnav3">
                          <ul class="nav nav-collapse subnav">
                            <li>
                              <a href="#">
                                <span class="sub-item" style="color: #ffffff;">Pending Leaves</span>
                              </a>
                            </li>
                            <li>
                              <a href="#">
                                <span class="sub-item" style="color: #ffffff;">Leave Request Form</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li>
                        <a data-bs-toggle="collapse" href="#subnav4">
                          <span class="sub-item" style="color: #ffffff;">Cash Advance</span>
                          <span class="caret" style="color: #ffffff;"></span>
                        </a>
                        <div class="collapse" id="subnav4">
                          <ul class="nav nav-collapse subnav">
                            <li>
                              <a href="#">
                                <span class="sub-item" style="color: #ffffff;">Pending Cash Advance</span>
                              </a>
                            </li>
                            <li>
                              <a href="#">
                                <span class="sub-item" style="color: #ffffff;">Cash Advance Request Form</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#maps">
                  <i class="fas fa-solid fa-bullhorn" style="color: #ffffff;"></i>
                  <p style="color: #ffffff;">Announcements</p>
                  <span class="caret" style="color: #ffffff;"></span>
                </a>
                <div class="collapse" id="maps">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{route('announcements.index')}}">
                        <span class="sub-item" style="color: #ffffff;">Announcements List</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{route('announcements.create')}}">
                        <span class="sub-item" style="color: #ffffff;">Post an Announcement</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#charts">
                  <i class="far fa-chart-bar" style="color: #ffffff;"></i>
                  <p style="color: #ffffff;">Charts</p>
                  <span class="caret" style="color: #ffffff;"></span>
                </a>
                <div class="collapse" id="charts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="charts/charts.html">
                        <span class="sub-item" style="color: #ffffff;">Chart Js</span>
                      </a>
                    </li>
                    <li>
                      <a href="charts/sparkline.html">
                        <span class="sub-item" style="color: #ffffff;">Sparkline</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="widgets.html">
                  <i class="fas fa-desktop" style="color: #ffffff;"></i>
                  <p style="color: #ffffff;">Widgets</p>
                  <span class="badge badge-success" style="color: #ffffff;">4</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../documentation/index.html">
                  <i class="fas fa-file" style="color: #ffffff;" ></i>
                  <p style="color: #ffffff;" >Documentation</p>
                  <span class="badge badge-secondary" style="color: #ffffff;">1</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->


      