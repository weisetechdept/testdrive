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
    <title>Test Drive Admin Panel</title>
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
        .fc-title {
            color: #fff;
        }
        @media screen and (max-width: 600px){
            .pr1 {
                padding-right: 0.25rem !important;
            }
            .pl1 {
                padding-left: 0.25rem !important;
            }
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

            <div class="page-content" id="dedrive">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <h4 class="header-title">ข้อมูลเดือนปัจจุบัน</h4>
                        </div>
                    </div>

                    <div class="row">
                        

                        <div class="col-6 col-xl-3 pr1">
                            <div class="card bg-primary border-primary">
                                <div class="card-body">
                                    <div class="mb-1">
                                        <h5 class="card-title mb-0 text-white">จองทั้งหมด</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-0">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0 text-white">
                                                {{ summary.all }}
                                            </h2>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-6 col-xl-3 pl1">
                            <div class="card bg-success border-success">
                                <div class="card-body">
                                    <div class="mb-1">
                                        <h5 class="card-title mb-0 text-white">สำเร็จ</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-0">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0 text-white">
                                                {{ summary.success }}
                                            </h2>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-xl-3 pr1">
                            <div class="card bg-info border-info">
                                <div class="card-body">
                                    <div class="mb-1">
                                        <h5 class="card-title mb-0 text-white">สำนักงานใหญ่</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-0">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0 text-white">
                                                {{ summary.ho }}
                                            </h2>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-xl-3 pl1">
                            <div class="card bg-info border-info">
                                <div class="card-body">
                                    <div class="mb-1">
                                        <h5 class="card-title mb-0 text-white">สาขา ตลาดไท</h5>
                                    </div>
                                    <div class="row d-flex align-items-center mb-0">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0 text-white">
                                                {{ summary.tm }}
                                            </h2>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                <div class="row mt-2">
                    <div class="col-12 offset-md-1 col-md-10 offset-lg-3 col-lg-6">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="row ml-1">
                                    <h5>ปฏิทินการจอง</h5>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12">
                                        <select v-model="select.car" @change="getEvent" class="form-control mb-2">
                                            <option value="0">= เลือกรุ่นรถยนต์ =</option>
                                            <option v-for="c in car" :value="c.id">{{ c.name }}</option>
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

    <script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/assets/plugins/moment/moment.js"></script>
    <script src='/assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script>

        var dedrive = new Vue({
            el: '#dedrive',
            data: {
                summary: '',
                car: [],
                select: {
                    car: 0
                }
            },
            mounted () {
                axios.get('/inbound/system/home.api.php').then(function(response) {
                    dedrive.summary = response.data;
                    dedrive.car = response.data.car;
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
                    axios.get('/inbound/system/event.api.php?c='+dedrive.select.car).then(function(response) {
                        $('#calendar').fullCalendar('removeEvents');
                        $('#calendar').fullCalendar('addEventSource', response.data);
                    });
                }
            }
        });
        
    </script>
    <script src="/assets/js/theme.js"></script>

</body>

</html>