<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Kegiatan Monitoring KPPN Batu Raja</title>

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/css/paper-dashboard.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('assets/css/themify-icons.css')}}" rel="stylesheet">

</head>

<body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>

    <div class="wrapper">
        <div class="sidebar" data-background-color="brown" data-active-color="danger">

            <div class="logo">
                <a href="" class="simple-text logo-mini">
                    KBR
                </a>
                <a href="" class="simple-text logo-normal">
                    KPPN Batu Raja
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    @php
                        $profileUser = app(\App\Http\Controllers\ProfileUserController::class)->index();
                        echo $profileUser;
                    @endphp
                </div>
                <ul class="nav">
                    @yield('sidebar')
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        @yield('title')
                        
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            {{-- <li class="dropdown">
                                <a href="#notifications" class="dropdown-toggle btn-rotate" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <span class="notification">5</span>
                                    <p class="hidden-md hidden-lg">
                                        Notifications
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#not1">Notification 1</a></li>
                                    <li><a href="#not2">Notification 2</a></li>
                                    <li><a href="#not3">Notification 3</a></li>
                                    <li><a href="#not4">Notification 4</a></li>
                                    <li><a href="#another">Another notification</a></li>
                                </ul>
                            </li> --}}
                            <li>
                                <a href="#settings" class="dropdown-toggle btn-rotate" data-toggle="dropdown">
                                    <i class="ti-settings"></i>
                                    <span class="settings"></span>
                                    <p class="hidden-md hidden-lg">
                                        Settings
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                @yield('content')
            </div>

            <footer class="footer">
                <div class="container-fluid"> 
                    <div class="copyright pull-right">
                        &copy; <script>
                            document.write(new Date().getFullYear())
                        </script>, made by <a
                            href="">Tim Mahasiswa UPNVJ</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816"
        integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw=="
        data-cf-beacon='{"rayId":"7bbda5ed8ccd6ba4","version":"2023.3.0","r":1,"token":"1b7cbb72744b40c580f8633c6b62637e","si":100}'
        crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/validateform.js')}}"></script>
<script src="{{asset('js/combo.js') }}" type="text/javascript" ></script>

<script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/perfect-scrollbar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>

<script src="{{asset('assets/js/es6-promise-auto.min.js')}}"></script>

<script src="{{asset('assets/js/moment.min.js')}}"></script>

<script src="{{asset('assets/js/bootstrap-datetimepicker.js')}}"></script>

<script src="{{asset('assets/js/bootstrap-selectpicker.js')}}"></script>

<script src="{{asset('assets/js/bootstrap-switch-tags.js')}}"></script>

<script src="{{asset('assets/js/jquery.easypiechart.min.js')}}"></script>

<script src="{{asset('assets/js/chartist.min.js')}}"></script>

<script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>

<script src="{{asset('assets/js/sweetalert2.js')}}"></script>

<script src="{{asset('assets/js/jquery-jvectormap.js')}}"></script>


<script src="{{asset('assets/js/jquery.bootstrap.wizard.min.js')}}"></script>

<script src="{{asset('assets/js/bootstrap-table.js')}}"></script>

<script src="{{asset('assets/js/jquery.datatables.js')}}"></script>

<script src="{{asset('assets/js/fullcalendar.min.js')}}"></script>

<script src="{{asset('assets/js/paper-dashboard.js')}}"></script>

<script src="{{asset('assets/js/jquery.sharrre.js')}}"></script>

@yield('script')




<script src="{{asset('assets/js/demo.js')}}"></script>
<script>
    // Facebook Pixel Code Don't Delete
    ! function (f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function () {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window,
        document, 'script', '//connect.facebook.net/en_US/fbevents.js');

    try {
        fbq('init', '111649226022273');
        fbq('track', "PageView");

    } catch (err) {
        console.log('Facebook Track Error:', err);
    }
</script>
<noscript>
    <img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
</noscript>
<script type="text/javascript">
    $(document).ready(function () {
        demo.initOverviewDashboard();
        demo.initCirclePercentage();

    });
</script>



    <script type="text/javascript">
        $().ready(function(){
            demo.initFormExtendedDatetimepickers();
        });
    </script>

</html>
