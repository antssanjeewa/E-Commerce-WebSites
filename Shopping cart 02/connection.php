<?php 
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'antsshop';

	$connection = mysqli_connect('localhost','root','','antsshop');

	if(mysqli_connect_errno()){
		die('Database connection failed'.mysqli_connect_error());
	}

 ?>