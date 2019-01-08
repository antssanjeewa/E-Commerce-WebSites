<?php session_start();
	require_once('inc/connection.php');
?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<?php 
	if(isset($_POST['pid'])){
		$pid = $_POST['pid'];
		$wasfound = false;
		$i = 0;
		
		if(!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1){
			$_SESSION["cart_array"] = array(0=>array("item_id"=>$pid, "quantity"=> 1));
		}else{
			foreach($_SESSION['cart_array'] as $each_item){
				$i++;
				while(list($key,$value) = each($each_item)){
					if($key == "item_id" && $value==$pid){
						array_splice($_SESSION['cart_array'],$i-1,1,array(array("item_id"=>$pid,"quantity"=> $each_item['quantity']+1)));
						$wasfound = true;
					}
				}
			}
			if($wasfound == false){
				array_push($_SESSION["cart_array"],array("item_id"=>$pid, "quantity"=> 1));
			}
		}
		header("location:cart.php");
		exit();
	}
?>
<?php 
if(isset($_GET['cmd']) && $_GET['cmd'] == "emptycart"){
	unset($_SESSION['cart_array']);
}
?>
<?php 
	if(isset($_POST['adjust']) && $_POST['adjust'] != ""){
		$adjust = $_POST['adjust'];
		$quantity = $_POST['quantity'];
		$i =0;
		foreach($_SESSION['cart_array'] as $each_item){
			$i++;
			while(list($key,$value) = each($each_item)){
				if($key == "item_id" && $value==$adjust){
					array_splice($_SESSION['cart_array'],$i-1,1,array(array("item_id"=>$adjust,"quantity"=> $quantity)));
				}
			}
		}
	}
?>	
<?php 
	if(isset($_POST['id_remove']) && $_POST['id_remove'] != ""){
		$key = $_POST['id_remove'];
		if(count($_SESSION['cart_array']) <= 1){
			unset($_SESSION['cart_array']);
		}else{
			unset($_SESSION["cart_array"]["$key"]);
			sort($_SESSION["cart_array"]);
		}
	}
?>
<?php
$cartoutput ="";
$carttotal ="";
$pp_checkout_btn ="";
$product_id_array = "";
if(!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1){
	$cartoutput = "<h2 align='center'> Your Shopping Cart is Empty</h2>";
}else{

	$pp_checkout_btn .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="upload" value="1">
	<input type="hidden" name="business" value="you@yourmail.com">'; 

	$i = 0;
	foreach($_SESSION['cart_array'] as $each_item){
		$item_id = $each_item['item_id'];
		$quantity = $each_item['quantity'];
		$quary = "SELECT * FROM product WHERE id='$item_id' LIMIT 1";
		$sql = mysqli_query($connection, $quary);
		while($row = mysqli_fetch_array($sql)){
			$product_name = $row["product_name"];
			$price = $row["price"];
			$details = $row["details"];
		}
		$totalprice = $price * $quantity;
		$carttotal = $totalprice + $carttotal;
		//setlocale(LC_MONETARY,"en_US");
		//$totalprice = money_format("%10.2n",$totalprice);
		$x = $i +1;
		$pp_checkout_btn .= '<input type="hidden" name="item_name_'.$x.'" value="'.$product_name.'">
							<input type="hidden" name="amount_'.$x.'" value="'.$price.'">
							<input type="hidden" name="quentity_'.$x.'" value="'.$quantity.'">';
		
		$product_id_array .= "$item_id-".$quantity.",";
		
		$cartoutput .= "<tr>";
		$cartoutput .= "<td><a href=\"product.php?id=$item_id\">$product_name</a><br/><img src=\"inventory_images/$item_id.jpg\" alt=\"$item_id\" width=\"40\" height=\"20\"/></td>";
		$cartoutput .= "<td>".$details."</td>";
		$cartoutput .= "<td>Rs:".$price."</td>";
		$cartoutput .= '<td><form action="cart.php" method="post">
									<input name="quantity" type="number" style="width:50px;" value="'.$quantity.'" size="1" maxlength="2"/>
									<input name="adjustBtn'.$item_id.'" type="submit" value="change"/>
									<input name="adjust" type="hidden" value="'.$item_id.'"/>
									</form></td>';
		$cartoutput .= "<td>Rs:".$totalprice."</td>";
		$cartoutput .= '<td><form action="cart.php" method="post">
									<input name="delete'.$item_id.'" type="submit" value="X"/>
									<input name="id_remove" type="hidden" value="'.$i.'"/>
									</form></td>';
		$cartoutput .= "</tr>";
		$i++;
	}
	//setlocale(LC_MONETARY,"en_US");
	//$carttotal = money_format("%10.2n",$carttotal);
	$carttotal = "<div align='right'>Cart Total: Rs ".$carttotal."</div>";
	
	$pp_checkout_btn .= '<input type="hidden" name="custom" value="'.$product_id_array.'">
						<input type="hidden" name="notify_url" value="https://www.yoursite.com/storescript/my_ipn.php">
						<input type="hidden" name="return" value="https://www.yoursite.com/checkout_complete.php">
						<input type="hidden" name="rm" value="2">
						<input type="hidden" name="cbt" value="Return to the Store">
						<input type="hidden" name="cancel_return" value="https://www.yoursite.com/paypal_cancel.php">
						<input type="hidden" name="Ic" value="US">
						<input type="hidden" name="currency_code" value="USD">
						<input type="image" src="#" name="submit" value="XXX">
						</form>';
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Shopping Cart</title>
	<link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("template_header.php"); ?>
  <div id="pageContent">
	<hr>
	<hr>
	<div style="margin:24px; text-align:left;">
		
		<table width="100%" border="1" cellpadding="6" cellspacing="0">
			<tr>
				<th width="20%" valign="top">Product Name</th>
				<th width="42%" >Product Description</th>
				<th width="10%" >Unit Price</th>
				<th width="10%" >Quantity</th>
				<th width="10%" >Total</th>
				<th width="8%" >Remove</th>
			</tr>
			<?php echo $cartoutput; ?>
		</table>
		<br/>
		<?php echo $carttotal; ?>
		<br/>
		<?php echo $pp_checkout_btn; ?>
		<br/>
		<a href="cart.php?cmd=emptycart">Click here to empty Your shoppng cart</a>
	</div>
	<hr>
	<hr>
  </div>
  <div id="pageFooter">Content for  id "pageFooter" Goes Here</div>
</div>
</body>
</html>