<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Profile</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
<a class="btn btn-outline-primary" href="/" style="margin-left: 90%; margin-top:1%">Home</a>

<div class="container" style="display:flex; width:100%; margin: 8% 0 0 23%;">

    <div class="row" style="width:48%">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center">
                    <h3>Profile</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="/profile">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Your Name</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa"
                                                                       aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Enter your Name" value="{{Auth::user()->name}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Your Email</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="email" id="email"
                                           placeholder="Enter your Email" value="{{Auth::user()->email}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button"
                                    style="width:100px; text-align:center;display:block; margin:0 auto;">Change
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row1" style="width:47%">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center">
                    <h3>Profile</h3>
                </div>
                <div class="card-body">

                    <form class="form-horizontal" method="POST" action="/profileUpdateUserPassword">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="old" class="cols-sm-2 control-label">Old Password</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="old_password"
                                           id="old" placeholder="Confirm your Password" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="cols-sm-2 control-label">Password</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="Enter your Password" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           id="confirm" placeholder="Confirm your Password" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button"
                                    style="width:100px; text-align:center;display:block; margin:0 auto;">Change
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row2" style="width:38%">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center">
                    <h3>Add Money To Wallet</h3>
                </div>
                <div class="card-body">

                    <form class="form-horizontal" method="POST" action="/profileUpdateUserMoney">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">Your Money</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa"
                                                                       aria-hidden="true"></i></span>
                                    <input type="number" class="form-control" name="money"
                                            value="{{Auth::user()->money}}" min="{{Auth::user()->money}}"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-lg btn-block login-button"
                                    style=" text-align:center;display:block; margin:0 auto;">Add Money
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    @include ('errors')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
