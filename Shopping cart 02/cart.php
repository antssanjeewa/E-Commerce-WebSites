<?php
    session_start();
    if(!isset($_SESSION["user_id"])){
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

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
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION["user_name"];?></a>
                    <ul class="dropdown-menu">
                        <li><a href="cart.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                        <li class="divider"></li>
                        <li><a href="#" style="text-decoration:none; color:blue;">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php" style="text-decoration:none; color:blue;">Log Out</a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <p><br></p>
    <p><br></p>
    <p><br></p>
    <p><br></p>
    <div class="container-fluid">
        <!--div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" id="alert_msg">
            </div>
            <div class="col-md-2"></div>
        </div-->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div id="deleteMsg"></div>
                <div class="panel panel-primary">
                    <div class="panel-heading">Cart Checkout</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2"><b>Product Name</b></div>
                            <div class="col-md-2"><b>Product Image</b></div>
                            <div class="col-md-2"><b>Product Price</b></div>
                            <div class="col-md-2"><b>Quentity</b></div>
                            <div class="col-md-2"><b>Total Price</b></div>
                            <div class="col-md-2"><b>Action</b></div>
                        </div>
                        <div id="cartcheckout"></div>
                    </div>
                    <div class="panel-footer">&copy; 2018</div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</body>
</html>