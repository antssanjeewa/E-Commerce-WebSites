<?php session_start();
	require_once('inc/connection.php');
?>
<?php
	
	$product_list = "";
	$quary = "SELECT * FROM product LIMIT 5";
	$sql = mysqli_query($connection, $quary);
	$productCount = mysqli_num_rows($sql);
	if($productCount > 0){
		while($row = mysqli_fetch_array($sql)){
			$id = $row["id"];
			$product_name = $row["product_name"];
			$price = $row["price"];
			$date_added = strftime("%b %d %Y", strtotime($row["date_added"]));
			$product_list .= '<tr>
              <td width="150">
				<img src="inventory_images/'.$id.'.jpg" alt="'.$id.'" width="200" height="100"/>
			  </td>
              <td width="150">
				  <p><strong>'.$product_name.'</strong></p>
				  <p>Rs '.$price.'</p>
				  <p>'.$date_added.'</p>
				  <p>sss</p>
			  </td>
              <td width="150">
				  <h3><a href="product.php?id='.$id.'">View More</a></h3>
					<p>&nbsp;</p>
				  <h3><a href="#">vv</a></h3>
			  </td>
            </tr>';	
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
	<link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("template_header.php"); ?>
  <div id="pageContent">
	<hr>
	<hr>
	<table width="100%" border="0">
      <tr>
        <td width="25%" valign="top"><p>Some Crap</p>
        <p>Similarly, point1++ has no Java meaning; it suggests that point1—1000—
			should be increased to 1001, but in that case it might not be referencing a
			valid Point object. Many languages (e.g., C++) define the pointer, which
			behaves like a reference variable. However, pointers in C++ are much more
			dangerous because arithmetic on stored addresses is allowed. Thus, in C++,
			point1++ has a meaning. Because C++ allows pointers to primitive types, one
			must be careful to distinguish between arithmetic on addresses and arithmetic
			on the objects being referenced. This is done by explicitly dereferencing the
			pointer. In practice, C++’s unsafe pointers tend to cause numerous programming errors.
			Some operatio</p>
        </td>
        <td width="50%" valign="top" style="padding:5px 25px;"><p>Item Added To List</p>
          <table width="496" border="0" cellpadding="0" cellspacing="6">
            <?php echo $product_list; ?>
          </table>
          <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p></td>
        <td width="25%" valign="top"><p>More Crap</p>
        <p>Because of call-by-value, the actual arguments are sent into the formal parameters using normal assignment. If the parameter is a reference type, then we
			know that normal assignment means that the formal parameter now references
			the same object as does the actual argument. Any method applied to the formal parameter is thus also being applied to the actual argument. In other languages, this is known as call-by-reference parameter passing. Using this
			terminology for Java would be somewhat misleading because it implies that
			the parameter passing is different. In reality, the parameter passing has not
			changed; rather, it is th</p>
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