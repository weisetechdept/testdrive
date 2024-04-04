<?php
    session_start();
 
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

                    <div class="home-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="row ml-1">
                                                <h5>ช่วงเวลาที่ว่าง</h5>
                                            </div>

                                            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>วันที่</th>
                                                        <th>ช่วงเวลา</th>
                                                        <th>สถานะ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="bk in booked">
                                                        <td>{{ bk.date }}</td>
                                                        <td>{{ bk.time }}</td>
                                                        <td>{{ bk.status }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="d-grid gap-2">
                                                <a href="/sales/booking" class="btn btn-primary">จองรถ</a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/assets/plugins/moment/moment.js"></script>
    <script src='/assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>
    
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/js/theme.js"></script>

    <script>
         var testdrive = new Vue({
            el: '#testdrive',
            data: {
                booked: []
            },
            mounte(){
                axios.get('/mgr/system/checkEvent.api.php?date=2024-04-04&car=16').then(function(response){
                    console.log(response.data.data);
                    this.booked = response.data.data
                });
            }
        });

    </script>

</body>

</html>