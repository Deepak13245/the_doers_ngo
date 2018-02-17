<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Doers</title>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="{{ asset('login_reg_js.js')  }}"></script>

    <!------ Include the above in your HEAD tag ---------->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{ asset('login_reg_css.css') }}">
    <link rel="icon" href="{{ asset('favicon.png') }}">
</head>
<body>
<div class="text-center" style="position: relative;top:-60px;font-size: 48px;">
    <img src="{{ asset('favicon.png') }}" alt="LOGO" height="48"> The Doers <br>
    <span style="font-size: small;font-weight: bold;position: relative;top:-48px;left:24px;">NGOs and The Doers Listing</span>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Register</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('message'))
                        <div class="alert alert-{{ session()->get('type') }}">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="{{ url('login') }}" method="post" role="form"
                                  style="display: block;">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control"
                                           placeholder="Email" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2"
                                           class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group text-center">
                                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                    <label for="remember"> Remember Me</label>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                                                   class="form-control btn btn-login" value="Log In">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                {{--                                                <a href="https://phpoll.com/recover" tabindex="5"
                                                                                                   class="forgot-password">Forgot Password?</a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form id="register-form" action="{{ url('sign-up') }}" method="post"
                                  role="form" style="display: none;">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="name" id="name" tabindex="1" class="form-control"
                                           placeholder="Name" value="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control"
                                           placeholder="Email Address" value="">
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="phone" id="phone" tabindex="1" class="form-control"
                                           placeholder="Phone Number" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2"
                                           class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm_password" id="confirm_password" tabindex="2"
                                           class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="address" id="address" tabindex="2" class="form-control"
                                           placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="city" id="city" tabindex="2" class="form-control"
                                           placeholder="City">
                                </div>
                                <div class="form-group">
                                    <select name="category_id" id="category" tabindex="2" class="form-control">
                                        <option value="category">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select name="interest_id" id="areaofinterest" tabindex="2" class="form-control">
                                        <option value="-1">Select Area Of Interest</option>
                                        @foreach($interests as $interest)
                                            <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit"
                                                   tabindex="4" class="form-control btn btn-register"
                                                   value="Register Now">
                                        </div>
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
</body>
</html>