<?php
include("../conn.php");
session_start();
$email = $_POST["email"];
$pwd = $_POST['password'];
$pwd_hashed = md5($pwd);
$qry = $conn->query("SELECT * FROM customer WHERE email = '$email'")->fetch_assoc();
if ($pwd_hashed == $qry['password']) {
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['user']['id'] = $qry['id'];
    $_SESSION['user']['email'] = $qry['email'];
    $_SESSION['user']['name'] = $qry['name'];
    $_SESSION['user']['tel'] = $qry['tel'];
    $_SESSION['user']['permission'] = $qry['permission'];
    $_SESSION['user']['password'] = $qry['password'];
    $_SESSION['user']['address'] = $qry['address'];
    header("Location: ../index.php");
}else{
    header("Location: ../login.php?auth=fail");
}
?>