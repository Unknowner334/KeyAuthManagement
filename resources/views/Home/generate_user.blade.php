@extends('Layout.app')

@section('title', 'Users')

@section('content')
    <div class="col-lg-6">
        @include('Layout.msgStatus')
        <div class="card shadow-sm mb-5">
            <div class="card-header text-center text-white bg-danger">
                Users Registering
            </div>
            <div class="card-body">
                <form action={{ route('admin.users.generate.post') }} method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required placeholder="Name">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required placeholder="Username">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required placeholder="Password">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Password">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">-- Select Status --</option>
                                    <option value="Active" class="text-success" selected>Active</option>
                                    <option value="Inactive" class="text-danger">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="">-- Select Role --</option>
                                    <option value="Owner" class="text-danger">Owner</option>
                                    <option value="Manager" class="text-warning">Manager</option>
                                    <option value="Reseller" class="text-primary" selected>Reseller</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-outline-danger">Register User</button>
                    </div>
                </form>
            </div>
        </div>
        <p class="text-muted text-center">
            <a href="{{ route('admin.users') }}" class="py-1 px-2 bg-white text-muted"><small><i class="bi bi-arrow-left"></i> Back to Users</small></a>
        </p>
    </div>
@endsection