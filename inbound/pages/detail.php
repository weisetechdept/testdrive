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

    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <link href="/assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@100;200;300;400;500;600;700;800&family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
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

        #overlay{
            border:1px solid black;
            width:450px;
            height:350px;
            display:inline-block;
            background-repeat:no-repeat;
        }
        
        .zoom-overlay {
            position: absolute;
            border-radius: 5px;
            width: 450px;
            height: 350px;
            background-repeat: no-repeat;
            display: none;
            margin-left: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .zoom-image {
            object-fit: cover;
            border-radius: 5px;
        }
        .zoom-container {
            position: relative;
            display: block;
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
                                                <td>เลขบัตร ปชช.</td>
                                                <td>{{ detail.nlsID }}</td>
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
                                                <td>เซลล์ผู้ดูแล</td>
                                                <td>{{ detail.parent }}</td>
                                            </tr>
                                            <tr>
                                                <td>หมายเหตุ</td>
                                                <td>{{ detail.bk_note }}</td>
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
                                                <td v-else-if="detail.where == '5'"><span class="badge badge-soft-secondary">ทำคอนเท้นต์</span></td>
                                                <td v-else-if="detail.where == '6'"><span class="badge badge-soft-secondary">ออกบูธ</span></td>
                                                <td v-else-if="detail.where == '7'"><span class="badge badge-soft-secondary">นอกสถานที่</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" v-if="detail.where == '6'">
                        <div class="col-lg-6 col-md-12">
                                <div class="alert alert-info" role="alert">รายการนี้จะนำไปใช้: {{ detail.bk_note }}</div>
  
                        </div>
                    </div>

                    <div class="row" v-if="detail.status !== '2'">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <div  v-if="detail.status == '0'">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">

                                                        <img class="zoom-image mb-3" :id="'imgZoom_' + verifyDLS.img_id" width="100%" height="350px" :onmousemove="'zoomIn(event, ' + verifyDLS.img_id + ')'" :onmouseout="'zoomOut(' + verifyDLS.img_id +')'" :src="verifyDLS.img">
                                                        

                                                        <div class="zoom-overlay" :id="'overlay_' + verifyDLS.img_id" v-bind:style="{ backgroundImage: 'url(' + verifyDLS.img + ')' }"></div>

                                                        
                                                        <p class="mt-0 mb-0">อัพโหลดเมื่อ : {{ verifyDLS.datetime }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h4 class="mb-2 font-size-14">*โปรดกรอกเลขบัตร ปชช. ลูกค้าให้ถูกต้อง ก่อนจ่ายกุญแจ</h4>
                                            <input class="form-control" v-model="nlsID" type="number">
                                        </div>
                                    </div>

                                    <h4 class="mb-2 font-size-18">จัดการ การจองนี้</h4>
                                    
                                    <div>
                                        <button v-if="detail.status == '0'" type="button" class="btn btn-info waves-effect waves-light mb-2 mr-1" @click="giveKey">จ่ายกุญแจแล้ว</button>
                                        <button v-if="detail.status == '1'" type="button" class="btn btn-success waves-effect waves-light mb-2 mr-1" @click="reKey">คืนกุญแจแล้ว</button>
                                        <button v-if="detail.status == '0'" type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-1" @click="deBooking">ยกเลิกการจอง</button>
                                        <a href="/admin/detail/mv/<?php echo $id; ?>" v-if="detail.status == '0'" type="button" class="btn btn-outline-warning waves-effect waves-light mb-2 mr-1">ย้ายการจอง</a>
                                        <button v-if="detail.status == '10'" type="button" class="btn btn-warning waves-effect waves-light mb-2 mr-1" @click="resetStatus">รีเซทสถานะ</button>

                                        <button v-if="detail.status == '1'" type="button" @click="sendNotify" class="btn btn-outline-info waves-effect waves-light mb-2 mr-1">แจ้งเอกสารไม่ครบ</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="detail.status == '2'">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">จัดการการทดลองขับนี้</h4>
                                        <div>
                                            <button type="button" class="btn btn-outline-info waves-effect waves-light mb-2 mr-1" @click="confBk">ลูกค้าจองรถจากการทดลองขับครั้งนี้</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="detail.status == '1' || detail.status == '2'">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">อัพเดทเลขไมล์ คืนกุญแจ</h4>
                                        <p class="red">หมายเหตุ : โปรดตรวจเลขไมล์ให้ตรงกับรูปก่อนกดรับคืนกุญแจ หากเลขไมล์ไม่ตรงสามารถแก้ใขตัวเลขในช่องได้ทันที</p> 
                                        <div class="form-group">
                                            <label>เลขไมล์ :</label>
                                            <input type="text" v-model="send.mileage" class="form-control">
                                        </div>

                                        <div class="check-list mb-3">
                                            <!-- <p v-if="docs.docs3 >= 1" class="green"><i class="mdi mdi-check-circle-outline"></i> รูปถ่ายคู่กับลูกค้าและรถทดลองขับ (เห็นเลขทะเบียนรถฯ)</p> -->
                                            <p v-else class="red"><i class="mdi mdi-close-circle-outline"></i>  รูปถ่ายคู่กับลูกค้าและรถทดลองขับ (เห็นเลขทะเบียนรถฯ)</p>

                                            <div v-if="up_img !== ''">
                                                <p class="green"><i class="mdi mdi-check-circle-outline"></i> รูปถ่ายเลขไมล์รถยนต์</p>
                                                <img :src="up_img.link" class="mt-4" width="100%">
                                            </div>
                                            <div v-else>
                                                <p class="red mb-0">
                                                    <i class="mdi mdi-close-circle-outline"></i> รูปถ่ายเลขไมล์รถยนต์
                                                </p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>อัพโหลดรูปเลขไมล์</h4>
                                        <form @submit.prevent="sendDataUp">
                                            <div class="form-group">
                                                <input type="file" class="dropify" data-height="150" name="file_upload" id="file_upload" @change="onFileChange" />
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div>

                    <div class="row">
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

                    <div class="row">
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
                                                <option value="4">รูปถ่ายคู่กับลูกค้าและรถทดลองขับ (เห็นเลขทะเบียนรถฯ)</option>
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

    <script src="/assets/plugins/dropify/dropify.min.js"></script>
 
    <script>
         var dedrive = new Vue({
            el: '#dedrive',
            data: {
                detail: [],
                file_upload: {
                    type: 0,
                    file: null
                },
                docs: '',
                docs_img: '',
                verifyDLS: [],
                nlsID: '',
                up_img: '',
                mileage: '',
                car_update: {
                    type: 10,
                    file: null
                },
                send: {
                    mileage: '',
                    id: '',
                    car: ''
                }
            },
            mounted () {
                
                axios.get('/inbound/system/detail.api.php?id=<?php echo $id; ?>').then(function(response) {
                    dedrive.detail = response.data.detail;
                    dedrive.docs = response.data.docs;
                    dedrive.send.car = response.data.detail.car_id;
                    console.log(response);
                });
 
                axios.get('/inbound/system/docs.api.php?u=<?php echo $id; ?>')
                .then(response => (
                    dedrive.docs_img = response.data.img,
                    dedrive.up_img = response.data.up_img,
                    dedrive.send.mileage = response.data.up_img.mileage,
                    dedrive.send.id = response.data.up_img.up_id,
                    dedrive.verifyDLS = response.data.verifyDLS
                    
                    
                ))

                $('.dropify').dropify({
                    messages: {
                        'default': 'แตะเพื่ออัพโหลดรูป',
                        'replace': 'แตะเพื่ออัพโหลดรูปแก้ใข',
                        'remove': 'ลบรูปภาพ',
                        'error': 'เกิดข้อมผิดพลาด โปรดลองใหม่อีกครั้ง'
                    },
                    error: {
                        'fileSize': 'ขนาดของรูปเกินปริมาณที่กำหนด (1M max).'
                    }
                });
            },

            watch: {
                docs() {
                    this.$nextTick(() => {
                        this.initializeDropify();
                    });
                },
            },
            methods: {
                confBk(){
                    swal({
                        title: "ยืนยันการจอง",
                        text: "คุณต้องยืินยันว่าเกิดการจองขึ้นจากการทดลองขับรถยนต์ครั้งนี้ใช่หรือไม่",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willBk) => {
                        if (willBk) {
                            axios.post('/inbound/system/booking-conf.api.php',{
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
                initializeDropify() {
                    this.$nextTick(() => {
                        $('.dropify').dropify(); // เรียก Dropify
                    });
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
                    
                        axios.post('/sales/system/cfimg.api.php',formData
                        ,{
                            headers: { 
                                'Content-Type': 'multipart/form-data'
                            }, 
                        }).then(res => {
                            var cfimg_up_id =  res.data.result.id;
                            var cfimg_up_link =  res.data.result.variants[1];

                            if(res.data.success == true) 

                                axios.post('/sales/system/cfimg_update.api.php',{
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

                },
                resetStatus(){
                    swal({
                        title: "ยืนยันการรีเซทสถานะ",
                        text: "คุณต้องการรีเซทสถานะจองนี้ใช่หรือไม่",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            axios.post('/inbound/system/resetstatus.api.php',{
                                id: <?php echo $id; ?>
                            }).then(res => {
                                if(res.data.status == 200) 
                                    swal("สำเร็จ", "รีเซทสถานะสำเร็จ", "success",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        location.reload(true)
                                    });
                                if(res.data.status == 500) 
                                    swal("ทำรายการไม่สำเร็จ", res.data.message, "warning",{ 
                                        button: "ตกลง"
                                    }
                                );
                            });
                        }
                    });
                },
                sendNotify(){
                    swal("ใส่ข้อความที่ต้องการแจ้ง (หรือไม่ใส่ก็ได้) :", {
                        content: "input",
                    })
                    .then((value) => {
                        
                        axios.post('/inbound/system/notify.api.php',{
                            id: <?php echo $id; ?>,
                            msg: value
                        }).then(res => {
                            if(res.data.status == 200){
                                swal("สำเร็จ", "แจ้งเตือนสำเร็จ", "success",{ 
                                    button: "ตกลง"
                                })
                            }
                            if(res.data.status == 500){
                                swal("ทำรายการไม่สำเร็จ", "แจ้งเตือนไม่สำเร็จ อาจมีบางอย่างผิดปกติ", "warning",{ 
                                    button: "ตกลง"
                                    }
                                );
                            }
                        });
                        
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
                            axios.post('/sales/system/debooking.api.php',{
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

                    
                        axios.post('/inbound/system/cfimg.api.php',formData
                        ,{
                            headers: { 
                                'Content-Type': 'multipart/form-data'
                            },
                        }).then(res => {
                            console.log(res);
                            var cfimg_id =  res.data.result.id;
                            var cfimg_link =  res.data.result.variants[1];

                            if(res.data.success == true) 

                                axios.post('/inbound/system/cfimg_verify.api.php',{
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
                 
                giveKey() {
                    if(dedrive.nlsID === ''){
                        swal("โปรดตรวจสอบ", "คุณอาจยังไม่ได้กรอกเลขบัตรประชาชน", "warning",{ 
                            button: "ตกลง"
                        })
                    } else {
                        swal({
                            title: "ยืนยันการเบิกกุญแจ",
                            text: `คุณได้ตรวจสอบเอกสารถูกต้องครบถ้วนแล้ว ใช่หรือไม่?`,
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        }).then((willDelete) => {
                            if (willDelete) {
                                axios.post('/inbound/system/givekey.api.php',{
                                    id: <?php echo $id; ?>,
                                    people_id: dedrive.nlsID
                                }).then(res => {
                                    console.log(res);
                                    if(res.data.status == 200) 
                                        swal("สำเร็จ", "เบิกกุญแจสำเร็จ", "success",{ 
                                            button: "ตกลง"
                                        }).then((value) => {
                                            location.reload(true)
                                        });
                                    if(res.data.status == 500) 
                                        swal("ทำรายการไม่สำเร็จ", "เบิกกุญแจไม่สำเร็จ อาจมีบางอย่างผิดปกติ", "warning",{ 
                                            button: "ตกลง"
                                        }
                                    );
                                    if(res.data.status == 400) 
                                        swal("ทำรายการไม่สำเร็จ", "เอกสารที่ต้องใช้ ไม่ครบถ้วน กรุณาตรวจสอบอีกครั้ง", "warning",{ 
                                            button: "ตกลง"
                                        }
                                    );
                                });
                            }
                        });
                    }
                },
                deBooking() {
                    swal({
                        title: "ยืนยันการยกเลิก",
                        text: "คุณต้องการยกเลิกการจองนี้ใช่หรือไม่",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            axios.post('/inbound/system/debooking.api.php',{
                                id: <?php echo $id; ?>
                            }).then(res => {
                                if(res.data.status == 200) 
                                    swal("สำเร็จ", "ยกเลิกการจองสำเร็จ", "success",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        location.reload(true)
                                    });
                                if(res.data.status == 500) 
                                    swal("ทำรายการไม่สำเร็จ", "โปรดตรวจสอบความถูกต้องอีกครั้ง", "warning",{ 
                                        button: "ตกลง"
                                    }
                                );
                                
                            });
                        }
                    });
                },
                reKey() {
                    swal({
                        title: "ยืนยันการคืนกุญแจ",
                        text: "คุณตรวจสอบเอกสารก่อนคืนกุฐแจแล้ว \n และต้องการคืนกุญแจใช่หรือไม่",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            axios.post('/inbound/system/rekey.api.php',{
                                id: <?php echo $id; ?>,
                                mileage: this.send.mileage,
                                up_id: this.send.id,
                                car_id: this.send.car
                            }).then(res => {
                                if(res.data.status == 200) 
                                    swal("สำเร็จ", "คืนกุญแจสำเร็จ", "success",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        location.reload(true)
                                    });
                                if(res.data.status == 500) 
                                    swal("ทำรายการไม่สำเร็จ", "โปรดตรวจสอบความถูกต้องอีกครั้ง", "warning",{ 
                                        button: "ตกลง"
                                    }
                                );

                                if(res.data.status == 501) 
                                    swal("ทำรายการไม่สำเร็จ", "เลขไมล์ที่บันทึกน้อยกว่าปัจจุบัน ไม่สามารถบันทึกได้", "warning",{ 
                                        button: "ตกลง"
                                    }
                                );
                                
                            });
                        }
                    });
                }
                
            }
        });

        function zoomIn(event, index) {
            var element = document.getElementById("overlay_" + index);
            element.style.display = "inline-block";
            var img = document.getElementById("imgZoom_" + index);
            var posX = event.offsetX ? (event.offsetX) : event.pageX - img.offsetLeft;
            var posY = event.offsetY ? (event.offsetY) : event.pageY - img.offsetTop;
            element.style.backgroundPosition=(-posX*1.35)+"px "+(-posY*1.75)+"px";
        }

        function zoomOut(index) {
            var element = document.getElementById("overlay_" + index);
            element.style.display = "none";
        }
    </script>

    <script src="/assets/js/theme.js"></script>

</body>

</html>