<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{--    <link href="./src/output.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/styles.css') }}">
    <link rel="stylesheet" href="{{asset('public/css/icons.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/fonts/vendor/boxicons')}}">
    <link rel="stylesheet" href="{{asset('public/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/boxicons.min.css')}}">
    <link rel="shortcut icon" href="{{ asset('public/images/pcbboard.png') }}" type="image/x-icon">

</head>

<body>
<div class="wrapper">
    <!-- Sidebar -->
    <aside id="sidebar">
        <div class="h-100">
            <div class="sidebar-logo">
                <a href="#" style="font-weight: bold;" class="ms-2">
                    <div class="d-flex justify-content-center">
                    <img src="{{asset('public/images/linecallsys.png')}}" alt="" width="100px">
                    </div>
                    <h5 class="text-center mt-2">Linecall-Production</h5>
                </a>
            </div>
            <hr>
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">

                <li class="sidebar-item" >
                    <a href="{{route('index')}}" class="sidebar-link fs-5" onclick="changePage()" id="li-record">

                        <i class="fa-solid fa-notes-medical fa-lg mx-1 mt-1"></i>
                        บันทึก Linecall-01
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{route('index2')}}" class="sidebar-link  fs-5" id="li-record2" onclick="changePage()">
                        <i class="bi bi-clipboard2-plus-fill h4 mx-1"></i>
                        บันทึก Linecall-02
                    </a>
                </li>
                <li class="sidebar-item" >
                    <a href="{{route('approve')}}" class="sidebar-link fs-5" id="li-approve" onclick="changePage()">
                        <i class="fa-solid fa-square-check fa-lg mx-1 "></i>
                        อนุมัติ Line-call
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{route('rankmaster')}}" class="sidebar-link  fs-5" id="li-rank" onclick="changePage()">
                        <i class="bi bi-person-fill-check h4 mx-1" ></i>
                        สายอนุมัติ (Rank)
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{route('reports')}}" class="sidebar-link  fs-5" id="li-reports" onclick="changePage()">
                        <i class="fa-solid fa-cubes fa-lg mx-1"></i>
                        Reports
                    </a>
                </li>

            </ul>
        </div>
    </aside>
    <!-- Main Component -->
    <div class="main">
        <nav class="navbar navbar-expand px-3 border-bottom">
            <!-- Button for sidebar toggle -->
            <button class="btn" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

        <main class="content px-3 py-2">

            @yield('content')
        </main>
    </div>
</div>

<script src="{{asset('public/js/app.js') }}"></script>
<script src="{{asset('public/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('public/js/datatables.min.js')}}"></script>
<script src="{{asset('public/js/all.min.js')}}"></script>
<script>
    const toggler = document.querySelector(".btn");
    toggler.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("collapsed");
    });


    function changePage() {
        Swal.fire({
            title: "Loading...",
            icon: "info",
            showConfirmButton: false,

            willOpen: () => {
                Swal.showLoading();
            },
        });
    }

</script>
@stack('script_content')


</body>

</html>
