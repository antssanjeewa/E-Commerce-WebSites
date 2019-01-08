<?php
	if($_SERVER['REQUEST_METHOD'] != "POST") die ("No Post Variables");
	$req = 'cmd= _notify-validate';
	
	foreach($_POST as $key => $value){
		$value = urlencode(stripcslashes($value));
		$req .= "&$key = $value";
	}
	
	$url = "https://www.paypal.com/cgi-bin/webscr";
	$curl_result = $curl_err='';
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL.$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$req);
	curl_setopt($ch,CURLOPT_HTTPHEADER,ayyay("Content-Type:application/x-www-form-urlencoded","Content-Length".strlen($url)));
	curl_setopt($ch,CURLOPT_HEADER,0);
	curl_setopt($ch,CURLOPT_VERBOSE,1);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
	curl_setopt($ch,CURLOPT_TIMEOUT,30);
	$curl_result = @curl_exec($ch);
	$curl_err = curl_error($ch);
	curl_close($ch);
	
	$req = str_replace("&","\n",$req);
	
	if(strpos($curl_result,"VERIFIED") !== false){
		$req .= "\n\nPaypal Verified OK"; 
	}else{
		$req .= "\n\nData NOT verified from Paypal";
		mail("you@yourmail.com","IPN interaction nor verified","$req","From:you@yourmail.com");
		exit();
	}
	
	$receiver_email = $_POST['receiver_email'];
	if($receiver_email != "you@yourmail.com"){
		$message = "investigate why and receiver email is wrong. Email=".$_POST['receiver_email']."\n\n\n$req";
		mail("you@yourmail.com","Receiver Mail Incorrect",$message,"From:you@yourmail.com");
		exit();
	}
	
	if($_POST['payment_status'] != "Completed"){
	}
	
	require_once('inc/connection.php');
	
	$this_txn = $_POST['txn_id'];
	$sql = mysqli_query($connection, "SELECT id FROM transactions WHERE txn_id='$this_txn' LIMIT 1");
	$numRows = mysqli_num_rows($sql);
	if($numRows > 0){
		$message = "Duplicate transaction ID occured so we killed the IPN script.\n\n\n$req";
		mail("you@yourmail.com","Duplicate txn_id in the IPN system",$message,"From:you@yourmail.com");
		exit();
	}
	
	$product_id_srting = $_POST['custom'];
	$product_id_string = rtrim($product_id_string,",");
	
	$id_str_array = explode(",",$product_id_string);
	$fullAmount = 0;
	foreach($id_str_array as $key=>$value){
		
		$id_quentity_pair = explode("-",$value);
		$product_id = $id_quentity_paid[0];
		$product_quentity = $id_quentity_pair[1];
		$sql = mysqli_query($connection, "SELECT price FROM product WHERE id='$product_id' LIMIT 1");
		while($row = mysqli_fetch_array($sql)){
			$product_price = $row['price'];
		}
		$product_price = $product_price * $product_quentity;
		$fullAmount = $fullAmount + $product_price;
	}
	
	$fullAmount - number_format($fullAmount, 2);
	$grossAmount = $+POST['mc_gross'];
	if($fullAmount != $grossAmount){
		$message = "Posiible Price Jack. ".$_POST['payment_gross']." !=$fullAmount. \n\n\n$req";
		mail("you@yourmail.com","Price Jack or Bad Programming",$message,"From:you@yourmail.com");
		exit();
	}
	
	$txn_id = $_POST['txn_id'];
	$payer_email = $_POST['payer_email'];
	$custom = $_POST['custom'];
	
	$sql = mysqli_query($connection, INSERT INTO transaction (product_id_array,payer_email,....)
	VALUES('$custom','$payer_email',.....)) or die("Unable to execute the query");
	
	mysql_close();
	mail("you@yourmail.com","NORMAL IPN RESULT YAY MONEY",$req,"From:you@yourmail.com");
		
?>