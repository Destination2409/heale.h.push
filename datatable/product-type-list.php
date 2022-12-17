<?php
include("../conn.php");
session_start();
$requestData = $_REQUEST;
$sql = "SELECT * FROM product_type WHERE 1";
$query = mysqli_query($conn, $sql) or die("query filed: get product_type");
$myArray = array();
while($row = $query->fetch_assoc()) {
    $myArray[] = $row;
}
$json_data = [
// "draw" => intval($requestData['draw']),
// "recordsTotal" => mysqli_num_rows ($query),
// "recordsFiltered" => mysqli_num_rows ($query),
"data"            => $myArray
];
echo json_encode($json_data);
