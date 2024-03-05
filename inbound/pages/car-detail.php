<?php
    session_start();
    if($_SESSION['testdrive_admin'] !== true){
        header('Location: /404');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Test Drive</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="A77" name="description" />
    <meta content="A77" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Plugins css -->
    <link href="/assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@100;200;300;400;500;600;700;800&family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- App css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            font-family: 'Chakra Petch', sans-serif;
        }
        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
            font-family: 'Kanit', sans-serif;
            font-weight: 400;
        }
        .page-content {
            padding: calc(70px + 24px) calc(5px / 2) 70px calc(5px / 2);
        }
        .table {
            width: 100% !important;
        }
        .dtr-details {
            width: 100%;
        }
        .card-body {
            padding: 1rem;
        }
        .card {
            margin-bottom: 10px;
        }

        .home-content {
            margin-top: 60px;
        }
        .check-list p {
            margin-bottom: 5px;
            padding-left: 10px;
            font-size: 14px;
        }
        .red {
            color: red;
        }
        .green{
            color: green;
        }
        .swal-text {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php 
        include_once('inc-page/nav.php');
        include_once('inc-page/sidebar.php');
    ?>
    <div id="layout-wrapper">

        <div class="main-content" id="dedrive">

            <div class="page-content pt-4">
                <div class="container-fluid">

                    <div class="row home-content">
                        <div class="col-lg-6 col-md-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">รายละเอียด</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h4 class="card-title">ข้อมูล</h4>
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td width="150px">รหัส</td>
                                                <td>{{ detail.id }}</td>
                                            </tr>
                                            <tr>
                                                <td>รุ่นรถยนต์</td>
                                                <td>{{ detail.model }}</td>
                                            </tr>
                                            <tr>
                                                <td>สาขา</td>
                                                <td>   
                                                    <span v-if="detail.branch == 'ho'">สำนักงานใหญ่ (คลอง 7)</span>
                                                    <span v-else-if="detail.branch == 'tm'">ตลาดไท</span>
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>วันที่เพิ่ม</td>
                                                <td>{{ detail.datetime }}</td>
                                            <tr>
                                                <td>สถานะ</td>
                                                <td v-if="detail.status == '1'"><span class="badge badge-soft-success">ใช้งาน</span></td>
                                                <td v-else-if="detail.status == '10'"><span class="badge badge-soft-danger">ยกเลิก</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h4 class="card-title">จัดการรถทดลองขับ</h4>
                                    <a href="/admin/ce/<?php echo $id;?>" class="btn btn-warning mr-1">แก้ใข</a> <buttons  v-if="detail.status == '10'" class="btn btn-success" @click="Active">เปิดใช้งาน</buttons> <buttons v-else-if="detail.status == '1'" class="btn btn-danger" @click="deActive">ปิดใช้งาน</buttons>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <h4 class="card-title mb-0">อัพเดทรูปภาพ</h4>
                                        <small>ใช้ภาพขนาด 500 x 500 px เท่านั้น</small>
                                    </div>
                                    <form @submit.prevent="sendDataUp">
                                        <div class="form-group">
                                            <input type="file" name="file_upload_up" id="file_upload_up" @change="onFileChangeUp">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">อัพเดท</button>
                                        </div>
                                    </form>

                                    <hr>
                                    <h4 class="card-title">รูปภาพปัจจุบัน</h4>
                                   
                                    <img :src="detail.img" class="img-fluid" alt="Responsive image">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <h4 class="card-title mb-0">ประวัติการใช้งานรถยนต์</h4>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>วันที่</th>
                                                    <th>เลขไมล์</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="h in detail.history">
                                                    <td>{{ h.date }}</td>
                                                    <td>{{ h.mileage }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        2023 © Weise Tech.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                            Design & Develop by Weise Tech
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
  
    <div class="menu-overlay"></div>

    <!-- jQuery  -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/metismenu.min.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/simplebar.min.js"></script>

    <!-- third party js -->
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.bootstrap4.js"></script>
    <script src="/assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.flash.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.select.min.js"></script>
    <script src="/assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="/assets/plugins/datatables/vfs_fonts.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- third party js ends -->

    <script>
         var dedrive = new Vue({
            el: '#dedrive', 
            data: {
                detail: '',
                file_upload: {
                    file: null,
                },
                id: '<?php echo $id; ?>'

            },
            mounted () {
                axios.get('/inbound/system/car-detail.api.php?id=<?php echo $id; ?>').then(function(response) {
                    dedrive.detail = response.data.detail;
                });
            },
            methods: {
                Active() {
                    swal({
                        title: "เปิดใช้งาน",
                        text: "คุณต้องการเปิดใช้งานรถทดลองขับหรือไม่?",
                        icon: "warning", 
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            axios.get('/inbound/system/carDeactive.api.php?id=<?php echo $id; ?>&st=active').then(function(response) {
                                if(response.data.status == 200) {
                                    swal("เปิดใช้งานเรียบร้อย", {
                                        icon: "success",
                                    }).then(function() {
                                        location.reload();
                                    });
                                } else if(response.data.status == 500) {
                                    swal("เกิดข้อผิดพลาด", {
                                        icon: "error",
                                    });
                                } else if(response.data.status == 400) {
                                    swal("เกิดข้อผิดพลาด","คุณต้องอัพโหลดรูปรถยนต์ก่อน", {
                                        icon: "error",
                                    });
                                }
                            });
                        }
                    });
                },
                deActive() {
                    swal({
                        title: "ปิดใช้งาน",
                        text: "คุณต้องการปิดใช้งานรถทดลองขับหรือไม่?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            axios.get('/inbound/system/carDeactive.api.php?id=<?php echo $id; ?>&st=deactive').then(function(response) {
                                if(response.data.status == 200) {
                                    swal("ปิดใช้งานเรียบร้อย", {
                                        icon: "success",
                                    }).then(function() {
                                        location.reload();
                                    });
                                } else if(response.data.status == 500) {
                                    swal("เกิดข้อผิดพลาด", {
                                        icon: "error",
                                    });
                                }
                            });
                        }
                    });
                },
                onFileChangeUp(e) {
                    this.file_upload.file = e.target.files[0];
                },
                sendDataUp() {
                    if(this.file_upload.file == null) {

                        swal("โปรดตรวจสอบ", "คุณอาจยังไม่ได้เลือกประเภทเอกสาร หรือเลือกไฟล์เอกสาร", "warning",{ 
                            button: "ตกลง"
                        })

                    } else {
                        var formData = new FormData();
                        formData.append('file_upload', this.file_upload.file);
                        swal({
                            title: "กำลังอัพโหลด...",
                            text: "โปรดรอสักครู่ ระบบกำลังอัพโหลดเอกสารของคุณ",
                            icon: "info",
                            buttons: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false
                        });
                        axios.post('/inbound/system/cfimg.api.php',formData
                        ,{
                            headers: { 
                                'Content-Type': 'multipart/form-data'
                            },
                        }).then(res => {
                            var cfimg_link =  res.data.result.variants[1];

                            if(res.data.success == true)
                                axios.post('/inbound/system/cfimg_update_car.api.php',{
                                    aimg_link:  cfimg_link,
                                    aimg_parent: <?php echo $id; ?>
                                    
                                }).then(res => {
                                    if(res.data.status == 200)
                                        swal("สำเร็จ", "อัพโหลดเอกสารสำเร็จ", "success",{ 
                                            button: "ตกลง"
                                        }).then((value) => {
                                            location.reload(true)
                                        });

                                    if(res.data.status == 400)
                                        swal("ทำรายการไม่สำเร็จ", "อัพโหลดเอกสารไม่สำเร็จ อาจมีบางอย่างผิดปกติ (error : 400)", "warning",{ 
                                            button: "ตกลง"
                                        }
                                    );
                                });

                            if(res.data.success == false) 
                                swal("ทำรายการไม่สำเร็จ", "อัพโหลดเอกสารไม่สำเร็จ อาจมีบางอย่างผิดปกติ", "warning",{ 
                                    button: "ตกลง"
                                }
                            );

                        });
                    }

                }
            }
        });

        
    </script>
    <script src="/assets/js/theme.js"></script>

</body>

</html>