<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('dist/img/forbeslogo.png') }}" rel="icon">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.css') }}">
  <script src="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="{{ asset('dist/img/forbeslogo.png') }}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ asset('dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
        <!-- lagout -->
        <li class="nav-item dropdown" id="logout">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-sign-out-alt"></i>
            {{ Auth::user()->name }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
        <!-- end logout -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      @if(Auth::user()->hasRole('Administrator'))
      <a href="{{ route('admindashboard') }}" class="brand-link">
        @endif
        @if(Auth::user()->hasRole('Processor'))
        <a href="{{ route('processordashboard') }}" class="brand-link">
          @endif
          @if(Auth::user()->hasRole('Validator'))
          <a href="{{ route('validatordashboard') }}" class="brand-link">
            @endif
            @if(Auth::user()->hasRole('Approver'))
            <a href="{{ route('approverdashboard') }}" class="brand-link">
              @endif
              @if(Auth::user()->hasRole('Requestor'))
              <a href="{{ route('requestordashboard') }}" class="brand-link">
                @endif
                <img src="{{ asset('dist/img/forbeslogo.png') }} " alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Forbes</span>
              </a>

              <!-- Sidebar -->
              <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  @if (Auth::user()->hasRole('Administrator'))
                  <div class="image">
                    <img src="{{ Auth::user()->picture }}" class="img-circle elevation-2 admin-profile_pic" alt="User Image">
                  </div>
                  <div class="info">
                    <a href="{{ route('profile') }}" class="d-block"> {{ Auth::user()->email }}</a>
                    @endif
                    @if (Auth::user()->hasRole('Requestor'))
                    <div class="image">
                      <img src="{{ Auth::user()->picture }}" class="img-circle elevation-2 requestor-profile_pic" alt="User Image">
                    </div>
                    <div class="info">
                      <a href="{{ route('req_profile') }}" class="d-block"> {{ Auth::user()->email }}</a>
                      @endif
                      @if (Auth::user()->hasRole('Processor'))
                      <div class="image">
                        <img src="{{ Auth::user()->picture }}" class="img-circle elevation-2 processor-profile_pic" alt="User Image">
                      </div>
                      <div class="info">
                        <a href="{{ route('pro_profile') }}" class="d-block"> {{ Auth::user()->email }}</a>
                        @endif
                        @if (Auth::user()->hasRole('Validator'))
                        <div class="image">
                          <img src="{{ Auth::user()->picture }}" class="img-circle elevation-2 validator-profile_pic" alt="User Image">
                        </div>
                        <div class="info">
                          <a href="{{ route('val_profile') }}" class="d-block"> {{ Auth::user()->email }}</a>
                          @endif
                          @if (Auth::user()->hasRole('Approver'))
                          <div class="image">
                            <img src="{{ Auth::user()->picture }}" class="img-circle elevation-2 approver-profile_pic" alt="User Image">
                          </div>
                          <div class="info">
                            <a href="{{ route('app_profile') }}" class="d-block"> {{ Auth::user()->email }}</a>
                            @endif

                          </div>
                        </div>

                        <!-- SidebarSearch Form -->
                        <div class="form-inline">
                          <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                              <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                              </button>
                            </div>
                          </div>
                        </div>

                        <!-- Sidebar Menu -->
                        <nav class="mt-2">
                          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            @if (Auth::user()->hasRole('Administrator'))
                            <li class="nav-item">
                              <a href="{{ route('admindashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                  Home
                                  <span class="right badge badge-danger">New</span>
                                </p>
                              </a>
                            </li>
                            <li class="nav-header">Manage Accounts</li>
                            <li class="nav-item ">
                              <a href="{{ route('account') }}" class="nav-link {{ request()->is('admin/manageAccount') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                  Account
                                  <span class="badge badge-info right">2</span>
                                </p>
                              </a>
                            </li>
                            <li class="nav-header">Manage Facilities</li>
                            <li class="nav-item">
                              <a href="{{ route('facility') }}" class="nav-link {{ request()->is('admin/facility') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                  Building & Department
                                </p>
                              </a>
                            </li>
                            <li class="nav-header">Manage Supplier & Items</li>
                            <li class="nav-item ">
                              <a href="{{ route('supplier_items') }}" class="nav-link {{ request()->is('admin/supplier_items') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                  Supplier & Items
                                </p>
                              </a>
                            </li>
                            <li class="nav-header">Requisition</li>
                            <li class="nav-item ">
                              <a href="{{ route('purchase_request') }}" class="nav-link {{ request()->is('admin/purchase_request') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                  Purchase Request
                                </p>
                              </a>
                            </li>
                            @endif
                            <!-- requestor -->
                            @if(Auth::user()->hasRole('Requestor'))
                            <li class="nav-item">
                              <a href="{{ route('requestordashboard') }}" class="nav-link {{ request()->is('requestor/dashboard') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                  Home
                                  <span class="right badge badge-danger">New</span>
                                </p>
                              </a>
                            </li>
                            <li class="nav-header">Requisition</li>
                            <li class="nav-item ">
                              <a href="{{ route('req_purchase_request') }}" class="nav-link {{ request()->is('requestor/req_purchase_request') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                  Purchase Request
                                </p>
                              </a>
                            </li>
                            @endif
                            <!-- processor -->
                            @if(Auth::user()->hasRole('Processor'))
                            <li class="nav-item">
                              <a href="{{ route('processordashboard') }}" class="nav-link {{ request()->is('processor/dashboard') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                  Home
                                  <span class="right badge badge-danger">New</span>
                                </p>
                              </a>
                            </li>
                            <li class="nav-header">Manage Supplier & Items</li>
                            <li class="nav-item ">
                              <a href="{{ route('pro_supplier_items') }}" class="nav-link {{ request()->is('processor/supplier_items') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                  Supplier & Items
                                </p>
                              </a>
                            </li>
                            <li class="nav-header">Requisition</li>
                            <li class="nav-item ">
                              <a href="{{ route('pro_purchase_request') }}" class="nav-link {{ request()->is('processor/purchase_request') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                  My Purchase Requesition
                                </p>
                              </a>
                            </li>
                            <li class="nav-item active">
                              <a href="{{ route('pr_for_canvass') }}" class="nav-link {{ request()->is('processor/pr_for_canvass') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt "></i>
                                <p>
                                  PR for Canvass
                                </p>
                              </a>
                            </li>
                            @endif
                            <!-- validator -->
                            @if(Auth::user()->hasRole('Validator'))
                            <li class="nav-item">
                              <a href="{{ route('validatordashboard') }}" class="nav-link {{ request()->is('validator/dashboard') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                  Home
                                  <span class="right badge badge-danger">New</span>
                                </p>
                              </a>
                            </li>
                            <li class="nav-header">Requisition</li>
                            <li class="nav-item ">
                              <a href="{{ route('val_purchase_request') }}" class="nav-link {{ request()->is('validator/purchase_request') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                  My Purchase Requesition
                                </p>
                              </a>
                            </li>
                            <li class="nav-item active">
                              <a href="{{ route('pr_check_fund') }}" class="nav-link {{ request()->is('validator/pr_check_fund') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt "></i>
                                <p>
                                  PR Check for Fund
                                </p>
                              </a>
                            </li>
                            @endif
                            <!-- approver -->
                            @if(Auth::user()->hasRole('Approver'))
                            <li class="nav-item">
                              <a href="{{ route('approverdashboard') }}" class="nav-link {{ request()->is('approver/dashboard') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                  Home
                                  <span class="right badge badge-danger">New</span>
                                </p>
                              </a>
                            </li>
                            <li class="nav-header">Requisition</li>
                            <li class="nav-item ">
                              <a href="{{ route('app_purchase_request') }}" class="nav-link {{ request()->is('approver/purchase_request') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                  My Purchase Requesition
                                </p>
                              </a>
                            </li>
                            <li class="nav-item active">
                              <a href="{{ route('new_pr') }}" class="nav-link {{ request()->is('approver/new_pr') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt "></i>
                                <p>
                                  New Purchase Request!
                                </p>
                              </a>
                            </li>
                            <li class="nav-item active">
                              <a href="{{ route('pr_for_verification') }}" class="nav-link {{ request()->is('approver/pr_for_verification') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-calendar-alt "></i>
                                <p>
                                  PR for Verification
                                </p>
                              </a>
                            </li>
                            @endif
                          </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                      </div>
                      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          @yield('content')
        </div>
        <!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="#">Unstappable</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0-rc
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
  <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
  <!-- ChartJS -->
  <!-- <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script> -->

  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

</body>
<script>
  $("#logout").on("click", function() {
    Swal.fire({
      title: 'Are you sure?',
      text: "leave this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, logout!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          icon: 'success',
          title: 'Account have been logout',
          showConfirmButton: false,
          timer: false
        });
        $('#logout-form').submit()
      }
    });
    setTimeout(function() {
      location.reload();
    }, 3000);
  });
</script>

</html>