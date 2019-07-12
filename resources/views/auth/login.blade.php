@extends('app')

@section('head_page')
<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/util.css">
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
@endsection

@section('content')


<div class="limiter">
    <div class="container-login100" >
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="assets/images/school-logo.png" alt="IMG">
            </div>




            <form method="POST" action="{{ route('login') }}">
                @csrf
                <span class="login100-form-title">
                    Schoolify
                </span>




                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input id="email" class="input100" type="email" name="email" placeholder="Email">

                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>


                </div>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" style="display:block;margin-left:10px;marign-top:-10px;font-size:14px;">
                        <strong><i class="fa fa-exclamation-triangle" ></i> &nbsp   {{ $errors->first('email') }}</strong>
                    </span>
                    <br />
                @endif

                <div class="wrap-input100 validate-input" data-validate = "Password is required">

                    <input id="password" class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" style="display:block;margin-left:10px;marign-top:-10px;font-size:14px;">
                        <strong><i class="fa fa-exclamation-triangle" ></i> &nbsp   {{ $errors->first('password') }}</strong>
                    </span>
                    <br />
                @endif

                <div class="container-login100-form-btn">
                    <button name="Submit1" class="login100-form-btn">
                        Login
                    </button>
                </div>

                <!-- <div class="text-center p-t-12">
                    <span class="txt1">
                        Forgot
                    </span>
                    <a class="txt2" href="#">
                        Username / Password?
                    </a>
                </div> -->

                <!-- <div class="text-center p-t-136">
                    <a class="txt2" href="#">
                        Create your Account
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div> -->
            </form>


    


        </div>
        <br /> <br /><br /> <br />
    </div>
</div>


@endsection


@section('footer_page')
<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/bootstrap/js/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<script src="assets/js/main.js"></script>

@endsection
