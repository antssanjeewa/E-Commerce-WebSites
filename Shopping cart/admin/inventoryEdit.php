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
if(isset($_GET['pid'])){
	$id = $_GET['pid'];
	$quary = "SELECT * FROM product WHERE id = '$id' LIMIT 1";
	$sql = mysqli_query($connection, $quary);
	$productCount = mysqli_num_rows($sql);
	if($productCount > 0){
		while($row = mysqli_fetch_array($sql)){
			$product_name = $row["product_name"];
			$price = $row["price"];
			$category = $row["category"];
			$subcategory = $row["subcategory"];
			$details = $row["details"];
			$date_added = strftime("%b %d %Y", strtotime($row["date_added"]));
				
		}	
	}else{
		$product_list = "No Product List";
		exit();
	}
}

?>
<?php 
if(isset($_POST['product_name'])){
	$id = mysqli_real_escape_string($connection,$_POST['thisID']);
	$product_name = mysqli_real_escape_string($connection,$_POST['product_name']);
	$price = mysqli_real_escape_string($connection,$_POST['price']);
	$category = mysqli_real_escape_string($connection,$_POST['category']);
	$subcategory = mysqli_real_escape_string($connection,$_POST['subcategory']);
	$details = mysqli_real_escape_string($connection,$_POST['details']);
	
	$sql = "UPDATE product SET product_name='$product_name',price='$price',category='$category',subcategory='$subcategory',details='$details' WHERE id='$id' ";
	$result = mysqli_query($connection, $sql);
	if($_FILES['fileField']['tmp_name'] != ""){
		$newname = "$pid.jpg";
		move_uploaded_file($_FILES['fileField']['tmp_name'],"../inventory_images/$newname");
	
	}
	header("location: inventoryList.php");
	exit();
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
    <div>
    <a name="inventoryForm" id="inventoryForm"></a>
      <h3>Update Inventory Item
      </h3>
<p>&nbsp; </p>
      <form action="inventoryEdit.php" enctype="multipart/form-data" name="MyForm" id="MyForm" method="post">
      <table width="90%" border="0" cellpadding="6">
        <tr>
          <td width="20%">Product Name</td>
          <td width="80%"><label>
            <input type="text" name="product_name" id="product_name" size="64" value="<?php echo $product_name; ?>"/>
           </label></td>
        </tr>
        <tr>
          <td>Product Price</td>
          <td><label>
          	   Rs
              <input name="price" type="text" id="price" size="12" value="<?php echo $price; ?>"/>
          </label></td>
        </tr>
        <tr>
          <td>Category</td>
          <td><label>
          		<select name="category" id="category">
				<option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                <option value="Clothing">Clothing</option>
                <option value="Electronic">Electronic</option>
                </select>
            </label></td>
        </tr>
        <tr>
          <td>Subcategory</td>
         <td><label>
          		<select name="subcategory" id="subcategory">
				<option value="<?php echo $subcategory; ?>"><?php echo $subcategory; ?></option>
                <option value="Hats">Hats</option>
                <option value="Pants">Pants</option>
                <option value="Shirts">Shirts</option>
                </select>
            </label></td>
        </tr>
        <tr>
          <td>Product Details</td>
          <td><label>
            <textarea name="details" id="details" cols="64" rows="5"><?php echo $details; ?></textarea>
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
			<input type="hidden" name="thisID" value="<?php echo $id; ?>"/>
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