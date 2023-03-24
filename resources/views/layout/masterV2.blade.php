<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('mytitle')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Calendar Management Systeme For OVM By Wassim Kaouia" name="description" />
        <meta content="Wassim Kaouia" name="author" />
        <!-- App favicon -->
        {{-- <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        @yield('mycss')
    </head>
    <body data-sidebar="dark" data-layout-mode="light">
        @include('sweetalert::alert')
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
        <!-- Begin page -->
        <div id="layout-wrapper">
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="" class="logo logo-dark">
                                <span class="logo-sm">
                                    {{-- <img src="assets/images/logo.svg" alt="" height="22"> --}}
                                </span>
                                <span class="logo-lg">
                                    {{-- <img src="assets/images/logo-dark.png" alt="" height="17"> --}}
                                </span>
                            </a>
                            <a href="" class="logo logo-light">
                                <span class="logo-sm">
                                    {{-- <img src="assets/images/logo-light.svg" alt="" height="22"> --}}
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('/assets/images/logo-ovm.png') }}" alt="" height="26">
                                </span>
                            </a>
                        </div>
                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>
                    <div class="d-flex">
                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>
                        <div class="dropdown d-inline-block">
                            {{-- <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-bell bx-tada"></i>
                                <span class="badge bg-danger rounded-pill">3</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0" key="t-notifications"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small" key="t-view-all"> View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1" key="t-your-order">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-grammer">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">James Lemire</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-simplified">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">1 hours ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span> 
                                    </a>
                                </div>
                            </div>
                        </div> --}}
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{-- <img class="rounded-circle header-profile-user" src="{{ Auth::user()->avatar == 'avatar/default/avatar.png' ? asset(Auth::user()->avatar) : URL('storage/'.Auth::user()->avatar) }}"
                                    alt="Header Avatar"> --}}
                                    <img class="rounded-circle header-profile-user" src="{{ URL(Auth::user()->avatar) }}"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ Auth::user()->name }}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{ route('get-profile',['id' => Auth::user()->id]) }}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                                <a class="dropdown-item d-block" href="#"> <i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> {{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Menu</li>
                            
                            <li class="mm-active">
                                <a href="{{ route('users-list') }}" class="waves-effect active">
                                    <i class="bx bx-user-circle"></i>
                                    <span key="t-starter-page">Gestion des Utilisateurs</span>
                                </a>
                            </li>
                            <li class="mm-active">
                                <a href="{{ route('get-add-page') }}" class="waves-effect active">
                                    <i class="bx bx-user-circle"></i>
                                    <span key="t-starter-page">Ajouter un Utilisateur</span>
                                </a>
                            </li>
                            <li class="mm-active">
                                <a href="{{ route('calendrier-index') }}" class="waves-effect active">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-starter-page">Tous Calendriers</span>
                                </a>
                            </li>
                            <li class="mm-active">
                                <a href="{{ route('calendrier-assistant') }}" class="waves-effect active">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-starter-page">{!! Auth::user()->email == 'eva.mary@onlinevisionmarket.com' ? '<b class="text-danger">Mon Calendrier</b>' : ' Calendrier Fatima' !!}</span>
                                </a>
                            </li>
                            {{-- <li class="mm-active">
                                <a href="{{ route('calendrier-vendor') }}" class="waves-effect active">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-starter-page">{!! Auth::user()->email == 'jeanpierre@onlinevisionmarket.com' ? '<b class="text-danger">Mon Calendrier</b>' : ' Calendrier Joao Pedro' !!}</span>
                                </a>
                            </li> --}}
                            <li class="mm-active">
                                <a href="{{ route('calendrier-supervisor') }}" class="waves-effect active">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-starter-page">{!! Auth::user()->email == 'emilie.motte@onlinevisionmarket.com' ? '<b class="text-danger">Mon Calendrier</b>' : ' Calendrier Andrea' !!}</span>
                                </a>
                            </li>
                            <li class="mm-active">
                                <a href="{{ route('calendrier-webmaster') }}" class="waves-effect active">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-starter-page">{!! Auth::user()->email == 'lucie.peron@onlinevisionmarket.com' ? '<b class="text-danger">Mon Calendrier</b>' : ' Calendrier Alicia' !!}</span>
                                </a>
                            </li>
                            <li class="mm-active">
                                <a href="{{ route('calendrier-vendor') }}" class="waves-effect active">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-starter-page">{!! Auth::user()->email == 'alan.bosser@onlinevisionmarket.com' ? '<b class="text-danger">Mon Calendrier</b>' : ' Calendrier Alan' !!}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        @yield('content')
                        <!-- end page title -->
                    </div> <!-- container-fluid -->
                </div>
            <!-- End Page-content -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © WassCalendario.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                   Developed By Wassim Kaouia - for OVM aka Memory Rituals LTD, Portugal
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
        {{-- <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">
            
                    <h5 class="m-0 me-2">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="{{ asset('assets/images/layouts/layout-1.jpg') }}" class="img-thumbnail" alt="layout images">
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="{{ asset('assets/images/layouts/layout-2.jpg') }}" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch">
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
    
                    <div class="mb-2">
                        <img src="{{ asset('assets/images/layouts/layout-3.jpg') }}" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch">
                        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="{{ asset('assets/images/layouts/layout-4.jpg') }}" class="img-thumbnail" alt="layout images">
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-rtl-mode-switch">
                        <label class="form-check-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
                    </div>

            
                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar --> --}}

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

       
         <!-- JAVASCRIPT -->
 <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
 <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
 <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
 <script src="./assets/js/app.js"></script>    
@yield('myjs')  
<!-- plugin js -->
{{-- <script src="assets/libs/moment/min/moment.min.js"></script>
<script src="assets/libs/jquery-ui-dist/jquery-ui.min.js"></script>
<script src="assets/libs/@fullcalendar/core/main.min.js"></script>
<script src="assets/libs/@fullcalendar/bootstrap/main.min.js"></script>
<script src="assets/libs/@fullcalendar/daygrid/main.min.js"></script>
<script src="assets/libs/@fullcalendar/timegrid/main.min.js"></script>
<script src="assets/libs/@fullcalendar/interaction/main.min.js"></script> --}}
    </body>
</html>
