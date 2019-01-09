<?php
    session_start();
    if(isset($_SESSION["user_id"])){
        header("location:profile.php");
    }
?>
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
                <li><a href="#"><span class="glyphicon glyphicon-home"></span>Home</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-align-justify"></span>Product</a></li>
                <li><form class="navbar-form pull-left">
                        <input type="text" class="form-control" id="search" />
                        <button type="submit" class="btn btn-primary" id="search_btn">Search</button>
                    </form>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>SignIn</a>
                    <ul class="dropdown-menu">
                        <div style="width:300px;">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Login</div>
                                <div class="panel-heading">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" required/>
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" required/>
                                    <p><br></p>
                                    <a href="#" style="color:white; list-style:none;">Forgotten Password</a>
                                    <input type="submit" class="btn btn-success" style="float:right;" id="login" value="Login" />
                                </div>
                                <div class="panel-footer" id="e_msg"></div>
                            </div>
                        </div>
                    </ul>
                </li>
                <li><a href="register.php"><span class="glyphicon glyphicon-user"></span>SignUp</a></li>
            </ul>
        </div>
    </div>
    <p><br></p>
    <p><br></p>
    <p><br></p>
    <p><br></p>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <div id="get_category"></div>
                <div id="get_brands"></div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-warning">
                    <div class="panel-heading">Products</div>
                    <div class="panel-body">
                        <div id="get_products"></div>
                    </div>
                    <div class="panel-footer">&copy; 2018</div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</body>
</html>