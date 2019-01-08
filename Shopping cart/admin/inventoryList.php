<?php session_start();
	
	if(!isset($_SESSION["manager"])){
		header("location: index.php");
		exit();
	}
	require_once('../inc/connection.php');
	
?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<?php 
if(isset($_GET['deleteid'])){
	$id = $_GET['deleteid'];
	echo "Do You Want delete ID ".$id."?. <a href='inventoryList.php?deletedid=".$id."'>Yes</a> | <a href='inventoryList.php'>No</a>";
	exit();
}
if(isset($_GET['deletedid'])){
	$deleteid = $_GET['deletedid'];
	$sql = mysqli_query($connection,"DELETE FROM product WHERE id='$deleteid' LIMIT 1") or die (mysqli_error());
	
	$piclocation = ("../inventory_images/$deleteid.jpg");
	if(file_exists($piclocation)){
		unlink($piclocation);
	}
	header("location: inventoryList.php");
	exit();
}
?>
<?php 
if(isset($_POST['product_name'])){
	$product_name = mysqli_real_escape_string($connection,$_POST['product_name']);
	$price = mysqli_real_escape_string($connection,$_POST['price']);
	$category = mysqli_real_escape_string($connection,$_POST['category']);
	$subcategory = mysqli_real_escape_string($connection,$_POST['subcategory']);
	$details = mysqli_real_escape_string($connection,$_POST['details']);	
	
	$sql = mysqli_query($connection,"SELECT id FROM product WHERE product_name = '$product_name' LIMIT 1");
	$productMatch = mysqli_num_rows($connection,$sql);
	if($productMatch > 0){
		echo "You Have duplicate Product Name";
		exit();	
	}
	$sql = mysqli_query($connection,"INSERT INTO product (product_name, price, details, category, subcategory, date_added) VALUES('$product_name','$price','$details','$category','$subcategory',now())") or die(mysql_error());
	$pid = mysqli_insert_id();
	$newname = "$pid.jpg";
	move_uploaded_file($_FILES['fileField']['tmp_name'],"../inventory_images/$newname");
	header("location: inventoryList.php");
	exit();
}
?>
<?php
	
	$product_list = "";
	$quary = "SELECT * FROM product";
	$sql = mysqli_query($connection, $quary);
	$productCount = mysqli_num_rows($sql);
	if($productCount > 0){
		while($row = mysqli_fetch_array($sql)){
			$id = $row["id"];
			$product_name = $row["product_name"];
			$price = $row["price"];
			$date_added = strftime("%b %d %Y", strtotime($row["date_added"]));
			$product_list .= "$date_added - $id - <strong>$product_name</strong> - Rs $price <a href='inventoryEdit.php?pid=$id'>edit</a> <a href='inventoryList.php?deleteid=$id'>delete</a><br/>";	
		}	
	}else{
		$product_list = "No Product List";	
	}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Shopping Cart</title>
    <link rel="stylesheet" type="text/css" href="../style/main.css">
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("../template_header.php"); ?>
  <div id="pageContent">
      <div align="right" style="margin-right:32px;" ><a href="#inventoryForm">+ Add New Inventory Item</a></div>
    <div align="left" style="margin-left:24px;">
           <h2>Inventory List</h2>
           <p>&nbsp;</p>
           <p><?php echo $product_list; ?></p>
</div>
    <div>
    <a name="inventoryForm" id="inventoryForm"></a>
      <h3>Add New Inventory Item
      </h3>
<p>&nbsp; </p>
      <form action="inventoryList.php" enctype="multipart/form-data" name="MyForm" id="MyForm" method="post">
      <table width="90%" border="0" cellpadding="6">
        <tr>
          <td width="20%">Product Name</td>
          <td width="80%"><label>
            <input type="text" name="product_name" id="product_name" size="64"/>
           </label></td>
        </tr>
        <tr>
          <td>Product Price</td>
          <td><label>
          	   Rs
              <input name="price" type="text" id="price" size="12"/>
          </label></td>
        </tr>
        <tr>
          <td>Category</td>
          <td><label>
          		<select name="category" id="category">
                <option value="Clothing">Clothing</option>
                <option value="Electronic">Electronic</option>
                </select>
            </label></td>
        </tr>
        <tr>
          <td>Subcategory</td>
         <td><label>
          		<select name="subcategory" id="subcategory">
                <option value="Hats">Hats</option>
                <option value="Pants">Pants</option>
                <option value="Shirts">Shirts</option>
                </select>
            </label></td>
        </tr>
        <tr>
          <td>Product Details</td>
          <td><label>
            <textarea name="details" id="details" cols="64" rows="5"></textarea>
          </label></td>
        </tr>
        <tr>
          <td>Product Image</td>
          <td><label>
            <input type="file" name="image" id="image">
          </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><label>
            <input type="submit" name="submit" id="submit" value="Submit">
          </label></td>
        </tr>
      </table>
      </form>
      <p>&nbsp;</p>
    </div>
  </div>
   <div id="pageFooter">
     <p>&nbsp;</p>
     <p>Content for  id "pageFooter" Goes Here</p>
   </div>
</div>
</body>
</html>