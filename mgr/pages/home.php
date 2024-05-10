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
    <title>Alpha X TestDrive</title>
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

    <link href="/assets/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />

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
            margin-bottom: 20px;
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
        .home-content {
            margin-top: 50px;
        }
        .fc-title {
            color: #fff;
        }
        .jump-btn {
            margin-bottom: 20px;
        }
        .jump-btn a {
            margin: 0 auto;
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

                <div class="row home-content">

                    <div class="col-6 col-xl-3 pr1">
                        <a href="/mgr/list">
                            <div class="card bg-primary border-primary">
                                <div class="card-body">
                                    <div class="mb-1">
                                        <h5 class="card-title mb-0 text-white">จองทั้งหมด</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-0">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0 text-white">
                                                {{ count.booking }}
                                            </h2>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>

                    
                    <div class="col-6 col-xl-3 pl1">
                        <a href="/mgr/adsign">
                            <div class="card bg-warning border-warning">
                                <div class="card-body">
                                    <div class="mb-1">
                                        <h5 class="card-title mb-0 text-white">รอส่งต่อ</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-0">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0 text-white">
                                                {{ count.waiting }}
                                            </h2>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                   

                    <div class="col-6 col-xl-3 pr1">
                        <div class="card bg-success border-success">
                            <div class="card-body">
                                <div class="mb-1">
                                    <h5 class="card-title mb-0 text-white">สำเร็จ</h5>
                                </div>
                                <div class="row d-flex align-items-center mb-0">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 text-white">
                                            {{ count.success }}
                                        </h2>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-xl-3 pl1">
                        <div class="card bg-danger border-danger">
                            <div class="card-body">
                                <div class="mb-1">
                                    <h5 class="card-title mb-0 text-white">ยกเลิก</h5>
                                </div>
                                <div class="row d-flex align-items-center mb-0">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 text-white">
                                            {{ count.cancel }}
                                        </h2>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

</div>
                <div class="jump-btn">
                    <div class="row">
                        <a href="/mgr/adsign">
                            <img src="/assets/images/mgr-btn-2.png" class="img-fluid pr-2 pl-2">
                        </a>
                    </div>

                    <div class="row">
                        <a href="/mgr/list">
                            <img src="/assets/images/mgr-btn-1.png" class="img-fluid pr-2 pl-2">
                        </a>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="row ml-1">
                                        <h5>ปฏิทินการจอง</h5>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <select class="form-control mb-2" v-model="select.car" @change="getEvent">
                                                <option value="0">= เลือกรุ่นรถยนต์ =</option>
                                                <option v-for="c in car" :value="c.id">{{ c.model }} ({{ c.branch }})</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div id='calendar' class="col-lg-12 mt-1 mt-lg-0"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> 

                    

                    <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="row ml-1">
                                        <h5>เงื่อนไขการจอง</h5>
                                    </div>

                                    <div class="row pr-3">
                                        <ul>
                                            <li>ระบบสงวนสิทธิ์ในการจอง จำนวน 3สิทธิ์ เท่านั้น</li>
                                            <li>การจองรถทดลองขับ สามารถจองล่วงหน้าไม่เกิน 7 วัน</li>
                                            <li>ยกเลิกการจองล่วงหน้าก่อนถึงวันที่จองอย่างน้อย 2 วัน</li>
                                            <li>กรณีไม่ได้ดำเนินการ ณ ช่วงเวลาที่จอง ระบบจะตัดสิทธิคงเหลือการจองนั้น และสิทธิจะกลับมาใหม่ ณ วันถัดไปของวันจอง เวลา 06:00น.</li>
                                        </ul>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/assets/plugins/moment/moment.js"></script>
    <script src='/assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>
    
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/theme.js"></script>

    <script>
         var testdrive = new Vue({
            el: '#testdrive',
            data: {
                car: [],
                select: {
                    car: 0
                },
                count: {
                    booking: 0,
                    waiting: 0,
                    success: 0,
                    cancel: 0
                }
            },
            mounted: function() {
                axios.get('/mgr/system/booking.api.php?get=count').then(function(response) {
                    testdrive.count.booking = response.data.count.all;
                    testdrive.count.waiting = response.data.count.asgn;
                    testdrive.count.success = response.data.count.succ;
                    testdrive.count.cancel = response.data.count.canc;
                });

                axios.get('/sales/system/car-event.api.php').then(function(response) {
                    testdrive.car = response.data.car;
                });

                var currentDate = new Date();
                var currentYear = currentDate.getFullYear();
                var currentMonth = currentDate.getMonth() + 1;
                var currentDay = currentDate.getDate();
                var formattedDate = currentYear + '-' + currentMonth + '-' + currentDay;

                $('#calendar').fullCalendar({
                    defaultDate: new Date(),
                    editable: true,
                    eventLimit: true,
                    events: []
                });

            },
            methods: {
                getEvent(){
                    axios.get('/mgr/system/event.api.php?c='+this.select.car).then(function(response) {
                        $('#calendar').fullCalendar('removeEvents');
                        $('#calendar').fullCalendar('addEventSource', response.data);
                    });
                }
            }
        });

    </script>

</body>

</html> 