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

    <title>Customer Order</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <style>
        table td,tr{
            padding:10px;
        }
    </style>
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
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <h1>Customer Order Details</h1>
                        <hr/>
                        <div class="row">
                            <div class="col-md-6">
                                <img style="float:right;" src="product_images/a3.jpg" alt="" class="img-thumbnail">
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr> <td>Product Name</td> <td><b>acer phone</b></td> </tr>
                                    <tr> <td>Product Price</td> <td><b>$5000</b></td> </tr>
                                    <tr> <td>Quantity</td> <td><b>3</b></td> </tr>
                                    <tr> <td>Payment</td> <td><b>Completed</b></td> </tr>
                                    <tr> <td>Transaction ID</td> <td><b>BLD0923-75676</b></td> </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</body>
</html>