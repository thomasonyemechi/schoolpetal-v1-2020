<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('favicon.png')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
  <div class="main main-without-topbar bg-light">
    <section class=" ptb-100 height-lg-100vh d-flex align-items-center"  style="background-color:" >
        <div class="container">
            <div class="row justify-content-center pt-5 pt-sm-5 pt-md-5 pt-lg-0">
                <div class="col-md-12 col-lg-8">

                        <div class=" card card-body px-md-5 py-5">
                            <!-- <div class="logo row justify-content-center">
             <img src="petal/assets/images/lp.png" alt="logo">
                            </div> -->
                            <h4 class="font-medium m-b-10" style="font-weight: bolder">Create Your School Account <br></h4>
                            <!-- Form -->
                    <div class="row">

                        <div class="col-12">
                            @include('inc.message')
                            <x-jet-validation-errors class="mb-4" />
                            <form action="{{route('register')}}"  method="post">


                              @csrf
                                <div class="form-group row ">
                                    <div class="col-md-6 ">
                                        <input class="form-control form-control" type="text" placeholder="School Name" name="name" style="border-color: #CCC;">
                                    </div>

                                    <div class="col-md-6 ">
                                        <input class="form-control form-control" type="text" name="manager" placeholder="Nickname Of School">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-md-6 ">
                                        <input class="form-control form-control" type="number" placeholder="School Phone" name="phone" style="border-color: #CCC;">
                                    </div>

                                    <div class="col-md-6 ">
                                        <input class="form-control form-control" type="number" name="phone2" placeholder="Additional Phone ">
                                    </div>
                                </div>

                                <div class="form-group row">
                                     <div class="col-md-6 ">
                                       <input type="text" name="city" id="city" placeholder="city" class="form-control form-control">

                                    </div>


                                    <div class="col-md-6 ">
                                       <input class="form-control form-control" type="text" placeholder="School Address" name="address">
                                    </div>
                                </div>
                                <div class="form-group row">
                                     <div class="col-md-12">
                                       <input type="text" name="website" placeholder="School Website" class="form-control form-control">

                                    </div>


                                    <div class="col-md-12 pt-3">
                                       <input class="form-control form-control" type="text" placeholder="Motto" name="motto">
                                    </div>
                                </div>

                                <b>Login Information</b><hr>
                                <div class="form-group row ">
                                    <div class="col-md-12 ">
                                        <input class="form-control form-control" type="email" placeholder="Email" name="email" id="usernamex">
                                        <div id="output2"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 ">
                                        <input class="form-control" type="password" placeholder="Password" name="password" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers">
                                    </div>

                                    <div class="col-md-6 ">
                                        <input class="form-control" type="password" required placeholder="Confirm Password" name="password_confirmation" title="Please enter the same Password as above">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 ">
                                        <!--<div class="custom-control custom-checkbox">-->
                                        <!--    <input type="checkbox" class="custom-control-input" id="customCheck1">-->
                                        <!--    <label class="custom-control-label" for="customCheck1" required>I agree to the <a href="terms.php" target="blank">Terms & Condition</a></label>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                                <div class="form-group text-center ">
                                    <div class="col-xs-12 p-b-20 pt-4">
                                        <button class="btn btn-block btn-lg btn-primary" type="submit">Create Account</button>
                                    </div>
                                </div>



                                <div class="form-group m-b-0 m-t-10 ">
                                    <div class="col-sm-12 text-center ">
                                        Already have an account? <a href="login" class="text-primary m-l-5 "><b>Login</b></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
  <!-- /.register-box -->
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>




{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>


    </x-jet-authentication-card>
</x-guest-layout> --}}
