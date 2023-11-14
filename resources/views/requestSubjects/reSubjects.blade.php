@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><strong>{{ __('SUBJECTS for Requests') }}</strong></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card">
						<div class="card-header">
                            <form action="{{ url('/import-csv') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="csv_file" accept=".csv">
                                <button type="submit">Import CSV</button>
                            </form>
						</div>
					</div>
                </div>
                <div class="col-12 col-lg-4">
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body text-danger">

                        <div class="alert alert-info">
                            Subjects Datatable
                        </div>

                            <div class="card">
                                <div class="table-responsive">

                                    <table id="example" class="table table-striped" style="width:100%">
                                        <thead>
                                        <tr>
                                                <th>Course</th>
                                                <th>Subject</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($request_subs as $request_sub)
                                            <tr>
                                                <td>{{ $request_sub->re_courses }}</td>
                                                <td>{{ $request_sub->re_subjects }}</td>
                                            </tr>
                                        @endforeach    
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        </div>
                    </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection