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
                        <div class="card">
                            <div class="card-body">
                            </div>
                        </div>
                    </div>				
                </div>

			</div>
		</main>
	</div>
@endsection

@section('scripts')
<script src="{{asset('import/js/app.js')}}"></script>
@endsection