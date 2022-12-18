<?php
include("../conn.php");
session_start();
$requestData = $_REQUEST;
$sql = "SELECT
            `order`.*,
            customer.`name` AS customer_name,
            product.`name` AS product_name,
            product_type.`name` AS product_type,
            product.img,
            product.price
        FROM
            `order`
        LEFT JOIN product ON product.id = `order`.amount
        LEFT JOIN customer ON customer.id = `order`.customer_id
        LEFT JOIN product_type ON product_type.id = product.type_id 
        WHERE
            1
        ORDER BY `order`.`status` ASC";
$query = mysqli_query($conn, $sql) or die("query filed: get product");
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
