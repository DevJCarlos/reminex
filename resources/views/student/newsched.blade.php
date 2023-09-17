@extends('layouts.guest')

@section('content')
	<div class="main">
		<main class="content">
			<div class="container-fluid p-0">
            <h1 class="h3 mb-3"><strong>Your New Schedule</strong></h1>

                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">No new schedule.</h5>
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