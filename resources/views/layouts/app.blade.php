<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>@yield('title')</title>
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/dashboard.css')}}" rel="stylesheet">
    @yield('css')
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Septian Company</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
        <form action="/logout" method="POST" id="logout-form">
            @csrf
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <button class="btn nav-link px-3" id="signout-btn">Sign Out</button>
                </div>
            </div>
        </form>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('/') ? 'active': ''}}" aria-current="page" href="/">
                                <span data-feather="home" class="align-text-bottom"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('department/*', 'department') ? 'active': ''}}" href="/department">
                                <span data-feather="package" class="align-text-bottom"></span>
                                Jurusan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('class/*', 'class') ? 'active': ''}}" href="/class">
                                <span data-feather="box" class="align-text-bottom"></span>
                                Kelas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('student/*', 'student') ? 'active': ''}}" href="/student">
                                <span data-feather="users" class="align-text-bottom"></span>
                                Siswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('teacher/*', 'teacher') ? 'active': ''}}" href="/teacher">
                                <span data-feather="users" class="align-text-bottom"></span>
                                Guru
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('lesson/*', 'lesson') ? 'active': ''}}" href="/lesson">
                                <span data-feather="users" class="align-text-bottom"></span>
                                Mata Pelajaran
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('schedule/*', 'schedule') ? 'active': ''}}" href="/schedule">
                                <span data-feather="users" class="align-text-bottom"></span>
                                Jadwal Mengajar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('presence/*', 'presence') ? 'active': ''}}" href="/presence">
                                <span data-feather="users" class="align-text-bottom"></span>
                                Presensi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->is('report/daily') ? 'active': ''}}" href="/report/daily">
                                <span data-feather="bar-chart" class="align-text-bottom"></span>
                                Laporan Harian
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>


    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script>
        feather.replace({
            'aria-hidden': 'true'
        })

        document.getElementById('signout-btn').addEventListener('click', function(e) {
            e.preventDefault()

            if (confirm('Apakah anda yakin ingin logout?')) {
                document.getElementById('logout-form').submit()
            }
        })
    </script>
    @yield('js')
</body>

</html>