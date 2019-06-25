@extends('app.layout.base')
@section('title', 'Profile')


@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center mb-4">
                        <img class="mr-3" src="/images/avatar/default.png" width="80" height="80" alt="">
                        <div class="media-body">
                            <h3 class="mb-0">Master User</h3>
                            <p class="text-muted mb-0">admin</p>
                        </div>
                    </div>
                    
                    <div class="row mb-5">
                        <div class="col">
                            <div class="card card-profile text-center">
                                <span class="mb-1 text-warning"><i class="icon-grid"></i></span>
                                <h3 class="mb-0">{{count($batches)}}</h3>
                                <p class="text-muted">Batches</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-profile text-center">
                                <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                <h3 class="mb-0">{{count($students)}}</h3>
                                <p class="text-muted px-4">Students</p>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-danger px-5">Edit Profile</button>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <table>
                        <tr>
                            <td><strong class="text-dark mr-4">Mobile</strong></td>
                            <td width="25">:</td>
                            <td>01793931609</td>
                        </tr>
                        <tr>
                            <td><strong class="text-dark mr-4">Email</strong></td>
                            <td width="25">:</td>
                            <td>name@domain.com</td>
                        </tr>
                        <tr>
                            <td><strong class="text-dark mr-4">Username</strong></td>
                            <td width="25">:</td>
                            <td>masteruser</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="#" method="post">
                        <h4 style="color: inherit;"><strong>Change Password</strong></h4>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-old-password">Current Password <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="oldPassword" required placeholder="Enter your current password.">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-password">New Password <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="val-password" required placeholder="Choose a safe one..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-confirm-password">Confirm Password <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="confirmPassword" required placeholder="Confirm new password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection