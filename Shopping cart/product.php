<?php session_start();
	require_once('inc/connection.php');
?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<?php 
	if(isset($_GET['id'])){
		$id = preg_replace('#[^0-9]#i','',$_GET['id']);
		$quary = "SELECT * FROM product WHERE id='$id' LIMIT 1";
		$sql = mysqli_query($connection, $quary);
		$productCount = mysqli_num_rows($sql);
		if($productCount > 0){
			while($row = mysqli_fetch_array($sql)){
				$id = $row["id"];
				$product_name = $row["product_name"];
				$price = $row["price"];
				$category = $row["category"];
				$subcategory = $row["subcategory"];
				$details = $row["details"];
				$date_added = strftime("%b %d %Y", strtotime($row["date_added"]));
			}
		}else{
			echo "This item is not Exist";
			exit();
		}
	}else{
		echo "This page is not Exist";
		exit();
	}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title><?php echo $product_name; ?></title>
	<link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("template_header.php"); ?>
  <div id="pageContent">
	<hr>
	<hr>
	<table width="100%" border="0" cellpadding="15" cellspacing="0">
      <tr>
        <td width="20%" valign="top">
			<p>Item Added To List</p>
			<img src="inventory_images/<?php echo $id; ?>.jpg" alt="<?php echo $id; ?>" width="250" height="150"/>
			<a href="inventory_images/<?php echo $id; ?>.jpg">View Full Image</a>
        </td>
        <td width="80%" valign="top">
			<h3><?php echo $product_name; ?></h3>
			<p><?php echo $price; ?></p>
			<p><?php echo "$subcategory $category"; ?></p>
			<p><?php echo $details; ?></p>
			<p><?php echo $date_added; ?></p>
			<form id="form1" name="form1" method="post" action="cart.php">
				<input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>"/>
				<input type="submit" name="button" id="button" value="Add To Cart"/>
			</form>
		</td>
      </tr>
	</table>
	<hr>
	<hr>
  </div>
  <div id="pageFooter">Content for  id "pageFooter" Goes Here</div>
</div>
</body>
</html>