@extends('layouts.guest')

@section('content')
	<div class="main">
		<main class="content">
			<div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Create Request</strong></h1>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                               @include('student.partials.request-form')
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                    <div class="mt-3">
                        @if ($errors->any())
                            <div class="col-12">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{$error}}</div>                               
                                @endforeach
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>                       
                        @endif

                        @if (session()->has('success'))
                            <div class="alert alert-success">{{session('success')}}</div>                       
                        @endif
                    </div>
                </div>					
                </div>

			</div>
		</main>
	</div>

<script src="{{asset('import/js/app.js')}}"></script>
<script src="{{asset('import/js/fileInput.js')}}"></script>
<script src="{{asset('import/js/requesttype.js')}}"></script>

</body>
@endsection