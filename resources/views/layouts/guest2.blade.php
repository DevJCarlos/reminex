<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">


    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{asset('import/img/photos/ReminExlogolink3.png')}}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>ReminEx Faculty</title>

	<link href="{{asset('import/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('import/css/collapse.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"> 

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="hold-transition">
    <header>
        {{-- @auth --}}
            @include('layouts.partial.guest-nav2')
            
        {{-- @endauth --}}
    </header>
    
    <div class="wrapper">
        @include('layouts.partial.side-nav2')
        @yield('content')
    </div>
    

    


@vite([
    'resources/js/app.js',
    'resources/js/collapse.js'
])

<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>
<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css"> 
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function () {
        $('#userTable').DataTable();
    });
</script>

</body>
</html>
