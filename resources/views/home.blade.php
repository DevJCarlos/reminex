@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route('upload.csv') }}" enctype="multipart/form-data">
                    @csrf
                    <br>
                    <br>
                    <div class="mb-3 form-group">
                        <label for="matrix" class="form-label">Upload Matrix</label>
                        <input type="file" class="form-control-file" id="matrix" name="matrix" accept=".csv">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>
                    
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection