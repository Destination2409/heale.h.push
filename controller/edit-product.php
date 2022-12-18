<?php
include("../conn.php");
session_start();
$name = $_POST['editname'];
$qry = $conn->query("SELECT * FROM product WHERE name = '$name' AND NOT id = '".$_POST["editid"]."'");
if($qry->num_rows != 0){
    $json_data = [
    "status" => 'ERROR',
    "message" => 'มีสินค้านี้อยู่แล้ว',
    ];
}else{
    $val = '';
    $val .= 'name="'.$_POST["editname"].'",';
    $val .= 'detail="'.$_POST["editdetail"].'",';
    $val .= 'price="'.$_POST["editprice"].'",';
    $val .= 'type_id="'.$_POST["edittype_id"].'",';
    if(isset($_FILES['editimg'])){
        $img = $_FILES['editimg'];
        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = "../assets/product/".$fileNew;
        if (in_array($fileActExt, $allow)) {
            if ($img['size'] > 0 && $img['error'] == 0) {
                if (move_uploaded_file($img['tmp_name'], $filePath)) {
                    $val .= 'img="'.$fileNew.'",';
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
    $val .= 'updated_at="'.date("Y-m-d h:i:sa").'"';
    $qry = $conn->query("UPDATE product SET $val WHERE id = '".$_POST["editid"]."'");
    if(!isset($json_data)){
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
    }
}
echo json_encode($json_data);
?>