<?php
$username = 'golf';
$password = 'P@55w0rd';
$host = '52.62.19.2';
$database = 'heale.h';

if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$project_name = 'heale.h.push';
$hosturl = $uri.$_SERVER['HTTP_HOST'].'/'.$project_name;

$conn = new mysqli($host, $username, $password, $database);
$conn -> set_charset("utf8");

?>