<?php
    include "connection.php";

    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $mobile = $_POST['mobile'];
    $bday = $_POST['bday'];

    $nameValidate = "/^[A-Z][a-zA-Z ]+$/";
    $emailValidate = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
    $numberValidate = "/^[0-9]+$/";

    if(empty($f_name) || empty($l_name) ||empty($email) ||empty($password) ||empty($re_password) ||empty($mobile) ||empty($bday)){
        echo "
            <div class='alert alert-warning'>
                <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please Fill All Field.....</b>
            </div>
        ";
    }else{
        if(!preg_match($nameValidate, $f_name)){
            echo "
            <div class='alert alert-warning'>
                <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>This  $f_name is not Valid</b>
            </div>
        ";
            exit();
        }
        if(!preg_match($nameValidate, $l_name)){
            echo "
            <div class='alert alert-warning'>
                <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>This $l_name is not Valid</b>
            </div>
        ";
            exit();
        }
        if(!preg_match($emailValidate, $email)){
            echo "
            <div class='alert alert-warning'>
                <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>This $email is not Valid</b>
            </div>
        ";
            exit();
        }
        if($password != $re_password){
            echo "
            <div class='alert alert-warning'>
                <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Password is Not Match</b>
            </div>
        ";
            exit();
        }
        if((strlen($password) < 6) || (strlen($re_password) < 6)){
            echo "
            <div class='alert alert-warning'>
                <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Password is Week</b>
            </div>
        ";
            exit();
        }
        if(!preg_match($numberValidate, $mobile)){
            echo "
            <div class='alert alert-warning'>
                <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>This $mobile is not Valid</b>
            </div>
        ";
            exit();
        }

        $sql = "SELECT id FROM user WHERE email='$email' LIMIT 1";
        $check = mysqli_query($connection,$sql);
        $count_email = mysqli_num_rows($check);
        if($count_email > 0){
            echo "
            <div class='alert alert-danger'>
                <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <b>Email Already Exists......</b>
            </div>
            ";
            exit();
        }else{
            $password = md5($password);
            $sql = "INSERT INTO user (`frist_name`, `last_name`, `email`, `password`, `mobile`, `address_1`, `address_2`)
             VALUES ('$f_name', '$l_name', '$email', '$password', '$mobile', '$bday', 'urubokka')";
            $run_query = mysqli_query($connection, $sql);
            if($run_query){
                echo "
                <div class='alert alert-success'>
                    <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    <b>Successfully Add Customer....</b>
                </div>
            ";
            }
        }
    }

    
?>