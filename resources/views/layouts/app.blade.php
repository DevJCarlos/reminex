<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    
    
    <style>

        div[id="gentab_length"] {
            margin-right: 500px;
            
        }
        div[id="gentab_filter"] {
            margin-left: 500px;
            
        }
        .accordion {
            display: flex;
            flex-direction: column;
            width: auto;
            margin: 0 auto;
        }

        .accordion-item {
            border: none;
            margin-bottom: 10px;
            overflow: hidden;
        }

        .accordion-header {
            background-color: #f0f0f0;
            padding: 10px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            font-weight: bold;
        }

        .accordion-arrow {
            transition: transform 0.2s ease-in-out;
        }

        .accordion-content {
            padding: 10px;
            display: none;
        }

        .subject-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            list-style: none;
        }

        .subject-item {
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        p {
            text-align: center;
        }

        .room-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .room-item {
            display: flex;

        }

        .customcheckbox {
            display: inline-block;
            margin-right: 10px;
            
            position: relative;
            cursor: pointer;
            user-select: none;
        }
   
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    @yield('styles')


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                        <a href="{{ route('profile.show') }}" class="dropdown-item">
                            <i class="mr-2 fas fa-file"></i>
                            {{ __('My profile') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="mr-2 fas fa-sign-out-alt"></i>
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            @include('layouts.navigation')
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->

        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    

    <!-- REQUIRED SCRIPTS -->

    @vite('resources/js/app.js')
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}" defer></script>

    @yield('scripts')

    <script>

          //datatable
        //   $(document).ready(function () {
        // $('#gentab').dataTable({

        // });
        // });
   

        //accordion functions(dropdown)
        document.addEventListener("DOMContentLoaded", function() {
            const accordionItems = document.querySelectorAll(".accordion-item");

            accordionItems.forEach(item => {
                const header = item.querySelector(".accordion-header");
                const content = item.querySelector(".accordion-content");
                const arrow = item.querySelector(".accordion-arrow");

                header.addEventListener("click", () => {
                    content.style.display = content.style.display === "none" ? "block" : "none";
                    arrow.style.transform = content.style.display === "none" ? "rotate(0deg)" :
                        "rotate(180deg)";
                });
            });
        });

        
        //Search and chekboxes
        var searchColumnSelect = document.getElementById('searchProgram');

        
        searchColumnSelect.addEventListener('change', function () {
            
            var selectedProgram = searchColumnSelect.value;

            
            for (var i = 0; i < tableRows.length; i++) {
                var row = tableRows[i];
                var programColumn = row.querySelector('td:nth-child(3)'); 

                if (selectedProgram === '--Select Program--' || programColumn.textContent === selectedProgram) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
        var searchColumnSelectyear = document.getElementById('searchYear');

        
        searchColumnSelectyear.addEventListener('change', function () {
            
            var selectedYear = searchColumnSelectyear.value;

            
            for (var i = 0; i < tableRows.length; i++) {
                var row = tableRows[i];
                var YearColumn = row.querySelector('td:nth-child(4)'); 

                if (selectedYear === '--Select Year--' || YearColumn.textContent === selectedYear) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });


        //searchbar & checkbox Section
        var searchInput = document.getElementById('searchInput');
        var tableRows = document.querySelectorAll('#subjects tbody tr');
        searchInput.addEventListener('input', function() {
            var searchText = searchInput.value.toLowerCase();

            for (var i = 0; i < tableRows.length; i++) {
                var row = tableRows[i];
                var rowData = row.innerText.toLowerCase();

                if (rowData.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    </script>

</body>

</html>
