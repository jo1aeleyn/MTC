

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

              @if(auth()->user()->user_role == 'HR Admin' || auth()->user()->user_role == 'Partners')
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
              @endif


              @if(auth()->user()->user_role == 'HR Admin' || auth()->user()->user_role == 'Partners')
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

              @endif

              @if(auth()->user()->user_role == 'HR Admin' || auth()->user()->user_role == 'Partners')
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

              @endif
             
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#submenu">
                  <i class="fas fa-bars" style="color: #ffffff;"></i>
                  <p style="color: #ffffff;">Applications/Requests</p>
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
                        @if(auth()->user()->user_role == 'HR Admin' || auth()->user()->user_role == 'Partners')
                          <li>
                            <a href="{{route('overtime.index')}}">
                              <span class="sub-item" style="color: #ffffff;">Pending Overtime Request</span>
                            </a>
                          </li>
                       @endif
                          <li>
                            <a href="{{route('overtime.personalindex')}}">
                              <span class="sub-item" style="color: #ffffff;">My Overtime Request</span>
                            </a>
                          </li>
                   
                          <li>
                            <a href="{{route('overtime.create')}}">
                              <span class="sub-item" style="color: #ffffff;">Overtime Request Form</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                        <a data-bs-toggle="collapse" href="#subnav2">
                          <span class="sub-item" style="color: #ffffff;">Financial Requests</span>
                          <span class="caret" style="color: #ffffff;"></span>
                        </a>
                        <div class="collapse" id="subnav2">
                          <ul class="nav nav-collapse subnav">
                          @if(auth()->user()->user_role == 'HR Admin' || auth()->user()->user_role == 'Partners')
                            <li>
                              <a href="{{route('financial_req.index')}}">
                                <span class="sub-item" style="color: #ffffff;">Requests</span>
                              </a>
                            </li>
                          @endif
                          <li>
                              <a href="{{route('financial_req.personalindex')}}">
                                <span class="sub-item" style="color: #ffffff;">My Requests</span>
                              </a>
                            </li>
                           
                            <li>
                              <a href="{{route('financial_req.create')}}">
                                <span class="sub-item" style="color: #ffffff;">Financial Request Form</span>
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
                              <a href="{{route('leaves.PersonalLeaves')}}">
                                <span class="sub-item" style="color: #ffffff;">My Leaves Application</span>
                              </a>
                            </li>
                            @if(auth()->user()->user_role == 'HR Admin' || auth()->user()->user_role == 'Partners')
                            <li>
                              <a href="{{route('leaves.index')}}">
                                <span class="sub-item" style="color: #ffffff;">Leaves Application</span>
                              </a>
                            </li>
                            @endif
                            <li>
                              <a href="{{route('leaves.create')}}">
                                <span class="sub-item" style="color: #ffffff;">Leave Request Form</span>
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
                      <a href="{{route('announcements.companyannouncements')}}">
                        <span class="sub-item" style="color: #ffffff;">Company Announcements</span>
                      </a>
                    </li>
                    @if(auth()->user()->user_role == 'HR Admin' || auth()->user()->user_role == 'Partners')
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
                    @endif
                  </ul>
                </div>
              </li>
              

              @if(auth()->user()->user_role == 'HR Admin' || auth()->user()->user_role == 'Partners')
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#charts">
                  <i class="far fa-chart-bar" style="color: #ffffff;"></i>
                  <p style="color: #ffffff;">Departments</p>
                  <span class="caret" style="color: #ffffff;"></span>
                </a>
                <div class="collapse" id="charts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{route('departments.index')}}">
                        <span class="sub-item" style="color: #ffffff;">Department List</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              @endif
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#payroll">
                  <i class="fas fa-solid fa-desktop" style="color: #ffffff;"></i>
                  <p style="color: #ffffff;">Payroll</p>
                  <span class="caret" style="color: #ffffff;"></span>
                </a>
                <div class="collapse" id="payroll">
                  <ul class="nav nav-collapse">
                  <li>
                      <a href="#">
                        <span class="sub-item" style="color: #ffffff;">Payslip</span>
                      </a>
                    </li>
                    @if(auth()->user()->user_role == 'HR Admin' || auth()->user()->user_role == 'Partners')
                    <li>
                      <a href="#">
                        <span class="sub-item" style="color: #ffffff;">Payroll Management</span>
                      </a>
                    </li>
                    @endif
                  </ul>
                </div>
              </li>

              @if(auth()->user()->user_role == 'HR Admin' || auth()->user()->user_role == 'Partners' || auth()->user()->user_role == 'IT Admin')
              <li class="nav-item">
                <a href="#">
                  <i class="fas fa-file" style="color: #ffffff;" ></i>
                  <p style="color: #ffffff;" >Audit Logs</p>
                  <!-- <span class="badge badge-secondary" style="color: #ffffff;">1</span> -->
                </a>
              </li>
              @endif
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->


      