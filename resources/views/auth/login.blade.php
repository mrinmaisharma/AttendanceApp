@extends('auth.layout.base')
@section('title', 'Log In')

@section('data-page-id', 'login')

@section('content')

<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <a class="text-center" href="index.html"> <h4>Nextwing infotech</h4></a>
                            <form id="login-form" class="mt-5 mb-5 login-input" data-token="{{\App\Classes\CSRFToken::_token()}}">
                                <div class="col-md-12">
                                    @include('includes.form_alert')
                                </div>
                                <div class="text-center" style="display:none;" id="login_loader"><img style="height:20px;resize:both;" src="/images/loader.gif" alt="please wait..."></div>
                                <div class="notification alert alert-success" style="display:none" id="login_notification" role="alert">

                                </div>
                                <div class="form-group">
                                    <input type="text" required autocomplete="off" id="login_username" name="username" class="form-control" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" required id="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <button type="submit" class="btn login-form__btn submit w-100">Sign In</button>
                            </form>
                            <p class="mt-5 login-form__footer">Powered by: <a href="https://www.arbre.in" class="text-primary"><strong>Arbre Creations</strong></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection