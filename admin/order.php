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
                                    <!-- <div class="float-right">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                            เพิ่มรายการบริษัท
                                        </button>
                                    </div> -->
                                    <!-- <h4 class="card-title">Primary Table</h4>
                                    <h6 class="card-subtitle">Add class <code>.color-table .primary-table</code></h6> -->
                                    <div class="table-responsive">
                                        <table class="table color-bordered-table dark-bordered-table" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ชื่อ</th>
                                                    <th>อีเมล์</th>
                                                    <th>จังหวัด</th>
                                                    <th>โทร.</th>
                                                    <th>ข้อความ</th>
                                                    <th>Action</th>
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
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </section>
<?php include("../layout/footer-script.php");?>
<script>
    document.getElementById('admin-order').classList.add("active");
    var datatable1 = $('#myTable').DataTable({
        "processing": true,
        // "serverSide": true,
        "ajax": {
            "url": "<?=$hosturl.'/datatable/form-contact-list'?>.php",
            "type": "GET"
        },
        "columns": [{
                "render": function(data, type, full, meta) {
                    // return index_i++;
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'fullname',
                name: 'fullname'
            },
            {
                data: 'mail',
                name: 'mail'
            },
            {
                data: 'province',
                name: 'province'
            },
            {
                data: 'tel',
                name: 'tel'
            },
            {
                data: 'note',
                name: 'note'
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
                    return '<button type="button" onclick="Delete(' + data + ')" class="btn btn-danger mx-2"><i class="ti-trash"></i></button><a class="btn btn-info mx-2" href="form-contact.php?id='+data+'"><i class="fas fa-search text-white"></i></a>';
                }
            }
        ],
    });
    // on submit main form 
    // $(document).on('submit', '#main_form', function(e) {
    //     e.preventDefault();
    //     let formdata = new FormData(main_form);
    //     console.log(`main_form`, main_form)
    //     Swal.fire({
    //         title: 'ต้องการบันทึก ?',
    //         showDenyButton: true,
    //         showCancelButton: true,
    //         confirmButtonText: `บันทึก`,
    //         denyButtonText: `ไม่บันทึก`,
    //     }).then((result) => {
    //         /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed || result.value) {
    //             $.ajax({
    //                 type: 'POST',
    //                 url: "controller/add-company.php",
    //                 data: formdata,
    //                 processData: false,
    //                 contentType: false,
    //                 beforeSend: function() {
    //                     $("#preloader").fadeIn("slow");
    //                 },
    //                 success: function(data) {
    //                     data = JSON.parse(data);
    //                     if (data.status == "OK") {
    //                         Swal.fire({
    //                             icon: 'success',
    //                             title: 'สำเร็จ',
    //                             text: data.message
    //                         }).then(() => {
    //                             datatable1.ajax.reload();
    //                         })
    //                     } else {
    //                         Swal.fire({
    //                             icon: 'error',
    //                             title: 'Oops...',
    //                             text: data.message
    //                         })
    //                     }
    //                 },
    //                 error: function(xhr) {
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Oops...',
    //                         text: xhr.statusText + xhr.responseText
    //                     })
    //                     // alert("Error occured.please try again");
    //                     // $(placeholder).append(xhr.statusText + xhr.responseText);
    //                     // $(placeholder).removeClass('loading');
    //                 },
    //                 complete: function() {
    //                     $("#preloader").fadeOut("slow");
    //                 }
    //             });
    //         } else if (result.isDenied) {
    //             Swal.fire('Not Saved', '', 'info')
    //         }
    //     })
    // });

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
                    url: "controller/delete-form-contact.php",
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

    // $("#myTable tbody").on("click", "#editbtn", function() {
    //     var data = datatable1.row($(this).parents("tr")).data();
    //     // console.log(`data`, data);
    //     $("#editfullname").val(data.fullname);
    //     $("#editshortname").val(data.shortname);
    //     $("#edittype").val(data.type);
    //     $("#editprovince").val(data.province);
    //     $("#edittel").val(data.tel);
    //     $("#editid").val(data.id);
    // });

    // $(document).on('submit', '#edit_form', function(e) {
    //     e.preventDefault();
    //     let formdata = new FormData(edit_form);
    //     Swal.fire({
    //         title: 'ต้องการบันทึก ?',
    //         showDenyButton: true,
    //         showCancelButton: true,
    //         confirmButtonText: `บันทึก`,
    //         denyButtonText: `ไม่บันทึก`,
    //     }).then((result) => {
    //         /* Read more about isConfirmed, isDenied below */
    //         if (result.isConfirmed || result.value) {
    //             $.ajax({
    //                 type: 'POST',
    //                 url: "controller/edit-company.php",
    //                 data: formdata,
    //                 processData: false,
    //                 contentType: false,
    //                 beforeSend: function() {
    //                     $("#preloader").fadeIn("slow");
    //                 },
    //                 success: function(data) {
    //                     data = JSON.parse(data);
    //                     if (data.status == "OK") {
    //                         Swal.fire({
    //                             icon: 'success',
    //                             title: 'สำเร็จ',
    //                             text: data.message
    //                         }).then(() => {
    //                             datatable1.ajax.reload();
    //                             $("button .close").click();
    //                         })
    //                     } else {
    //                         Swal.fire({
    //                             icon: 'error',
    //                             title: 'Oops...',
    //                             text: data.message
    //                         })
    //                     }
    //                 },
    //                 error: function(xhr) {
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Oops...',
    //                         text: xhr.statusText + xhr.responseText
    //                     })
    //                     // alert("Error occured.please try again");
    //                     // $(placeholder).append(xhr.statusText + xhr.responseText);
    //                     // $(placeholder).removeClass('loading');
    //                 },
    //                 complete: function() {
    //                     $("#preloader").fadeOut("slow");
    //                 }
    //             });
    //         } else if (result.isDenied) {
    //             Swal.fire('Not Saved', '', 'info')
    //         }
    //     })
    // });
</script>
<?php include("../layout/footer.php");?>