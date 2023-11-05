@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><strong>{{ __('Users') }}</strong></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12 col-lg-4">
                    <div>
                        <form action="{{route ('createadmin')}}" method="POST">
                            @csrf
                            @method('post')
                            <div class="card">
                            <div class="card-body">
                                <h4>Add User</h4><br>

                                <div class="form-group row">
                                <label for="aidn" class="col-sm-3 text-end control-label col-form-label">User IDN</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="aidn" name="username"  placeholder="IDN Here" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                <label for="aname" class="col-sm-3 text-end control-label col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="aname" name="name" placeholder="Lastname Here" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                <label for="aidn" class="col-sm-3 text-end control-label col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="aidn" name="email"  placeholder="Email Here" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                <label for="adep" class="col-sm-3 text-end control-label col-form-label">Department</label>
                                <div class="col-sm-9">
                                    <select class="select2 form-select shadow-none" style="width: 100%; height: 36px" name="department" required>          
                                        <option disabled selected>Select Department...</option>
                                        <option>Academic Head</option> 
                                        <option>ICT Department</option>    
                                        <option>CS/BMMA</option>      
                                        <option>Hospitality Management</option>
                                        <option>Tourism Management</option>
                                        <option>BSA Department</option>
                                        <option>BSBA Department</option>
                                        <option>GE</option>
                                        <option>SHS</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                <label for="apass" class="col-sm-3 text-end control-label col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="apass" name="password" placeholder="Password Here" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                <label for="arole" class="col-sm-3 text-end control-label col-form-label">Role</label>
                                    <div class="col-sm-9">
                                    <select class="select2 form-select shadow-none" style="width: 100%; height: 36px" name="role" required>          
                                        <option disabled selected>Select Role...</option>
                                        <option>admin</option> 
                                        <option>teacher</option>    
                                        <option>student</option>
                                    </select>
                                    </div>
                                </div>
                                
                            </div>  
                            
                            <div class="border-top">
                                <div class="card-body">
                                <input type="submit" class="btn btn-primary" value="Add Users">
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <form action="/upload" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <div class="card-body">
                                <h4>Upload CSV (for many users)</h4><br>

                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <input type="file" id="fileInput" name="file" accept=".csv" onchange="displayFileName()">
                                            <label for="fileInput" class="custom-file-input">Choose CSV File</label>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <input type="submit" class="btn btn-secondary" value="Submit">
                                </div>
                            </div>
                        </form>
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
            </div><br>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body text-danger">

                        <div class="alert alert-info">
                            Users Datatable
                        </div>

                            <div class="card">
                                <div class="table-responsive">

                                    <table id="example" class="table table-striped" style="width:100%">
                                        <thead>
                                        <tr>
                                                <th>ID Number</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->name }}</td>  
                                                <td>{{ $user->department }}</td>  
                                                <td>{{ $user->email }}</td>   
                                                <td>{{ $user->password }}</td>  
                                                <td>{{ $user->role }}</td> 
                                                <td>
                                                    <a href="#"
>
                                                        <input type="submit" class="btn btn-primary" value="Edit">
                                                    </a>

                                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                                    </form>


                                                </td> 
                                            </tr>
                                        @endforeach    
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->

                                    <div class="card-footer clearfix">
                                        {{ $users->links() }}
                                    </div>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection