<?php session_start();
	if(!isset($_SESSION["manager"])){
		header("location: index.php");
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
  <div align="left" style="margin-left:24px;">
    <h2>What Do Today</h2>
    <p><a href="inventoryList.php">manage inventory</a></p>
    <p><a href="#">manage bla </a></p>
  </div>

  </div>
  <div id="pageFooter">Content for  id "pageFooter" Goes Here</div>
</div>
</body>
</html>