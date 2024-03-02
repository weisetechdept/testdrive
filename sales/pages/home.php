<?php
    session_start();
    if($_SESSION['pp_login'] !== true && $_SESSION['pp_permission'] !== 'user'){
        header('Location: /404');
    }
 
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
        .home-content {
            margin-top: 50px;
        }
        .fc-title {
            color: #fff;
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
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="row ml-1">
                                        <h5>ปฏิทินการจอง</h5>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <select class="form-control mb-2">
                                                <option value="0">= เลือกรุ่นรถยนต์ =</option>
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
                                            <li>การจองรถทดลองขับ สามารถจองล่วงหน้าอย่างน้อย 1 วัน และ ไม่เกิน 7 วัน</li>
                                            <li>ยกเลิกการจองล่วงหน้าก่อนถึงวันที่จองอย่างน้อย 2 วัน</li>
                                            <li>กรณีไม่ได้ดำเนินการ ณ ช่วงเวลาที่จอง ระบบจะตัดสิทธิคงเหลือการจองนั้น เป็นระยะเวลา 3 วัน</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row mt-3">
                        <a href="/sales/booking">
                            <img src="/assets/images/bottom-test-drive-1.png" class="img-fluid pr-2 pl-2">
                        </a>
                    </div>
                    <div class="row">
                        <a href="/sales/list">
                            <img src="/assets/images/bottom-test-drive-2.png" class="img-fluid pr-2 pl-2">
                        </a>
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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/assets/plugins/moment/moment.js"></script>
    <script src='/assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>
    <script src="/assets/pages/calendar-demo.js?r=<?php echo rand(0,999999);?>"></script>
    
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/theme.js"></script>

    <script>
         var testdrive = new Vue({
            el: '#testdrive',
            data: {
                sales:{
                    id: '',
                    quota: 0
                }
            },
            mounted: function() {
                axios.get('/sales/system/booking.api.php?get=sales').then(function(response) {
                    testdrive.sales.id = response.data.sales.id;
                    testdrive.sales.quota = response.data.sales.quota;
                });
            }
        });

        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var currentMonth = currentDate.getMonth() + 1;
        var currentDay = currentDate.getDate();
        var formattedDate = currentYear + '-' + currentMonth + '-' + currentDay;

        $(document).ready(function() {
            $('#calendar').fullCalendar({
                defaultDate: formattedDate,
                editable: true,
                eventLimit: true,
                events: []
            });

            axios.get('/inbound/system/event.api.php').then(function(response) {
                var events = response.data.events;
                for (var i = 0; i < events.length; i++) {
                    $('#calendar').fullCalendar('renderEvent', events[i], true);
                }

            });
        });
    </script>

</body>

</html>