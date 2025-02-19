<?php
    session_start();
    if($_SESSION['pp_login'] !== true && $_SESSION['pp_permission'] !== 'leader'){
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
    <?php include_once('include/nav.php'); ?>
    <?php include_once('include/sidebar.php'); ?>
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
                        <div class="col-lg-6 col-md-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                   
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>รหัส</td>
                                                <td>{{ detail.id }}</td>
                                            </tr>
                                            <tr>
                                                <td>ชื่อ - นามสกุล</td>
                                                <td>{{ detail.name }}</td>
                                            </tr>
                                            <tr>
                                                <td>โทรศัพท์</td>
                                                <td>{{ detail.tel }} <a :href="'tel:'+detail.tel" type="button" style="float: right;" class="btn btn-info btn-sm waves-effect waves-light">โทร</button>
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>รถยนต์</td>
                                                <td>{{ detail.car }}</td>
                                            </tr>
                                            <tr>
                                                <td>วันที่จอง</td>
                                                <td>{{ detail.bk_date }}</td>
                                            <tr>
                                                <td>เวลาที่จอง</td>
                                                <td>{{ detail.bk_time }}</td>
                                            </tr>
                                            <tr>
                                                <td>หมายเหตุ</td>
                                                <td>{{ detail.bk_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>สถานะ</td>
                                                <td v-if="detail.status == '0'"><span class="badge badge-soft-warning">ยังไม่ทดลองขับ</span></td>
                                                <td v-else-if="detail.status == '1'"><span class="badge badge-soft-primary">เบิกกุญแจ</span></td>
                                                <td v-else-if="detail.status == '2'"><span class="badge badge-soft-success">สำเร็จ</span></td>
                                                <td v-else-if="detail.status == '10'"><span class="badge badge-soft-danger">ยกเลิก</span></td>
                                            </tr>
                                            <tr>
                                                <td>วันที่ขอจอง</td>
                                                <td>{{ detail.create }}</td>
                                            </tr>
                                            <tr>
                                                <td>แหล่งที่มา</td>
                                                <td v-if="detail.where == '1'"><span class="badge badge-soft-success">ออนไลน์</span></td>
                                                <td v-else-if="detail.where == '2'"><span class="badge badge-soft-primary">เซลล์</span></td>
                                                <td v-else-if="detail.where == '3'"><span class="badge badge-soft-info">TBR</span></td>
                                                <td v-else-if="detail.where == '4'"><span class="badge badge-soft-secondary">Walk-in</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div>
                                        <button type="button" class="btn btn-outline-info waves-effect waves-light mb-2 mr-1 mt-4" @click="confBk">ลูกค้าจองรถจากการทดลองขับครั้งนี้</button>
                                    </div>
                                    <button @click="deBooking" v-if="detail.status == '0'" class="btn btn-danger mt-2">ยกเลิกการจอง</button>
                                    <a href="/mgr/send/<?php echo $id; ?>" class="btn btn-outline-warning mt-2">โยกลูกค้าจอง</a>
                                      
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="detail.status == '1' || detail.status == '2'" class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-2 font-size-18">อัพเดทเลขไมล์ คืนกุญแจ</h4>
                                    
                                    <div class="check-list mb-3">
                                        <div v-if="up_img.link !== null">
                                            <p class="green"><i class="mdi mdi-check-circle-outline"></i> รูปถ่ายเลขไมล์รถยนต์</p>
                                            <img :src="up_img.link" class="mt-4" width="100%">
                                        </div>
                                        <div v-else>
                                            <p>กรุณาอัพโหลดรูป และอัพเดทเลขไมล์รถยนต์ ก่อนคืนกุญแจ</p>
                                            <p class="red mb-4">
                                                <i class="mdi mdi-close-circle-outline"></i> รูปถ่ายเลขไมล์รถยนต์
                                            </p>
                                            <form @submit.prevent="sendDataUp">
                                                <div class="form-group">
                                                    <input type="file" name="file_upload_up" id="file_upload_up" @change="onFileChangeUp">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control mb-2" v-model="mileage" placeholder="เลขไมล์ปัจจุบัน (ตัวเลขเท่านั้น)">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">อัพเดท</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" v-if="detail.status == '0'">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-2 font-size-18">เอกสารที่ต้องใช้</h4>
                                    <div class="check-list">
                                        <p v-if="docs.docs2 >= 1" class="green"><i class="mdi mdi-check-circle-outline"></i> ใบขับขี่ผู้ทดลองขับ</p>
                                        <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> ใบขับขี่ผู้ทดลองขับ</p>
                                        <p v-if="docs.docs3 >= 1" class="green"><i class="mdi mdi-check-circle-outline"></i> เอกสารยินยอมข้อตกลงทดลองขับ</p>
                                        <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i> เอกสารยินยอมข้อตกลงทดลองขับ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" v-if="detail.status == '0'">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="mb-2 font-size-18">อัพโหลดเอกสาร</h4>
                                    <form @submit.prevent="sendData">
                                        <div class="form-group">
                                            <select class="form-control" v-model="file_upload.type">
                                                <option value="0">เลือกประเภทเอกสาร</option>
                                                <option value="1">บัตร ปชช.</option>
                                                <option value="2">ใบขับขี่ผู้ทดลองขับ</option>
                                                <option value="3">เอกสารยินยอมข้อตกลงทดลองขับ</option>
                                                <option value="3">เอกสารยินยอมจาก ผจก.ทีม (กรณีนำรถไปหาลูดค้านอก)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="file_upload" id="file_upload" @change="onFileChange">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">อัพโหลด</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="row" v-for="docs in docs_img">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <img :src="docs.link" width="100%">
                                    <a :href="docs.link" type="button" class="btn btn-sm btn-primary waves-effect waves-light mt-2" style="width: 100%; margin-top: 10px;">รูปขนาดเต็ม</a>
                                    <p class="mt-1 mb-0">เอกสาร : {{ docs.type }}<br />อัพโหลดเมื่อ : {{ docs.datetime }}</p>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- third party js ends -->

    <script>
         var dedrive = new Vue({
            el: '#dedrive',
            data: {
                detail: [],
                file_upload: {
                    type: 0,
                    file: null
                },
                docs: [],
                docs_img: [],
                up_img: [],
                mileage: '',
                car_update: {
                    type: 10,
                    file: null
                }
            },
            mounted () {
                axios.get('/mgr/system/detail.api.php?id=<?php echo $id; ?>').then(function(response) {
                    dedrive.detail = response.data.detail;
                    dedrive.docs = response.data.docs;
                });

                axios.get('/mgr/system/docs.api.php?u=<?php echo $id; ?>')
                .then(response => (
                    dedrive.docs_img = response.data.img,
                    dedrive.up_img = response.data.up_img

                ))
            },
            
            methods: {
                confBk(){
                    swal({
                        title: "ยืนยันการจอง",
                        text: "คุณต้องยืนยันว่าเกิดการจองขึ้นจากการทดลองขับรถยนต์ครั้งนี้ใช่หรือไม่",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willBk) => {
                        if (willBk) {
                            axios.post('/mgr/system/booking-conf.api.php',{
                                id: <?php echo $id; ?>
                            }).then(res => {
                                if(res.data.status == 200) {
                                    swal("สำเร็จ", "จองรถสำเร็จ", "success",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        location.reload(true)
                                    });
                                } else if(res.data.status == 500) {
                                    swal("ทำรายการไม่สำเร็จ", "จองรถไม่สำเร็จ อาจมีบางอย่างผิดปกติ", "warning",{ 
                                        button: "ตกลง"
                                    });
                                } else if(res.data.status == 400) {
                                    swal("ทำรายการไม่สำเร็จ", "รายการทดลองขับนี้ทำการบันทึกจองเรียบร้อยแล้ว", "warning",{ 
                                        button: "ตกลง"
                                    });
                                }
                            });
                        }
                    });
                },
                deBooking() {
                    swal({
                        title: "ยืนยันการยกเลิก",
                        text: "คุณต้องการยกเลิกการจองนี้ใช่หรือไม่ \n หากยกเลิกจะต้องทำล่วงหน้า 2 วันก่อนวันที่จองเท่านั้น",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            axios.post('/mgr/system/debooking.api.php',{
                                id: <?php echo $id; ?>
                            }).then(res => {
                                //console.log(res);
                                if(res.data.status == 200) 
                                    swal("สำเร็จ", "ยกเลิกการจองสำเร็จ", "success",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        location.reload(true)
                                    });
                                if(res.data.status == 500) 
                                    swal("ทำรายการไม่สำเร็จ", "ยกเลิกการจองไม่สำเร็จ จำเป็นต้องยกเลิก \n ล่วงหน้าก่อนถึงวันจอง 2 วัน", "warning",{ 
                                        button: "ตกลง"
                                    }
                                );
                                
                            });
                        }
                    });
                },
                onFileChange(e) {
                    this.file_upload.file = e.target.files[0];
                },
                sendData() {
                    if(this.file_upload.type == 0 || this.file_upload.file == null) {
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

                    
                        axios.post('/mgr/system/cfimg.api.php',formData
                        ,{
                            headers: { 
                                'Content-Type': 'multipart/form-data'
                            },
                        }).then(res => {
                            var cfimg_id =  res.data.result.id;
                            var cfimg_link =  res.data.result.variants[1];

                            if(res.data.success == true) 

                                axios.post('/mgr/system/cfimg_verify.api.php',{
                                    aimg_type: this.file_upload.type,
                                    aimg_img_id: cfimg_id,
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

                },
                onFileChangeUp(e) {
                    this.car_update.file = e.target.files[0];
                },
                sendDataUp() {
                    if(this.car_update.file == null || this.mileage == '') {
                        swal("โปรดตรวจสอบ", "คุณอาจยังไม่ได้กรอกเลขไมล์ หรือเลือกไฟล์เอกสาร", "warning",{ 
                            button: "ตกลง"
                        }) 
                    } else {
                        var formData = new FormData();
                        formData.append('file_upload', this.car_update.file);
                        
                        swal({
                            title: "กำลังอัพโหลด...",
                            text: "โปรดรอสักครู่ ระบบกำลังอัพโหลดเอกสารของคุณ",
                            icon: "info",
                            buttons: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false
                        });

                    
                        axios.post('/mgr/system/cfimg.api.php',formData
                        ,{
                            headers: { 
                                'Content-Type': 'multipart/form-data'
                            },
                        }).then(res => {
                            var cfimg_up_id =  res.data.result.id;
                            var cfimg_up_link =  res.data.result.variants[1];

                            if(res.data.success == true) 

                                axios.post('/mgr/system/cfimg_update.api.php',{
                                    aimg_img_id: cfimg_up_id,
                                    aimg_link:  cfimg_up_link,
                                    aimg_parent: <?php echo $id; ?>,
                                    aimg_mileage: this.mileage
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