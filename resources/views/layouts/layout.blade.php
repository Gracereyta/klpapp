<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="//cdn.ckeditor.com/4.16.1/basic/ckeditor.js"></script>
</head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Admin Panel  </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
               
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }} <i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        @if (Auth::user()->id == 1)
                        <li><a class="dropdown-item" href="{{ url('users') }}">All user</a></li>
                        @else 
                        @endif
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ url('/dashboard') }}">
                                <div ><svg x="0px" y="0px" width="20" height="20" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M83.3125,5.375c-42.979,0 -77.9375,34.96899 -77.9375,77.9375c0,42.96851 34.9585,77.9375 77.9375,77.9375c42.97901,0 77.9375,-34.96899 77.9375,-77.9375c0,-42.96851 -34.95849,-77.9375 -77.9375,-77.9375zM83.3125,10.75c40.00806,0 72.5625,32.55444 72.5625,72.5625c0,40.00806 -32.55444,72.5625 -72.5625,72.5625c-40.00806,0 -72.5625,-32.55444 -72.5625,-72.5625c0,-40.00806 32.55444,-72.5625 72.5625,-72.5625zM84.02637,21.5c-16.07251,-0.19946 -31.26318,5.70044 -43.04199,16.75488c-12.3772,11.64233 -19.48437,28.07178 -19.48437,45.05762c0,11.91528 3.40137,23.48413 9.82617,33.45728c1.34375,2.07861 3.50635,3.42236 5.9314,3.70581c2.42505,0.26245 4.8606,-0.56689 6.64527,-2.30957c10.59253,-10.34058 24.59692,-16.04102 39.40967,-16.04102c14.81274,0 28.80664,5.70044 39.40967,16.04102c1.56421,1.52222 3.61133,2.35156 5.73193,2.35156c0.30444,0 0.61939,-0.0105 0.92383,-0.04199c2.41455,-0.28345 4.57715,-1.6272 5.9104,-3.69531c6.91821,-10.71851 10.30908,-23.17969 9.78418,-36.0293c-0.70337,-17.50024 -9.00733,-34.00317 -22.74927,-45.26758c-1.15478,-0.94482 -2.84497,-0.77685 -3.7793,0.37793c-0.94482,1.14429 -0.78735,2.83447 0.36743,3.7793c12.56616,10.28809 20.14575,25.36328 20.79663,41.32031c0.47241,11.73682 -2.62451,23.1167 -8.94434,32.91138c-0.46191,0.71387 -1.16528,1.16528 -1.99463,1.25977c-0.81885,0.09448 -1.66919,-0.20996 -2.28858,-0.81885c-8.33545,-8.12549 -18.60254,-13.58447 -29.73047,-16.05151v-36.44922c0,-1.27026 -0.89233,-2.36206 -2.1311,-2.63501c-1.22827,-0.25195 -2.49853,0.38843 -3.00244,1.54321l-16.28247,36.60669c-13.21704,1.70068 -25.49976,7.5376 -35.18945,16.98584c-0.62988,0.61939 -1.43823,0.90283 -2.27808,0.81885c-0.83984,-0.09448 -1.54321,-0.5459 -2.01562,-1.28076c-5.86841,-9.09131 -8.97583,-19.65234 -8.97583,-30.53882c0,-15.73657 6.31983,-30.34985 17.79419,-41.14185c11.46387,-10.77099 26.45508,-16.16699 42.25464,-15.18017c1.42773,0.08398 2.83447,0.23096 4.24121,0.43042c1.46973,0.20996 2.82397,-0.81885 3.03393,-2.28857c0.20996,-1.48023 -0.81885,-2.83447 -2.28857,-3.04443c-1.53272,-0.20996 -3.09692,-0.37793 -4.65064,-0.46191c-1.0813,-0.07349 -2.1626,-0.11548 -3.2334,-0.12598zM103.89917,25.22681c-1.0498,0.04199 -2.01562,0.70337 -2.40405,1.74267c-0.5249,1.39624 0.17847,2.93945 1.57471,3.46436c1.91064,0.70337 3.80029,1.53271 5.63745,2.45654c0.38843,0.19946 0.80835,0.29395 1.21777,0.29395c0.97632,0 1.92114,-0.5354 2.40405,-1.48022c0.66138,-1.31226 0.12598,-2.93945 -1.19678,-3.61133c-2.01562,-1.00781 -4.09424,-1.92114 -6.18335,-2.70849c-0.34643,-0.12598 -0.70337,-0.16797 -1.0498,-0.15747zM83.3125,37.625c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM67.25049,40.75342c-0.34644,-0.0105 -0.70337,0.06299 -1.0498,0.19946c-1.37524,0.5564 -2.04712,2.12061 -1.49072,3.49585l2.01563,4.97607c0.41992,1.0498 1.42773,1.69018 2.48804,1.69018c0.33594,0 0.68238,-0.06299 1.00781,-0.19946c1.38574,-0.5564 2.04712,-2.12061 1.49072,-3.49585l-2.01562,-4.97607c-0.41992,-1.03931 -1.39624,-1.66919 -2.44604,-1.69018zM99.38501,40.75342c-1.0498,0.02099 -2.03662,0.65088 -2.45654,1.69018l-2.01562,4.97607c-0.5564,1.37524 0.10498,2.93945 1.49072,3.49585c0.32544,0.13647 0.67188,0.19946 1.00781,0.19946c1.0603,0 2.06811,-0.64038 2.48804,-1.69018l2.01563,-4.97607c0.5564,-1.37524 -0.11548,-2.93945 -1.49072,-3.49585c-0.34644,-0.13647 -0.69287,-0.20996 -1.03931,-0.19946zM113.13745,49.68726c-0.69287,0.021 -1.37524,0.29395 -1.88965,0.82935l-3.7373,3.86328c-1.02881,1.0708 -0.99731,2.77148 0.07349,3.80029c0.5249,0.50391 1.18628,0.75586 1.85815,0.75586c0.71387,0 1.40674,-0.28345 1.93164,-0.81885l3.7373,-3.87378c1.03931,-1.0708 1.00781,-2.77148 -0.06299,-3.80029c-0.5354,-0.5144 -1.21777,-0.76636 -1.91065,-0.75586zM53.48755,49.69776c-0.69287,-0.0105 -1.38574,0.23096 -1.92114,0.74536c-1.0603,1.03931 -1.0918,2.73999 -0.06299,3.81079l3.7373,3.86328c0.5249,0.5459 1.22827,0.81885 1.94214,0.81885c0.67188,0 1.33325,-0.25195 1.85815,-0.74536c1.0708,-1.03931 1.10229,-2.73999 0.07349,-3.81079l-3.7373,-3.86328c-0.5144,-0.5354 -1.19678,-0.80835 -1.88965,-0.81885zM44.0813,63.13526c-1.0498,-0.021 -2.04712,0.57739 -2.50903,1.6062c-0.59839,1.35425 0.0105,2.93945 1.36475,3.53784l4.91309,2.18359c0.35693,0.15747 0.72436,0.24146 1.0918,0.24146c1.02881,0 2.00512,-0.59839 2.45654,-1.5957c0.59839,-1.36475 -0.0105,-2.94995 -1.36474,-3.55884l-4.91309,-2.18359c-0.33594,-0.14697 -0.69287,-0.22046 -1.03931,-0.23096zM122.5437,63.13526c-0.34643,0.0105 -0.70337,0.07348 -1.0393,0.23096l-4.91309,2.18359c-1.35425,0.60889 -1.96314,2.19409 -1.36475,3.54834c0.45142,0.99731 1.42773,1.5957 2.45654,1.5957c0.36743,0 0.73486,-0.07349 1.0918,-0.23096l4.91309,-2.18359c1.35425,-0.60889 1.96313,-2.19409 1.36474,-3.54834c-0.46191,-1.01831 -1.45923,-1.6167 -2.50903,-1.5957zM91.375,74.48364v22.85425c-2.65601,-0.34643 -5.34351,-0.58789 -8.0625,-0.58789c-0.62988,0 -1.24927,0.07349 -1.87915,0.08398zM40.3125,80.625c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875c0,1.49072 1.20728,2.6875 2.6875,2.6875h5.375c1.48022,0 2.6875,-1.19678 2.6875,-2.6875c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM120.9375,80.625c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875c0,1.49072 1.20728,2.6875 2.6875,2.6875h5.375c1.48022,0 2.6875,-1.19678 2.6875,-2.6875c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM48.46948,94.72388c-0.34643,-0.0105 -0.70337,0.05249 -1.0498,0.18896l-4.97607,2.01563c-1.38574,0.5564 -2.04712,2.12061 -1.49072,3.50635c0.41992,1.03931 1.42773,1.67969 2.49854,1.67969c0.33594,0 0.67188,-0.06299 1.00781,-0.19946l4.97607,-2.01562c1.37524,-0.5564 2.03662,-2.1206 1.49072,-3.49585c-0.41992,-1.03931 -1.40674,-1.66919 -2.45654,-1.67969zM118.15552,94.72388c-1.0498,0.0105 -2.03662,0.64038 -2.45654,1.67969c-0.5459,1.37524 0.11548,2.93945 1.49072,3.49585l4.97607,2.01563c0.33594,0.13647 0.67188,0.19946 1.00781,0.19946c1.0708,0 2.07861,-0.64038 2.49854,-1.67969c0.5564,-1.38574 -0.10498,-2.94995 -1.48022,-3.50635l-4.98657,-2.01562c-0.34643,-0.13647 -0.70337,-0.19946 -1.0498,-0.18896zM61.59204,118.25c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875c0,1.49072 1.20728,2.6875 2.6875,2.6875h43.67188c1.48022,0 2.6875,-1.19678 2.6875,-2.6875c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM66.96704,129c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875c0,1.49072 1.20728,2.6875 2.6875,2.6875h16.79688c1.48022,0 2.6875,-1.19678 2.6875,-2.6875c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM93.84204,129c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875c0,1.49072 1.20728,2.6875 2.6875,2.6875h6.04688c1.48022,0 2.6875,-1.19678 2.6875,-2.6875c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875z"></path></g></g></svg></div>
                                <span>&nbsp; Dashboard</span>
                            </a>
                            <a class="nav-link" href="{{ url('/themes') }}">
                                <div><svg x="0px" y="0px" width="20" height="20" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M21.5,21.5v129h54.2959c0.79013,-3.91837 2.53608,-7.54112 4.96558,-10.75h-48.51148v-75.25h107.5v10.88648c0.89225,-0.05912 1.77912,-0.13648 2.6875,-0.13648c2.76275,0 5.45562,0.27623 8.0625,0.80835v-54.55835zM32.25,32.25h107.5v21.5h-107.5zM37.625,37.625v10.75h10.75v-10.75zM53.75,37.625v10.75h10.75v-10.75zM69.875,37.625v10.75h10.75v-10.75zM142.4375,86c-16.297,0 -29.5625,13.26012 -29.5625,29.5625c0,1.92963 0.20165,3.80995 0.5564,5.63745c-8.2345,8.4925 -20.28853,20.86079 -22.70728,23.27417c-3.04225,3.04763 -4.72412,7.09551 -4.72412,11.40088c0,4.30537 1.68187,8.35863 4.72412,11.40088c3.04225,3.04225 7.09551,4.72412 11.40088,4.72412c4.30537,0 8.35326,-1.68187 11.40088,-4.72412c2.40262,-2.40263 14.74942,-14.4459 23.27417,-22.70728c1.82212,0.35475 3.70783,0.5564 5.63745,0.5564c16.297,0 29.5625,-13.26012 29.5625,-29.5625c0,-16.30238 -13.2655,-29.5625 -29.5625,-29.5625zM142.4375,96.75c2.19837,0 4.27396,0.45091 6.23584,1.14429l-14.29834,14.30884l11.42188,11.42188l14.29834,-14.29834c0.69875,1.96188 1.15479,4.03746 1.15479,6.23584c0,10.37375 -8.43875,18.8125 -18.8125,18.8125c-3.10138,0 -5.98641,-0.8296 -8.56641,-2.1626c-10.3415,10.11038 -26.22043,25.73752 -27.9458,27.46289c-1.01587,1.01587 -2.36517,1.57471 -3.80029,1.57471c-1.43512,0 -2.78442,-0.55883 -3.80029,-1.57471c-1.01588,-1.01587 -1.57471,-2.36517 -1.57471,-3.80029c0,-1.43512 0.55883,-2.78442 1.57471,-3.80029c1.83825,-1.83825 18.12702,-18.42054 27.4419,-27.97729c-1.32763,-2.56925 -2.1416,-5.44966 -2.1416,-8.53491c0,-10.37375 8.43875,-18.8125 18.8125,-18.8125z"></path></g></g></svg></div>
                                <span>&nbsp; Themes</span>
                            </a>
                            <a class="nav-link" href="{{ url('/cropper') }}">
                                <div><svg x="0px" y="0px" width="20" height="20" viewBox="0 0 172 172" style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#cccccc"><path d="M42.86563,17.07682c-4.74526,0.07413 -8.5337,3.97783 -8.46563,8.72318v8.6h-8.6c-4.7472,0 -8.6,3.8528 -8.6,8.6c0,4.7472 3.8528,8.6 8.6,8.6h8.6v71.66667c0,7.81794 6.51539,14.33333 14.33333,14.33333h71.66667v8.6c0,4.7472 3.8528,8.6 8.6,8.6c4.7472,0 8.6,-3.8528 8.6,-8.6v-8.6h8.6c3.10147,0.04386 5.9863,-1.58563 7.54983,-4.26451c1.56353,-2.67888 1.56353,-5.99211 0,-8.67099c-1.56353,-2.67888 -4.44837,-4.30837 -7.54983,-4.26451h-86.49271l60.69271,-60.69271v49.22604h17.2v-66.42604l15.52031,-15.52031c1.69569,-1.64828 2.20555,-4.16851 1.28389,-6.3463c-0.92166,-2.17779 -3.08576,-3.56638 -5.44951,-3.49667c-1.48951,0.04438 -2.90324,0.6669 -3.94167,1.73568l-15.52031,15.52031h-66.42604v17.2h49.22604l-60.69271,60.69271v-86.49271c0.03336,-2.32555 -0.87652,-4.56547 -2.52215,-6.20899c-1.64563,-1.64352 -3.88672,-2.55053 -6.21222,-2.51418z"></path></g></g></svg></div>
                                <span>&nbsp; Image cropper</span>
                            </a>
                            <!-- <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        KLP Admin Only
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Klp Catalogue Admin 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        @yield('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ mix('js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{ mix('js/datatables-simple-demo.js') }}"></script>
</html>