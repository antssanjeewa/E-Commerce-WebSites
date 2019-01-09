<?php 
    include "connection.php";
    session_start();
    
    if(isset($_POST["category"])){
        $category_query = "SELECT * FROM categories";
        $run_query = mysqli_query($connection, $category_query);
        echo '<div class="nav nav-pills nav-stacked">
            <li class="active"><a href="#"><h4>Categories</h4></a></li>';
        if(mysqli_num_rows($run_query) > 0){
            while($row = mysqli_fetch_array($run_query)){
                $cat_id = $row['id'];
                $cat_name = $row['category_name'];
                echo "<li><a href='#' class='category' cid='$cat_id'>$cat_name</a></li>";
            }
            echo '</div>';
        }
    }

    if(isset($_POST["brands"])){
        $brands_query = "SELECT * FROM brands";
        $run_query = mysqli_query($connection, $brands_query);
        echo '<div class="nav nav-pills nav-stacked">
            <li class="active"><a href="#"><h4>Brands</h4></a></li>';
        if(mysqli_num_rows($run_query) > 0){
            while($row = mysqli_fetch_array($run_query)){
                $brand_id = $row['id'];
                $brand_name = $row['brand_name'];
                echo "<li><a href='#'class='brand' bid='$brand_id'>$brand_name</a></li>";
            }
            echo '</div>';
        }
    }

    if(isset($_POST['page'])){
        $sql = "SELECT * FROM product";
        $run_query = mysqli_query($connection, $sql);
        $totalpage = mysqli_num_rows($run_query);
        $page = ceil($totalpage / 6);
        for($i=1;$i<= $page; $i++){
            echo "<li><a href='#' id='page' pageno='$i'>$i</a></li>";
        }
    }

    if(isset($_POST["products"]) || isset($_POST["get_select_category"]) || isset($_POST["get_select_brand"]) || isset($_POST["search"])){
        $limit = 6;
        if(isset($_POST['setpage'])){
            $pageno = $_POST['pagenumber'];
            $start = ($pageno - 1) * $limit;
        }else{
            $start = 0;
        }
        
        if(isset($_POST["get_select_category"])){
            $cid = $_POST['cat_id'];
            $products_query = "SELECT * FROM product WHERE category='$cid' LIMIT $start,$limit";
        }else if(isset($_POST["get_select_brand"])){
            $bid = $_POST['brand_id'];
            $products_query = "SELECT * FROM product WHERE brand='$bid' LIMIT $start,$limit";
        }else if(isset($_POST["search"])){
            $keywords = $_POST['keywords'];
            $products_query = "SELECT * FROM product WHERE key_words LIKE '%$keywords%' LIMIT $start,$limit";
        }else{
            $products_query = "SELECT * FROM product LIMIT $start,$limit";
        }
        $run_query = mysqli_query($connection, $products_query);
        if(mysqli_num_rows($run_query) > 0){
            while($row = mysqli_fetch_array($run_query)){
                $pid = $row['id'];
                $product_name = $row['product_name'];
                $price = $row['price'];
                $image = $row['image'];
                $details = $row['details'];
                $category = $row['category'];
                echo "
                <div class='col-md-4'>
                    <div class='panel panel-info'>
                        <div class='panel-heading'>$product_name</div>
                        <div class='panel-body'>
                            <img src='product_images/$image' alt='image1' style='width:100%; height:250px;'/>
                        </div>
                        <div class='panel-heading'>$ $price
                            <button pid='$pid' style='float:right;' id='product' class='btn btn-danger btn-xs'>AddToCart</button>
                        </div>
                    </div>
                </div>
                ";
            }
        }
    }

    if(isset($_POST["Addtocart"])){
        $pid = $_POST["pid"];
        $user_id = $_SESSION["user_id"];

        $sql = "SELECT * FROM cart WHERE product_id='$pid' AND user_id='$user_id' ";
        $run_query = mysqli_query($connection, $sql);
        if(mysqli_num_rows($run_query) > 0){
            echo "
                <div class='alert alert-danger'>
                    <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>This Product also added to the Cart</b>
                </div>
            ";
           exit();
        }else{
            $sql = "SELECT * FROM product WHERE id='$pid' ";
            $run_query = mysqli_query($connection, $sql);
            $row = mysqli_fetch_array($run_query);
            $product_name = $row['product_name'];
            $product_image = $row['image'];
            $price = $row['price'];

            $ip_address = "192.168.40.10";
            
            $quantity = 1;
            $total_price = $quantity * $price;

            $sql = "INSERT INTO cart (product_id, ip_address, user_id, product_name, product_image, price, quantity, total_price)
             VALUES ('$pid', '$ip_address', '$user_id', '$product_name', '$product_image', '$price', '$quantity', '$total_price')";
            $run_query = mysqli_query($connection, $sql);
            if($run_query){
                echo "
                <div class='alert alert-success'>
                    <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Success Add Product To Cart...!</b>
                </div>
            ";
            }
        }
    }

    if(isset($_POST["cartlist"]) || isset($_POST["cartcheckout"])){
        $user = $_SESSION["user_id"];
        $sql = "SELECT * FROM cart WHERE user_id='$user' ";
        $run_query = mysqli_query($connection, $sql);
        if(mysqli_num_rows($run_query) > 0){
            $number = 1;
            $total_price = 0;
            while($row = mysqli_fetch_array($run_query)){
                $id = $row['product_id'];
                $name = $row['product_name'];
                $image = $row['product_image'];
                $price = $row['price'];
                $quantity = $row['quantity'];
                $total = $price * $quantity;
                $total_price = $total_price + $total;

                if(isset($_POST["cartlist"])){
                    echo "<div class='row'>
                            <div class='col-md-3'>$number</div>
                            <div class='col-md-3'>
                                <img src='product_images/$image' alt='image1' style='width:100%;'/>
                            </div>
                            <div class='col-md-3'>$name</div>
                            <div class='col-md-3'>$ $price</div>
                        </div>";
                    $number = $number + 1;
                }else{
                    echo "
                        <div class='row'>
                            <div class='col-md-2'>$name</div>
                            <div class='col-md-2'><img src='product_images/$image' alt='' width='50px' height='60px'/></div>
                            <div class='col-md-2'>
                                <input type='text' class='form-control' id='price-$id' value='$price' disabled/>
                            </div>
                            <div class='col-md-2'>
                                <input type='number' class='form-control qty' pid='$id' id='qty-$id' value='$quantity' />
                            </div>
                            <div class='col-md-2'>
                                <input type='text' class='form-control' id='total-$id' value='$total' disabled/>
                            </div>
                            <div class='col-md-2'>
                                <div class='btn-group'>
                                    <a href='#' update_id='$id' class='btn btn-primary update'><span class='glyphicon glyphicon-ok-sign'></span></a>
                                    <a href='#' delete_id='$id' class='btn btn-danger delete'><span class='glyphicon glyphicon-trash'></span></a>
                                </div>
                            </div>
                        </div>
                    ";
                }
            }
            if(isset($_POST["cartcheckout"])){
                echo "<div class='row'>
                        <div class='col-md-8'></div>
                        <div class='col-md-4'>Total Price: $$total_price</div>
                    </div>";
            }
        }
    }

    if(isset($_POST["deletecart"])){
        $pid = $_POST['deleteid'];
        $user = $_SESSION["user_id"];

        $sql = "DELETE FROM cart WHERE user_id='$user' AND product_id='$pid' ";
        $run_query = mysqli_query($connection, $sql);
        if($run_query){
            echo "
                <div class='alert alert-success'>
                    <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>This Product Removed From Cart</b>
                </div>
            ";
           exit();
        }else{
            echo "
                <div class='alert alert-danger'>
                    <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Error....!</b>
                </div>
            ";
            exit();
        }
    }

    if(isset($_POST["updatecart"])){
        $pid = $_POST['updateid'];
        $qty = $_POST['quantity'];
        $total = $_POST['total'];
        $user = $_SESSION["user_id"];

        $sql = "UPDATE cart SET quantity='$qty', total_price='$total' WHERE user_id='$user' AND product_id='$pid' ";
        $run_query = mysqli_query($connection, $sql);
        if($run_query){
            echo "
                <div class='alert alert-success'>
                    <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>This Product is Updated.</b>
                </div>
            ";
           exit();
        }else{
            echo "
                <div class='alert alert-danger'>
                    <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>ERROR......!</b>
                </div>
            ";
            exit();
        }
    }

    if(isset($_POST['cart_count'])){
        $user = $_SESSION["user_id"];
        $sql = "SELECT * FROM cart WHERE user_id='$user' ";
        $run_query = mysqli_query($connection, $sql);
        $count = mysqli_num_rows($run_query);
        echo "$count";
    }
?>