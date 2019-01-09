<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="main.js"></script>

</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">ANTS Shop</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-align-justify"></span>Product</a></li>
            </ul>
        </div>
    </div>
    <p><br></p>
    <p><br></p>
    <p><br></p>
    <p><br></p>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" id="alert_msg">
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">Customer Login Form</div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="f_name">Frist Name</label>
                                    <input type="text" class="form-control" id="f_name" name="f_name" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="l_name">Last Name</label>
                                    <input type="text" class="form-control" id="l_name" name="l_name" required/>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" />
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" />
                                </div>
                                <div class="col-md-6">
                                    <label for="re_password">Re Enter Password</label>
                                    <input type="password" class="form-control" id="re_password" name="re_password" />
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" />
                                </div>
                                <div class="col-md-6">
                                    <label for="bday">Birth Day</label>
                                    <input type="date" class="form-control" id="bday" name="bday" />
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="button" style="float:right;" class="btn btn-success btn-lg" id="signup" name="signup" value="Sign Up"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">&copy; 2018</div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</body>
</html>