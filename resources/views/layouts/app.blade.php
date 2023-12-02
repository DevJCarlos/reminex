<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" class="rel">

      <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('import/datatablesandplugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('import/datatablesandplugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('import/datatablesandplugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link href="{{asset('import/css/collapse.css')}}" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <!-- <script>
        $(document).ready(function () {
                displaySubjects(subjects); // Call your function to populate the table with data
                $('#subjectsTable').DataTable();
        });

    </script> -->

    <!-- <script>
    $(document).ready(function () {
        $('#subjectsTable').DataTable();
    });
    </script> -->

    
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
        /* Hide all content sections by default */
        .accordion-content {
            display: none;
        }

        /* Style the buttons for better appearance */
        .accordion-button {
            background-color: #f1f1f1;
            color: #333;
            cursor: pointer;
            padding: 10px;
            width: 100%;
            text-align: left;
        }

        /* Style the card body */
        .card-body {
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .scrollable-menu {
            height: auto;
            max-height: 500px;
            overflow-y: auto;
        }


    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STI Gensan Reminex Admin</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('import/img/photos/reminexlogolink.png') }}" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    @yield('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
 

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        @if(auth()->user()->unreadNotifications->isNotEmpty())
                            <span class="badge badge-danger navbar-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right scrollable-menu">
                        @auth
                            @if(auth()->user()->notifications->isNotEmpty())
                                <span class="dropdown-item dropdown-header">{{ auth()->user()->unreadNotifications->count() }} Unread Notifications</span>
                                <div class="notification-container" style="max-height: 500px; overflow-y: auto;">
                                    @foreach (auth()->user()->notifications as $notification)
                                        @if (isset($notification->data['request_id'], $notification->data['request_type']))
                                            @php
                                                $request = App\Models\RequestModel::find($notification->data['request_id']);
                                            @endphp
                                            @if ($request)
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ route('requests') }}" class="dropdown-item @if(!$notification->read_at) bg-secondary @endif" onclick="event.preventDefault(); document.getElementById('mark-as-read-{{ $notification->id }}').submit();">
                                                    <i class="fas fa-envelope mr-2"></i> New {{ $notification->data['request_type'] }}!<br>
                                                    <p class="float-left text-sm">{{ $notification->data['stud_name'] }}: {{ $notification->data['subject'] }}</p>
                                                    <p class="float-right text-sm">{{ $notification->created_at->diffForHumans() }}</p><br>
                                                </a>
                                                <form id="mark-as-read-{{ $notification->id }}" action="{{ route('markAsRead', ['notificationId' => $notification->id]) }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>

                                                @if(!$notification->read_at)
                                                    <!-- Add your unread styling or indicator here -->
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <span class="dropdown-item dropdown-header">No notifications yet.</span>
                            @endif
                        @else
                            <span class="dropdown-item dropdown-header">Please log in to view notifications.</span>
                        @endauth
                    </div>
                </li>

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

        <!-- DataTables  & Plugins -->
        <script src="{{ asset('import/datatablesandplugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('import/datatablesandplugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('import/datatablesandplugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('import/datatablesandplugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('import/datatablesandplugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('import/datatablesandplugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('import/datatablesandplugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('import/datatablesandplugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('import/datatablesandplugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('import/datatablesandplugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('import/datatablesandplugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('import/datatablesandplugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
        <script>
        $(function () {
            $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });
        });
        </script>


        <!-- Modal
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('/home')}}" class="brand-link">
                <img src="{{ asset('import/img/photos/brandicon2.png') }}" width="50" alt="Reminex Logo">
            <span class="logo-text ms-2" style="padding-left: 10px;">
                <!-- dark Logo text -->
                <img
                  src="{{asset('import/img/photos/brandtext.png')}}"
                  alt="homepage"
                  class="light-logo"
                  width="150"
                />
              </span>
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
            <!-- <div class="float-right d-none d-sm-inline">
                Anything you want
            </div> -->
            <!-- Default to the left -->
            <!-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved. -->
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
       //checbox function for rooms
       document.getElementById('selectAllRooms').addEventListener('change', function () {
            var checkboxes = document.querySelectorAll('.listCheckbox1');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = this.checked;
            }
            addRooms();
        });

        var checkboxes = document.getElementsByClassName('listCheckbox1');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', function () {
                addRooms();
            });
        }

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
