<?php include("../layout/header.php");
$sql = "SELECT product.*,product_type.name as product_type FROM product LEFT JOIN product_type ON product_type.id = product.type_id WHERE product.id = ".$_GET['id'];
$product = mysqli_query($conn, $sql) or die("query filed: get product");
$product = $product->fetch_assoc();
?>
<section class="page-section bg-light" id="portfolio">
    <form id="main_form">
        <div class="container">
            <div class="card text-center my-5">
                <div class="card-body">
                    <img class="img-fluid" src="<?=$hosturl.'/assets/product/'.$product['img']?>" width="500" alt="..." />
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">ชื่อสินค้า : <?= $product['name'];?></li>
                        <li class="list-group-item">รายละเอียด : <?= $product['detail'];?></li>
                        <li class="list-group-item">ชนิดสินค้า : <?= $product['product_type'];?></li>
                        <li class="list-group-item">ราคาสินค้า : <?= $product['price'];?> บาท</li>
                        <li class="list-group-item"> จำนวนชิ้นที่ซื้อ <input type="number" class="form-control text-center" id="amount" name="amount" value="1" min="1" require onchange="sum_price()"></li>
                        <li class="list-group-item"> รวมราคา <span id="sum"></span> บาท</li>
                    </ul>
                    <input type="text" name="product_id" value="<?= $product['id'];?>" hidden>
                    <input type="text" name="customer_id" value="<?= $_SESSION['user']['id'];?>" hidden>
                </div>
                <div class="card-footer">
                    <?php if(isset($_SESSION['user'])){?>
                    <button type="submit" class="btn btn-primary">ซื้อเลย !</button>
                    <?php }else{?>
                    <a type="submit" class="btn btn-primary" href="<?=$hosturl.'/login.php';?>">ซื้อเลย !</a>
                    <?php }?>
                </div>
            </div>
        </div>
    </form>
</section>
<?php include("../layout/footer-script.php");?>
<script>
// on submit main form 
$(document).on('submit', '#main_form', function(e) {
    e.preventDefault();
    let formdata = new FormData(main_form);
    console.log(`main_form`, main_form)
    Swal.fire({
        title: 'ยืนยันการซื้อ ?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `ซื้อ`,
        denyButtonText: `ไม่ซื้อ`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed || result.value) {
            $.ajax({
                type: 'POST',
                url: "<?=$hosturl.'/controller/add-order.php'?>",
                data: formdata,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $("#preloader").fadeIn("slow");
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status == "OK") {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: data.message
                        }).then(() => {
                            window.location.href = "<?=$hosturl.'/main/index.php'?>";
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        })
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: xhr.statusText + xhr.responseText
                    })
                    // alert("Error occured.please try again");
                    // $(placeholder).append(xhr.statusText + xhr.responseText);
                    // $(placeholder).removeClass('loading');
                },
                complete: function() {
                    $("#preloader").fadeOut("slow");
                }
            });
        } else if (result.isDenied) {
            Swal.fire('Not Saved', '', 'info')
        }
    })
});

function sum_price(){
    $("#sum").html($("#amount").val() * parseFloat(<?= $product['price'];?>));
}
sum_price();
</script>
<?php include("../layout/footer.php");?>