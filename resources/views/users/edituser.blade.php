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
                <div class="col-4">
                    <div>
                        <form action="#" method="POST">
                            @csrf
                            @method('post')

                            <div class="card-body">
                                <h4>Update User</h4><br>

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
                                <input type="submit" class="btn btn-primary" value="Add Admin">
                                </div>
                            </div>
                        </form>
                    </div>
            </div><br>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection