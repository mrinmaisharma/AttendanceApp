<nav>
    <div class="navigation-bar">
        <div class="logo col-md-3 col-xs-10 no-padding">
            <a href="/">
                <span class="logo-logo"><span class="c">C</span><span class="f">f</span></span>
                <span class="logo-name"><span class="c1">C</span>onsole <span class="f1">F</span>lare</span>
            </a>
        </div>
        <div class="col-xs-2 vissible-xs-block hidden-lg small-menu-div">
            <span class="toggle-btn pull-right" id="toggleBtn">
                <i class="fas fa-ellipsis-h fa-2x"></i>
            </span>
        </div>
        <div class="col-md-6 hidden-xs hidden-sm no-padding horizontal-list-container" style="display:flex;flex-direction:row;justify-content:center">
            <ul class="unstyled-list no-padding horizontal-list" style="margin:0;">
                <li class="menu-element">
                    <a href="/">Home</a>
                    <span class="underline"></span>
                </li>
                <li class="menu-element">
                    <a href="/courses">Courses</a>
                    <span class="underline"></span>
                </li>
                <li class="menu-element">
                    <a href="/career">Career</a>
                    <span class="underline"></span>
                </li>
<!--
                <li class="menu-element">
                    <a href="/about">About us</a>
                    <span class="underline"></span>
                </li>
-->
                <li class="menu-element">
                    <a href="/contact">Contact us</a>
                    <span class="underline"></span>
                </li>                
            </ul>
        </div>
        <div class="col-md-3 hidden-xs hidden-sm pull-right no-padding horizontal-list-container" style="display:flex;flex-direction:row;justify-content:flex-end">
            <ul class="unstyled-list horizontal-list">
            @if(!isAuthenticated())
                <li class="menu-element">
                    <a href="#" class="faa-parent animated-hover signup-btn" data-toggle="modal" data-target="#login-modal">Sign Up &nbsp; <i class="fas fa-user-edit faa-burst"></i></a>
                </li>
                <li class="menu-element">
                    <a href="#" class="faa-parent animated-hover login-btn" data-toggle="modal" data-target="#login-modal">Log In &nbsp; <i class="fas fa-sign-in-alt faa-burst"></i></a>
                </li>                
            @else
                <li class="user-menu">
                    <div class="dropdown text-right">
                      <button class="btn btn-default dropdown-toggle" type="button" id="userDropDownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <?php $user=\App\Models\User::where('id', \App\Classes\Session::get('SESSION_USER_ID'))->first(); ?>
                        <img src="https://img.icons8.com/color/48/000000/identity-disc.png" width="22"> {{$user->fullname}}
                        &nbsp;&nbsp;&nbsp;
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropDownMenu">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">My Courses</a></li>
                        <li><a href="#">Purchase History</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/logout">Log out</a></li>
                      </ul>
                    </div>
                </li>
            @endif
            </ul>
                
        </div>
    </div>
</nav>

<div id="site-sidebar" class="sidebar">
    <span id="close">
        <i class="fas fa-times fa-lg color-white-transl"></i>
    </span>
    @if(!isAuthenticated())
    <ul>
        <li class="signup-btn"><a href="#" data-toggle="modal" data-target="#login-modal"><i class="fas fa-user-edit"></i> Sign Up</a></li>
        <li class="login-btn"><a href="#" data-toggle="modal" data-target="#login-modal"><i class="fas fa-sign-in-alt"></i> Log In</a></li>
    </ul>
    @else
    <ul>
        <li><a href="#">Profile</a></li>
        <li><a href="#">My Courses</a></li>
        <li><a href="#">Purchase History</a></li>
        <li><a href="/logout">Log Out</a></li>
    </ul>
    @endif
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/courses">Courses</a></li>
        <li><a href="/career">Career</a></li>
<!--        <li><a href="/about">About Us</a></li>-->
        <li><a href="/contact">Contact</a></li>
<!--        <li><a href="/blog">Blog</a></li>-->
    </ul>
</div>

<!--login Modal-->
<div id="login-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content video-modal" style="margin-top:5rem;">
        <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
        <br>
        <div class="wrapper">
          <div class="signup">Sign Up</div>
          <div class="login">Log In</div>

           <form action="/signup" method="post" class="signup-form" data-token="{{\App\Classes\CSRFToken::_token()}}">
              <!--Notification-->
              <div class="text-center" style="display:none;margin-top:-3rem" id="signup_loader"><img style="width:15rem;resize:both;" src="/images/pleasewait2.gif" alt="please wait..."></div>
              <div class="notification alert alert-success" id="signup_notification" role="alert">

              </div>
              <input name="username" type="text" id="username" placeholder="Pick Username" class="input" required><br />
              <input name="fullname" type="text" id="fullname" placeholder="Enter Your Name" class="input" required><br />
              <input name="email" type="email" id="user_email" placeholder="Enter Your Email" class="input" required><br />
              <input name="password" type="password" id="pwd1" pattern="((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$)" title="UpperCase, LowerCase, Number/SpecialChar and min 8 Chars." placeholder="Choose a Password" class="input" required><br />
              <input name="c_password" type="password" id="pwd2" pattern="((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$)" title="UpperCase, LowerCase, Number/SpecialChar and min 8 Chars." placeholder="Confirm Password" class="input" required><br />
              <button type="submit" class="btn">Create account</button>
           </form>

           <form action="/login" method="post" class="login-form" data-token="{{\App\Classes\CSRFToken::_token()}}">
              <!--Notification-->
              <div class="text-center" style="display:none;margin-top:-3rem" id="login_loader"><img style="width:15rem;resize:both;" src="/images/pleasewait2.gif" alt="please wait..."></div>
              <div class="notification alert alert-success" id="login_notification" role="alert">

              </div>              
              <input name="username" type="text" id="login_username" placeholder="Email or Username" class="input" required><br />
              <input name="password" type="password" id="password" pattern="((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$)" title="UpperCase, LowerCase, Number/SpecialChar and min 8 Chars." placeholder="Password" class="input" required><br />
              <input type="checkbox" id="remember" name="remember" value="1"> Remember me
              <button type="submit" class="btn">log in</button>
              <span><a href="/forgot/password" class="lost-password link"><i class="fas fa-key"></i> Lost Password?</a></span>
           </form>
           
           <form action="" style="display:none;" method="post" class="forgot-pwd" data-token="{{\App\Classes\CSRFToken::_token()}}">
              <!--Notification-->
              <h3 class="text-center">Forgot Password</h3>
              <br/>
              <div class="text-center" style="display:none;margin-top:-3rem" id="forgot_loader"><img style="width:15rem;resize:both;" src="/images/pleasewait2.gif" alt="please wait..."></div>
              <div class="notification alert alert-success" id="forgotPwd_notification" role="alert">

              </div>              
              <p class="text-center">Enter your email/username and we'll send you a link to reset your password</p>
              <input name="username" type="text" id="reset_username" placeholder="Email or Username" class="input" required><br />
              <button type="submit" class="btn">Send Email</button>
              <span class="login-btn link"><i class="fas fa-key"></i> Login</span>
           </form>

        </div>
    </div>
  </div>
</div>

<div class="preloader">
    <img src="/images/preloader.gif" style="width: 200px; resize: both;" alt="loading...">
</div>