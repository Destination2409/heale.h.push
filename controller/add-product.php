<?php
include("../conn.php");
session_start();
$img = $_FILES['img'];
$allow = array('jpg', 'jpeg', 'png');
$extension = explode('.', $img['name']);
$fileActExt = strtolower(end($extension));
$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
$filePath = "../assets/product/".$fileNew;
    

$name = $_POST['name'];
$qry = $conn->query("SELECT * FROM product WHERE name = '$name' ");
if($qry->num_rows != 0){
    $json_data = [
    "status" => 'ERROR',
    "message" => 'มีสินค้านี้อยู่แล้ว',
    ];
}else{
    if (in_array($fileActExt, $allow)) {
        if ($img['size'] > 0 && $img['error'] == 0) {
            if (move_uploaded_file($img['tmp_name'], $filePath)) {
                $val = '';
                $val .= '"'.$_POST["name"].'",';
                $val .= '"'.$_POST["detail"].'",';
                $val .= '"'.$_POST["price"].'",';
                $val .= '"'.$_POST["type_id"].'",';
                $val .= '"'.$fileNew.'",';
                $val .= '"'.date("Y-m-d h:i:s").'",';
                $val .= '"'.date("Y-m-d h:i:s").'"';
                $qry = $conn->query("INSERT INTO product(name,detail,price,type_id,img,created_at,updated_at) VALUES($val)");
                
                if($qry){
                    $json_data = [
                    "status" => 'OK',
                    "message" => 'เพิ่มสำเร็จ',
                    ];
                }else{
                    $json_data = [
                    "status" => 'ERROR',
                    "message" => 'เพิ่มไม่สำเร็จ',
                    ];
                }
            }else{
                $json_data = [
                "status" => 'ERROR',
                "message" => 'บันทึกรูปไม่สำเร็จ',
                ];
            }
        }else{
            $json_data = [
            "status" => 'ERROR',
            "message" => 'เพิ่มไม่สำเร็จ',
            ];
        }
    }else{
        $json_data = [
        "status" => 'ERROR',
        "message" => 'รับรองแค่ไฟล์รูปเท่านั้น',
        ];
    }
}
echo json_encode($json_data);
?>