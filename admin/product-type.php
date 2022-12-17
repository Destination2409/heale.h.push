<?php include("../layout/header.php");?>
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="card text-center my-5">
                <div class="card-header">
                    <?php include("../layout/menu-admin.php");?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table color-bordered-table dark-bordered-table" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ชื่อ</th>
                                                    <th>เวลาที่สร้าง</th>
                                                    <th>เวลาที่แก้ไข</th>
                                                    <th>จัดการ</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">เพิ่มข้อมูล</button>
                </div>
            </div>
        </div>
    </section>
    
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form id="main_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มสินค้า</h5>
                    <button class="btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">ชื่อสินค้า</label>
                                <input type="text" class="form-control" id="name" name="name" require>
                            </div>
                        </div>
                    </div>
                </div>	
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="edit_form">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel">แก้ไขชนิดสินค้า</h5>
                    <button class="btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="editname">ชื่อชนิด</label>
                                <input type="text" class="form-control" id="editname" name="editname" require>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" class="form-control" id="editid" name="editid" require hidden>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include("../layout/footer-script.php");?>
<script>
    document.getElementById('admin-product-type').classList.add("active");
    var datatable1 = $('#myTable').DataTable({
        "processing": true,
        // "serverSide": true,
        "ajax": {
            "url": "<?=$hosturl.'/datatable/product-type-list.php'?>",
            "type": "GET"
        },
        "columns": [{
                "render": function(data, type, full, meta) {
                    // return index_i++;
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'updated_at',
                name: 'updated_at'
            },
            {
                data: 'id',
                name: 'id'
            }
        ],
        "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0,
            },
            {
                "targets": -1,
                "render": function(data, type, row, meta) {
                    return '<button type="button" id="editbtn" class="btn btn-warning mx-2" data-toggle="modal" data-target="#EditModal" title="ลบผู้ใช้งาน"><i class="fas fa-edit"></i></button><button type="button" onclick="Delete(' + data + ')" class="btn btn-danger mx-2"><i class="fas fa-trash"></i></button>';
                }
            }
        ],
    });
    // on submit main form 
    $(document).on('submit', '#main_form', function(e) {
        e.preventDefault();
        let formdata = new FormData(main_form);
        console.log(`main_form`, main_form)
        Swal.fire({
            title: 'ต้องการบันทึก ?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            denyButtonText: `ไม่บันทึก`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed || result.value) {
                $.ajax({
                    type: 'POST',
                    url: "<?=$hosturl.'/controller/add-product-type.php'?>",
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
                                datatable1.ajax.reload();
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

    // on delete
    function Delete(id) {
        let formdata = new FormData();
        formdata.append('editid', id);
        Swal.fire({
            title: 'ต้องการที่จะลบ ?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `ลบ`,
            denyButtonText: `ไม่ลบ`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed || result.value) {
                $.ajax({
                    type: 'POST',
                    url: "<?=$hosturl.'/controller/delete-product-type.php'?>",
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
                                datatable1.ajax.reload();
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
                Swal.fire('Not Delete', '', 'info')
            }
        })
    }

    $("#myTable tbody").on("click", "#editbtn", function() {
        var data = datatable1.row($(this).parents("tr")).data();
        $("#editname").val(data.name);
        $("#editid").val(data.id);
    });

    $(document).on('submit', '#edit_form', function(e) {
        e.preventDefault();
        let formdata = new FormData(edit_form);
        Swal.fire({
            title: 'ต้องการบันทึก ?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `บันทึก`,
            denyButtonText: `ไม่บันทึก`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed || result.value) {
                $.ajax({
                    type: 'POST',
                    url: "<?=$hosturl.'/controller/edit-product-type.php'?>",
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
                                datatable1.ajax.reload();
                                $("button .close").click();
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
</script>
<?php include("../layout/footer.php");?>