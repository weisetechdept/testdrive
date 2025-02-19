<?php
    session_start();
    date_default_timezone_set("Asia/Bangkok");
/*
    if($_SESSION['pp_login'] !== true && $_SESSION['pp_permission'] !== 'user'){
        header('Location: /404');
    }
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Alpha 77 Admin</title>
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
        input[type="date"] {
            display:block;
            -webkit-appearance: textfield;
            -moz-appearance: textfield;
            min-height: 1.2em; 
            min-width: 96%;
            padding: 0px 2px;
            border: 1px solid #ccc;
            border-radius: 3px;
            
        }
        .time-note {
            background-color: #efefef;
            padding: 10px;
            border-radius: 5px;
        }
        .time-note p {
            margin-bottom: 0;
        }
        .select-time {
            padding: 15px;
        }
        .strong {
            font-weight: bold;
        }
        .bg {
            padding: 15px 0 0 15px;
        }
        .span_pseudo, .chiller_cb span:before, .chiller_cb span:after {
            content: "";
            display: inline-block;
            background: #fff;
            width: 0;
            height: 0.2rem;
            position: absolute;
            transform-origin: 0% 0%;
        }
        .chiller_cb {
            position: relative;
            height: 2rem;
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .chiller_cb input {
            display: none;
        }
        .chiller_cb input:checked ~ span {
            background: #7266bb;
            border-color: #7266bb;
        }
        .chiller_cb input:checked ~ span:before {
            width: 1rem;
            height: 0.15rem;
            transition: width 0.1s;
            transition-delay: 0.3s;
        }
        .chiller_cb input:checked ~ span:after {
            width: 0.4rem;
            height: 0.15rem;
            transition: width 0.1s;
            transition-delay: 0.2s;
        }
        .chiller_cb input:disabled ~ span {
            background: #ececec;
            border-color: #dcdcdc;
        }
        .chiller_cb input:disabled ~ label {
            color: #dcdcdc;
        }
        .chiller_cb input:disabled ~ label:hover {
            cursor: default;
        }
        .chiller_cb label {
            padding-left: 2rem;
            position: relative;
            z-index: 2;
            cursor: pointer;
            margin-bottom:0;
        }
        .chiller_cb span {
            display: inline-block;
            width: 1.2rem;
            height: 1.2rem;
            border: 2px solid #ccc;
            position: absolute;
            left: 0;
            transition: all 0.2s;
            z-index: 1;
            box-sizing: content-box;
        }
        .chiller_cb span:before {
            transform: rotate(-55deg);
            top: 1rem;
            left: 0.37rem;
        }
        .chiller_cb span:after {
            transform: rotate(35deg);
            bottom: 0.35rem;
            left: 0.2rem;
        }
        #checktime {
            display: none;
        }
        .bk_detail {
            display: none;
        }
    </style>
</head>

<body>
    <?php include_once('include/nav.php'); ?>
    <?php include_once('include/sidebar.php'); ?>

    <div class="mt-3" id="layout-wrapper">

        <div class="main-content">

            <div class="page-content pt-4" id="testdrive">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">จองรถทดลองขับ</h4>
                            </div>
                        </div>
                    </div>  
                    
                    <div class="row">
                        <div class="col-12">
                            <a href="/mgr/agent/active">
                                <div class="card bg-success border-success">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <h5 class="card-title mb-0 text-white">สิทธิ์การจองคงเหลือ</h5>
                                        </div>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center text-white mb-0">
                                                    {{ sales.quota }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                        <div class="form-group">
                                            <label>จุดประสงค์</label>
                                            <div class="form-group">
                                                <div class="rdo-grp">
                                                    <h5>ทดลองขับ</h5>
                                                    <input id="rdo1" type="radio" @click="changeObj01" name="radio"/>
                                                    <label class="mr-2" for="rdo1"><span></span><span>มาที่โชว์รูม</span></label>

                                                    <input id="rdo1" type="radio" @click="changeObj04" name="radio"/>
                                                    <label for="rdo1"><span></span><span>นอกสถานที่</span></label>

                                                    <h5 class="mt-2">ใช้งานอื่นๆ</h5>

                                                    <input id="rdo2" type="radio" @click="changeObj02" name="radio"/>
                                                    <label class="mr-2" for="rdo2"><span></span><span>ทำคอนเท้นต์</span></label>

                                                    <input id="rdo3" type="radio" @click="changeObj03" name="radio"/>
                                                    <label for="rdo3"><span></span><span>ออกบูธ</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row bk_detail">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">{{ display.input01 }}</label>
                                            <input type="text" id="fname" v-model="selected.fname" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">{{ display.input02 }}</label>
                                            <input type="text" id="lname" v-model="selected.lname" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">{{ display.input03 }}</label>
                                            <input type="text" id="tel" v-model="selected.tel" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3 to-event">
                                        <div class="form-group">
                                            <label>ชื่องาน และสถานที่นำรถไปออกบูธ</label>
                                            <textarea id="tel" v-model="selected.event" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">สาขา</label>
                                            <select class="form-control" v-model="selected.branch" @change="getCar">
                                                <option value="0">= เลือกสาขา =</option>
                                                <option value="ho">สำนักงานใหญ่ (รังสิตคลอง 7)</option>
                                                <option value="tm">ตลาดไท</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3" id="carimg" style="display:none;text-align: center;">
                                        <img :src="selected.carimg" style="width: 100%;max-width: 250px;">
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">รถทดลองขับ</label>
                                            <select id="car" name="car" v-model="selected.car" @change="getDate" class="form-control" disabled>
                                                <option value="0">= เลือกรถทดลองขับ =</option>
                                                <option v-for="c in bk.car" :value="c.id">{{ c.model }}</option>
                                            </select>
                                        </div>
                                    </div>
                                 
                                  
                                        <div class="form-group">
                                            <label for="date">วันที่จอง</label>
                                            <input type="date" id="date" class="form-control" v-model="selected.date" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" @change="getTime" disabled>
                                        </div>

                                        <div class="mb-3" id="checktime">
                                        

                                            <div class="form-group">
                                            
                                                <label for="time">เวลาจอง</label>
                                                <div class="mt-1">
                                                    <div class="form-group">
                                                        <div class="time-note">
                                                            <p class="strong">หมายเหตุ</p>
                                                            <p>1. กรุณาเลือกเวลาที่ต้องการจอง</p>
                                                            <p>2. สามารถจองได้มากกว่า 1 ช่วงเวลาตามความต้องการ</p>
                                                            <p>3. เวลาในการจองต้องเป็นช่วงเวลาที่ติดต่อกันเท่านั้น</p>
                                                        </div>
                                                        <div class="bg">
                                                            <div class="chiller_cb" v-for="t in bk.time" :key="t.id">
                                                                <input type="checkbox" class="time" :id="'myCheckbox'+t.id"  @change="handleChange" :value="t.id" :disabled="t.status == 0">
                                                                <label class="ml-2" :for="'myCheckbox'+t.id">ช่วงเวลา {{ t.time }} น.</label>
                                                                <span></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                    
                                            </div>
                                        
                                        </div>


                                        <button class="btn btn-primary waves-effect waves-light" @click="sendData">จองรถ</button>
                                   
                                       
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

    <script>
       var testdrive = new Vue({
            el: '#testdrive',
            data: {
                display: {
                    input01: '',
                    input02: '',
                    input03: '',
                },
                sales:{
                    id: '',
                    quota: 0
                },
                bk:{
                    car: [],
                    time: [],
                },
                selected: {
                    fname: '',
                    lname: '',
                    branch: '0',
                    car: '0',
                    date: '',
                    time: '0',
                    carimg: '',
                    tel:'',
                    note:'',
                    where:'',
                    event:'',
                },
                selectedRows: []
            },
            mounted: function() {
                axios.get('/sales/system/booking.api.php?get=sales').then(function(response) {
                    testdrive.sales.id = response.data.sales.id;
                    testdrive.sales.quota = response.data.sales.quota;
                });

                var currentDate = new Date();
                currentDate.setDate(currentDate.getDate() + 7);
                var year = currentDate.getFullYear();
                var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
                var day = currentDate.getDate().toString().padStart(2, '0');
                var maxDate = year + '-' + month + '-' + day;
                document.getElementById('date').setAttribute('max', maxDate);
            
            },
            methods: {
                changeObj01: function() {
                    this.display.input01 = 'ชื่อลูกค้า (ไม่ใส่คำนำหน้า)';
                    this.display.input02 = 'นามสกุล (ลูกค้า)';
                    this.display.input03 = 'เบอร์โทรศัพท์ (ลูกค้า)';
                    document.querySelector('.to-event').style.display = 'none';
                    document.querySelector('.bk_detail').style.display = 'block';
                    this.selected.note = '';
                    this.selected.where = '2';
                },
                changeObj02: function() {
                    this.display.input01 = 'ชื่อ (ผู้รับผิดชอบ)';
                    this.display.input02 = 'นามสกุล (ผู้รับผิดชอบ)';
                    this.display.input03 = 'เบอร์โทรศัพท์ (ผู้รับผิดชอบ)';
                    document.querySelector('.to-event').style.display = 'none';
                    document.querySelector('.bk_detail').style.display = 'block';
                    this.selected.note = '';
                    this.selected.where = '5';
                },
                changeObj03: function() {
                    this.display.input01 = 'ชื่อ (ผู้รับผิดชอบ)';
                    this.display.input02 = 'นามสกุล (ผู้รับผิดชอบ)';
                    this.display.input03 = 'เบอร์โทรศัพท์ (ผู้รับผิดชอบ)';
                    document.querySelector('.to-event').style.display = 'block';
                    document.querySelector('.bk_detail').style.display = 'block';
                    this.selected.where = '6';
                },
                changeObj04: function() {
                    this.display.input01 = 'ชื่อลูกค้า (ไม่ใส่คำนำหน้า)';
                    this.display.input02 = 'นามสกุล (ลูกค้า)';
                    this.display.input03 = 'เบอร์โทรศัพท์ (ลูกค้า)';
                    document.querySelector('.to-event').style.display = 'none';
                    document.querySelector('.bk_detail').style.display = 'block';
                    this.selected.note = '';
                    this.selected.where = '7';
                },
                handleChange(e) {
                    const { value, checked } = e.target
                    if (checked) {
                        this.selectedRows.push(value)
                    } else {
                        const index = this.selectedRows.findIndex(id => id === value)
                        if (index > -1) {
                            this.selectedRows.splice(index, 1)
                        }
                    }
                },
                getCar(e) {
                    axios.post('/sales/system/booking.api.php?get=car', {
                        branch: e.target.value
                    }).then(function(response) {
                        
                        testdrive.bk.car = response.data.car;
                        
                        document.getElementById('car').disabled = false;

                        testdrive.selected.car = '0';
                        testdrive.selected.date = '';
                        testdrive.selected.time = '0';

                        document.getElementById('date').disabled = true;
                        //document.getElementById('time').disabled = true;
                        document.getElementById('checktime').style.display = 'none';
                        document.getElementById('carimg').style.display = 'none';
                    });
 
                },
                getDate(e) {
                    testdrive.selected.car = e.target.value;
                    document.getElementById('date').disabled = false;

                    testdrive.selected.carimg = testdrive.bk.car.find(x => x.id == e.target.value).img;
                    document.getElementById('carimg').style.display = 'block';

                    testdrive.selected.date = '';
                    testdrive.selected.time = '0';

                    document.getElementById('checktime').style.display = 'none';
                },
                getTime(e) {
                    this.selectedRows = [];
                    document.querySelectorAll('.time').forEach(function(element) {
                        element.checked = false;
                    });

                    //document.getElementById('time').disabled = false;
                    document.getElementById('checktime').style.display = 'block';
                    axios.post('/sales/system/booking.api.php?get=time-new', {
                        date: e.target.value,
                        car: testdrive.selected.car
                    }).then(function(response) {
                        testdrive.bk.time = response.data.time;
                    });
                },
                sendData() {
                    
                    if(testdrive.selected.branch == '0' || testdrive.selected.car == '0' || testdrive.selected.date == '0' || testdrive.selected.time == '' || testdrive.selected.fname == '' || testdrive.selected.lname == '' || testdrive.selected.tel == ''){
                        swal("โปรดตรวจสอบ","กรุณากรอกข้อมูลให้ครบถ้วน", {
                            icon: "warning",
                        });
                        return;
                    } else {
                        
                        axios.post('/sales/system/booking-new.ins.php',{
                            id: testdrive.sales.id,
                            car: testdrive.selected.car,
                            date: testdrive.selected.date,
                            time: testdrive.selectedRows,
                            fname: testdrive.selected.fname,
                            lname: testdrive.selected.lname,
                            tel: testdrive.selected.tel,
                            where: testdrive.selected.where,
                            note: testdrive.selected.note,
                            event: testdrive.selected.event
                        }).then(function(response) {
                            console.log(response.data);
                            if(response.data.status == 'success'){
                                swal("สำเร็จ", "เพิ่มสมาชิกเรียบร้อย", "success",{ 
                                    button: "ตกลง"
                                }).then((value) => {
                                    window.location.href = "/sales/de/"+response.data.id;
                                });
                                
                            } else if(response.data.status == 'failed'){
                                swal("โปรดตรวจสอบ",response.data.message, {
                                    icon: "error",
                                });
                            }

                        });

                    }

                    
                }
            }
        });

        
    </script>
    <script src="/assets/js/theme.js"></script>

</body>

</html>