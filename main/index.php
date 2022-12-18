<?php include("../layout/header.php");
$sql = "SELECT * FROM product WHERE 1";
$product = mysqli_query($conn, $sql) or die("query filed: get product");
?>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading" style="background-color: #00000033;">ยินดีต้อนรับสู่ร้าน Heale.H</div>
            </div>
        </header>
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">สินค้าของเรา</h2>
                    <h3 class="section-subheading text-muted">เทียนหลากหลายชนิด</h3>
                </div>
                <div class="row">
                    <?php foreach($product as $key => $value){?>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" href="<?=$hosturl.'/main/product.php?id='.$value['id']?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="<?=$hosturl.'/assets/product/'.$value['img']?>" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading"><?=$value['name'];?></div>
                                <div class="portfolio-caption-subheading text-muted"><?=$value['detail'];?></div>
                                <div class="portfolio-caption">ราคาสินค้า <?=$value['price'];?> บาท</div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </section>
        <!-- Footer-->
<?php include("../layout/footer-script.php");?>
<?php include("../layout/footer.php");?>