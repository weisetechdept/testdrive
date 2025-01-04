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
    <title>Alpha X Admin</title>
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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
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
        .select2-container {
            width: 100% !important;
            height: 30px !important;
        }
        /* จองเวลา */
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
            padding: 15px 0 0 45px;
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

    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php 
            include_once('inc-page/nav.php');
            include_once('inc-page/sidebar.php');
        ?>
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div id="testdrive">
                        <div class="row">
                            <div class="col-12 offset-md-1 col-md-10 offset-lg-3 col-lg-6">
                            <div class="card">
                                <div class="card-body">

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">ชื่อ (ไม่ใส่คำนำหน้า)</label>
                                            <input type="text" id="fname" v-model="selected.fname" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">นามสกุล</label>
                                            <input type="text" id="lname" v-model="selected.lname" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">เบอร์โทรศัพท์</label>
                                            <input type="text" id="tel" v-model="selected.tel" class="form-control" maxlength="10">
                                        </div>
                                    </div>


                                        <div class="form-group">
                                            <label for="type">ประเภทการจอง</label><br />
                                            <input type="radio" name="typeAdd" @click="typeQuick" value="quick">
                                            <label class="mr-4" for="quick"> จองด่วน</label>

                                            <input type="radio" name="typeAdd" @click="typeWalk" value="walkin">
                                            <label for="walkin"> ลูกค้า Walk-in</label>
                                        </div>

                                        <div class="form-group" id="owner" style="display:none;">
                                            <label>เซลล์ผู้ดูแล</label><br />
                                            <select class="form-control search-sales">
                                            </select>
                                        </div>

                                        <div class="form-group" id="note" style="display:none;">
                                            <label>หมายเหตุ</label>
                                            <textarea v-model="selected.note" class="form-control" id="note" rows="3"></textarea>
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
                                
                                    <div class="mb-3">
                                        
                                        <div class="form-group">
                                            <label for="date">วันที่จอง</label>
                                            <input type="date" id="date" class="form-control" v-model="selected.date" min="<?php echo date('Y-m-d') ?>" @change="getTime" disabled>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="time">เวลาจอง</label>
                                            <select id="time" name="time" v-model="selected.time" class="form-control" disabled>
                                                <option value="0">= เลือกเวลา =</option>
                                                <option v-for="t in bk.time" v-if="t.status == 1" :value="t.id">{{ t.time }}</option>
                                                <option v-for="t in bk.time" v-if="t.status == 0" :value="t.id" disabled>{{ t.time }} (ไม่ว่าง)</option>
                                            </select>
                                        </div> -->

                                        <div class="mb-3" id="checktime">
                                        
                                            <div class="form-group">
                                                <label for="time">เวลาขอจอง</label>
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
       var testdrive = new Vue({
            el: '#testdrive',
            data: {
                sales:{
                    id: 'TBR'
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
                    carimg: '',
                    tel:'',
                    sales:'',
                    note:'',
                    selectedRows: []
                },
                owner: [],
                selectedRows: []
            },
            mounted() {
                
            },
            methods: {
                getTime(e) {
                    //document.getElementById('time').disabled = false;
                    axios.post('/inbound/system/move-bk.api.php?get=time', {
                        date: testdrive.selected.date,
                        car: testdrive.selected.car
                    }).then(function(response) {

                        //console.log(response.data);
                        testdrive.bk.time = response.data.time;
                        testdrive.selected.time = '0';
                        document.getElementById('checktime').style.display = 'block';
                        testdrive.selected.selectedRows = [];
                        document.querySelectorAll('.time').forEach(checkbox => checkbox.checked = false);
                    });
                    
                },
                handleChange(e) {
                    const { value, checked } = e.target
                    if (checked) {
                        this.selected.selectedRows.push(value)
                    } else {
                        const index = this.selected.selectedRows.findIndex(id => id === value)
                        if (index > -1) {
                            this.selected.selectedRows.splice(index, 1)
                        }
                    }
                    console.log(this.selected.selectedRows)
                },
                typeQuick() {
                    document.getElementById('owner').style.display = 'none';
                    document.getElementById('note').style.display = 'block';
                },
                typeWalk() {
                    document.getElementById('owner').style.display = 'block';
                    document.getElementById('note').style.display = 'none';

                    axios.post('/inbound/system/booking.api.php?get=sales').then(function(response) {
                        //testdrive.owner = response.data;
                        $('.search-sales').select2({
                            data: response.data
                        });
                        $('.search-sales').on('change', function(e) {
                            testdrive.selected.sales = e.target.value;
                        });
                    });
                },
                getCar(e) {
                    axios.post('/inbound/system/booking.api.php?get=car', {
                        branch: e.target.value
                    }).then(function(response) {
                        
                        testdrive.bk.car = response.data.car;
                        document.getElementById('car').disabled = false;

                        testdrive.selected.car = '0';
                        testdrive.selected.date = '';
                        testdrive.selected.time = '0';

                        //document.getElementById('date').disabled = true;
                        //document.getElementById('time').disabled = true;
                        
                        //document.getElementById('carimg').style.display = 'none';
                        
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
                // getTime(e) {
                //     document.getElementById('time').disabled = false;
                //     axios.post('/inbound/system/booking.api.php?get=time', {
                //         date: e.target.value,
                //         car: testdrive.selected.car
                //     }).then(function(response) {
                        
                //         testdrive.bk.time = response.data.time;

                //         testdrive.selected.time = '0';
                //     });
                // },
                
                sendData() {

                    //console.log(testdrive.selected);

                    if(testdrive.selected.branch == '0' || testdrive.selected.car == '0' || testdrive.selected.date == '' || testdrive.selected.selectedRows.length === 0 || testdrive.selected.fname == '' || testdrive.selected.lname == '' || testdrive.selected.tel == ''){
                        swal("โปรดตรวจสอบ","กรุณากรอกข้อมูลให้ครบถ้วน", {
                            icon: "warning",
                        });
                        return;

                    } else if(!document.querySelector('input[name="typeAdd"]:checked')) {
                        swal("โปรดตรวจสอบ","โปรดเลือกประเภทการจอง", {
                            icon: "warning",
                        });
                    } else if(document.querySelector('input[name="typeAdd"]:checked').value == 'walkin' && testdrive.selected.sales == ''){
                        swal("โปรดตรวจสอบ","กรุณากรอกข้อมูลให้ครบถ้วน - เลือกเซลล์ผู้ดูแล", {
                            icon: "warning",
                        });
                        return;
                    } else if(document.querySelector('input[name="typeAdd"]:checked').value == 'quick' && this.selected.note == ''){
                        swal("โปรดตรวจสอบ","กรุณากรอกข้อมูลให้ครบถ้วน - กรอกหมายเหตุ", {
                            icon: "warning",
                        });
                    } else {

                        axios.post('/inbound/system/fastlane.api.php',{

                            id: testdrive.sales.id,
                            car: testdrive.selected.car,
                            date: testdrive.selected.date,
                            time: JSON.stringify(testdrive.selected.selectedRows),
                            fname: testdrive.selected.fname,
                            lname: testdrive.selected.lname,
                            tel: testdrive.selected.tel,
                            note: testdrive.selected.note,
                            sales: testdrive.selected.sales,
                            branch: testdrive.selected.branch,
                            type: document.querySelector('input[name="typeAdd"]:checked').value

                        }).then(function(response) {
                            if(response.data.status == 'success'){
                                swal("สำเร็จ", response.data.message, {
                                    icon: "success",
                                }).then((value) => {
                                    window.location.href = '/admin/de/' + response.data.id;
                                });
                            } else {
                                swal("ไม่สำเร็จ", response.data.message, {
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