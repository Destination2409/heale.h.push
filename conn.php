<?php
$username = 'root';
$password = '';
$host = 'localhost';
$database = 'heale.h';

if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$project_name = 'heale.h';
$hosturl = $uri.$_SERVER['HTTP_HOST'].'/'.$project_name;

$conn = new mysqli($host, $username, $password, $database);
$conn -> set_charset("utf8");

?>