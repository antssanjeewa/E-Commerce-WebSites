<?php
session_start();

include "connection.php";

if(isset($_POST["Userlogin"])){
    $email = mysqli_real_escape_string($connection, $_POST["Useremail"]);
    $pass = md5($_POST["Userpassword"]);

    $sql = "SELECT * FROM user WHERE email='$email' AND password='$pass' ";
    $run_query = mysqli_query($connection, $sql);
    if(mysqli_num_rows($run_query) == 1){
        $row = mysqli_fetch_array($run_query);
        $_SESSION["user_id"] = $row['id'];
        $_SESSION["user_name"] = $row['frist_name'];
        echo "Success";
    }
}

?>