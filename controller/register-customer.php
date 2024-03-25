<?php
include("../conn.php");
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$address = $_POST['address'];
$qry = $conn->query("SELECT * FROM customer WHERE email = '$email'");
if($qry->num_rows != 0){
    header("Location: ../register.php?check=alreadyexists");
}else{
    $pwd_hashed = md5($password);
    $val = '';
    $val .= '"'.$email.'",';
    $val .= '"'.$pwd_hashed.'",';
    $val .= '"'.$name.'",';
    $val .= '"'.$tel.'",';
    $val .= '"'.$address.'",';
    $val .= '"'.date("Y-m-d h:i:s").'"';
    $qry = $conn->query("INSERT INTO customer(email,password,name,tel,address,created_at) VALUES($val)");
    if($qry){
        header("Location: ../login.php?auth=registered");
    }else{
        header("Location: ../register.php?check=error");
    }
}

?>