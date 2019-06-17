@if(isset($errors) && count($errors) || \App\Classes\Session::has('error'))
   <?php //var_dump($_SESSION['EMAIL_VERIFY_OTP']);exit; ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <button class="close" data-dismiss="alert" aria-label="close" style="font-size:1.6rem;color:#000">&times;</button>
        <strong>Error!</strong>
        @if(\App\Classes\Session::has('error'))
           <?php echo \App\Classes\Session::flash('error'); ?>
        @else
           @foreach($errors as $error_array)
               @foreach($error_array as $error_item)
                   {{$error_item}} <br/>
               @endforeach
           @endforeach
        @endif
    </div>
@elseif(isset($success) || \App\Classes\Session::has('success'))
<div class="alert alert-success alert-dismissible fade show">
        <button class="close" data-dismiss="alert" aria-label="close" style="font-size:1.6rem;color:#000">&times;</button>
        <strong>Success!</strong>
        @if(isset($success))
           {{$success}}
        @elseif(\App\Classes\Session::has('success'))
           {{\App\Classes\Session::flash('success')}}
        @endif
    </div>
@endif