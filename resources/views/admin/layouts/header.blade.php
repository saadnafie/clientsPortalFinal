<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Portal Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/jquery-bar-rating/css-stars.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin_assets/css/demo_1/style.css') }}" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon.png') }}" />
   
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>




    <style>
    .sidebar .nav .nav-item:not(:nth-child(2)).active {
        background: unset;
      }
      .sidebar .nav .nav-item:not(:nth-child(2)).active > .nav-link .menu-title{
        color:black;
      }
      .sidebar .nav .nav-item:not(:nth-child(2)).active > .nav-link i {
        color:#6a6b83;
      }
      .sidebar .nav .nav-item:not(:nth-child(2)).active > .nav-link .menu-title {
        font-weight: 500;
      }
      .sidebar .nav .nav-item:not(:nth-child(2)).active .sub-menu .nav-link.active {
        color: black;
      }
      .sidebar .nav.sub-menu .nav-item .nav-link.active {
        font-weight: 500;
      }
      .sidebar .nav .nav-item:not(:nth-child(2)).active .sub-menu .nav-link {
        color: black;
      }

      .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
        color: #fff;
        background-color: #ffffff;
        border-color: #ebedf2 #ebedf2 #ffffff;
        background: #0033c4;
      }
    </style>
  </head>
  <body>
    @include('sweet_alert')
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
              <div class="nav-profile-image">
                <i class="mdi mdi-account-circle" style="font-size: 70px;"></i>
                <!--<img src="../assets/images/faces/face1.jpg" alt="profile" />-->
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
                <span class="font-weight-semibold mb-1 mt-2 text-center">Admin Account</span>
                <span class="text-secondary icon-sm text-center">Clients Portal</span>
              </div>
            </a>
          </li>
        <!--  <li class="nav-item pt-3">
            <a class="nav-link d-block" href="index.html">
              <img class="sidebar-brand-logo" src="../assets/images/logo.svg" alt="" />
              <img class="sidebar-brand-logomini" src="../assets/images/logo-mini.svg" alt="" />
              <div class="small font-weight-light pt-1">Responsive Dashboard</div>
            </a>
            <form class="d-flex align-items-center" action="#">
              <div class="input-group">
                <div class="input-group-prepend">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control border-0" placeholder="Search" />
              </div>
            </form>
          </li>
          <li class="pt-2 pb-1">
            <span class="nav-item-head">Template Pages</span>
          </li> -->
          <li class="nav-item border-bottom">
            <a class="nav-link" href="{{ route('admin-dashboard') }}">
              <i class="mdi mdi-compass-outline menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item border-bottom">
              <a class="nav-link" href="{{ route('countries.index') }}">
                <i class="mdi mdi-map menu-icon"></i>
                <span class="menu-title">Countries</span>
              </a>
          </li>

          <li class="nav-item border-bottom">
              <a class="nav-link" href="{{ route('credentials.index') }}">
                <i class="mdi mdi-certificate menu-icon"></i>
                <span class="menu-title">Credentials</span>
              </a>
          </li>

          <li class="nav-item border-bottom">
              <a class="nav-link" href="{{ route('professions.index') }}">
                <i class="mdi mdi-briefcase menu-icon"></i>
                <span class="menu-title">Profession</span>
              </a>
          </li>
          {{--<li class="nav-item border-bottom">
              <a class="nav-link" href="{{ route('subprofessions.index') }}">
                <i class="mdi mdi-adjust menu-icon"></i>
                <span class="menu-title">subProfession</span>
              </a>
          </li>--}}

          

          {{--<!--<li class="nav-item border-bottom">
              <a class="nav-link" href="{{ route('professionCountries.index') }}">
                <i class="mdi mdi-home-map-marker menu-icon"></i>
                <span class="menu-title">Profession Country</span>
              </a>
          </li>
          <li class="nav-item border-bottom">
              <a class="nav-link" href="{{ route('professionRules.index') }}">
                <i class="mdi mdi-check-decagram menu-icon"></i>
                <span class="menu-title">Profession Rules</span>
              </a>
          </li>-->--}}

          <li class="nav-item border-bottom">
              <a class="nav-link" href="{{ route('fieldTypes.index') }}">
                <i class="mdi mdi-table-column-plus-after menu-icon"></i>
                <span class="menu-title">Fields Types</span>
              </a>
          </li>
          <li class="nav-item border-bottom">
              <a class="nav-link" href="{{ route('formFields.index') }}">
                <i class="mdi mdi-table-edit menu-icon"></i>
                <span class="menu-title">Form Fields</span>
              </a>
          </li>
         {{-- <li class="nav-item border-bottom">
              <a class="nav-link" href="{{ route('credentialFormFields.index') }}">
                <i class="mdi mdi-tag-multiple menu-icon"></i>
                <span class="menu-title">Credential Form Fields</span>
              </a>
          </li>--}}


          <!--<li class="nav-item border-bottom">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic-dropdown" aria-expanded="false" aria-controls="ui-basic-dropdown">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Dropdown Options</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic-dropdown">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="#">Country</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Gender</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Major Subject</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Designation</a>
                </li>
              </ul>
            </div>
          </li>-->

          <li class="nav-item border-bottom">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">Settings</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                @foreach($thirdParty as $config)
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('configuration-settings.edit', ['configuration_setting' => $config->id ]) }}">{{ $config->third_party}} Setting</a>
                </li>
                @endforeach

                <li class="nav-item">
                  <a class="nav-link" href="{{ route('basic-setting') }}">Basic Setting</a>
                </li>
              </ul>
            </div>
          </li>

        <!--  <li class="nav-item border-bottom">
            <a class="nav-link" href="pages/icons/mdi.html">
              <i class="mdi mdi-contacts menu-icon"></i>
              <span class="menu-title">Icons</span>
            </a>
          </li>-->
          <li class="nav-item border-bottom">
            <a class="nav-link" href="{{route('logout')}}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="mdi mdi-logout menu-icon"></i>
              <span class="menu-title" >Logout</span>
            </a>
          </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
      </nav>

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
        <!--<div id="theme-settings" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-default-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div>Default
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles default primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles light"></div>
          </div>
        </div>-->
        <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-chevron-double-left"></span>
            </button>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <!--  <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>-->Clients Portal
            </div>
            <ul class="navbar-nav">
              <!--<li class="nav-item dropdown">
                <a class="nav-link" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0 font-weight-semibold">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <i class="mdi mdi-email-outline" style="color: blue;"></i>
                      <img src="../assets/images/faces/face1.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                      <p class="text-gray mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <i class="mdi mdi-email-outline" style="color: blue;"></i>
                      <img src="../assets/images/faces/face6.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                      <p class="text-gray mb-0"> 15 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <i class="mdi mdi-email-outline" style="color: blue;"></i>
                      <img src="../assets/images/faces/face7.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                      <p class="text-gray mb-0"> 18 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <h6 class="p-3 mb-0 text-center text-primary font-13">4 new messages</h6>
                </div>
              </li>-->
              <!--<li class="nav-item dropdown ml-3">
                <a class="nav-link" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="px-3 py-3 font-weight-semibold mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-success">
                        <i class="mdi mdi-calendar"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject font-weight-normal mb-0">New order recieved</h6>
                      <p class="text-gray ellipsis mb-0"> 45 sec ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-warning">
                        <i class="mdi mdi-settings"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject font-weight-normal mb-0">Server limit reached</h6>
                      <p class="text-gray ellipsis mb-0"> 55 sec ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-info">
                        <i class="mdi mdi-link-variant"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject font-weight-normal mb-0">Kevin karvelle</h6>
                      <p class="text-gray ellipsis mb-0"> 11:09 PM </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <h6 class="p-3 font-13 mb-0 text-primary text-center">View all notifications</h6>
                </div>
              </li>-->
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <!--<li class="nav-item nav-logout d-none d-md-block mr-3">
                <a class="nav-link" href="#">Status</a>
              </li>
              <li class="nav-item nav-logout d-none d-md-block">
                <button class="btn btn-sm btn-danger">Trailing</button>
              </li>-->
              <li class="nav-item nav-profile dropdown d-none d-md-block">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <div class="nav-profile-text">English </div>
                </a>
                <div class="dropdown-menu center navbar-dropdown" aria-labelledby="profileDropdown">
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-sa mr-3"></i> Arabic </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-us mr-3"></i> English </a>
                  <div class="dropdown-divider"></div>
                </div>
              </li>
              <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="{{ route('admin-dashboard') }}">
                  <i class="mdi mdi-home-circle"></i>
                </a>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>





         @yield('content')


        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © clientsportal.com 2023</span>
            <!--<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a> from Bootstrapdash.com</span>-->
          </div>

          <div>
          <!--  <span class="text-muted d-block text-center text-sm-left d-sm-inline-block"> Distributed By: <a href="https://themewagon.com/" target="_blank">Themewagon</a></span>-->
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('admin_assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('admin_assets/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendors/flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('admin_assets/vendors/flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('admin_assets/vendors/flot/jquery.flot.categories.js') }}"></script>
  <script src="{{ asset('admin_assets/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
  <script src="{{ asset('admin_assets/vendors/flot/jquery.flot.stack.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('admin_assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin_assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('admin_assets/js/misc.js') }}"></script>
  <script src="{{ asset('admin_assets/js/settings.js') }}"></script>
  <script src="{{ asset('admin_assets/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="{{ asset('admin_assets/js/dashboard.js') }}"></script>
  <!-- End custom js for this page -->




</body>
</html>
