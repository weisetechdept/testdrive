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
    <title>รายงานการใช้รถยนต์ทดลองขับ Toyota Paragon Motor</title>
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
        [v-cloak] {
            display: none;
        }
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
        .swal-text:last-child {
            margin-bottom: 45px;
            text-align: center;
        }
        .swal-text {
            text-align: center !important;
        }

        .col-center {
            text-align: center;
        }
        .bg-bold-table {
            background-color: #f5f5f5;
        }
        .bg-extrabold {
            background-color:rgb(210, 210, 210);
        }
        .loading-spinner {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #333;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php 
            include_once('inc-page/nav.php');
            include_once('inc-page/sidebar.php');
        ?>
        <div class="main-content" id="dedrive" v-cloak>

            <div class="page-content">
                <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div v-if="!loading">

                                            <h4 class="mb-2 font-size-18">รายงานทดลองขับ ทีม <?php echo $group; ?> ประจะเดือน <?php echo date('m-Y',strtotime($date)); ?></h4>
                                            <p>จำนวนการทดลองขับทั้งหมด  ครั้ง</p>

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>รหัส</td>
                                                        <td>ชื่อ - สกุลลูกค้า</td>
                                                        <td>รถทดลองขับ</td>
                                                        <td>วันที่</td>
                                                        <td>เวลา</td>
                                                        <td>สถานะ</td>
                                                        <td>ผลลัพธ์</td>
                                                        <td>เซลล์</td>
                                                        <td>ทีม</td>
                                                        <td>วันที่บันทึก</td>
                                                        <td>จัดการ</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="data in searchData">
                                                        <td>{{ data.bk_id }}</td>
                                                        <td>{{ data.bk_fname }} {{ data.bk_lname }}</td>
                                                        <td>{{ data.bk_car }}</td>
                                                        <td>{{ data.bk_date }}</td>
                                                        <td>{{ data.bk_time }}</td>
                                                        <td>{{ data.bk_stat }}</td>
                                                        <td>{{ data.bk_status }}</td>
                                                        <td>{{ data.bk_sales }}</td>
                                                        <td class="text-center">{{ data.bk_team }}</td>
                                                        <td>{{ data.bk_datetime }}</td>
                                                        <td>
                                                            <a :href="'/admin/de/' + data.bk_id" class="btn btn-outline-primary btn-sm">ข้อมูล</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            

                                        </div>
                                        <!-- Preloader -->
                                        <div v-else class="loading-spinner">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="sr-only">Loading...</span>
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
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script>

   
    var dedrive = new Vue({
        el: '#dedrive', 
        data: {
            search: {
                report_type: '<?php echo $rtype; ?>',
                group: '<?php echo $group; ?>',
                data_type: '<?php echo $dtype; ?>',
                date: '<?php echo $date; ?>'
            },
            searchData: [],
            loading: false

        },
        mounted () {
            axios.post('/inbound/system/report-mgr-detail.api.php', {
                date: this.search.date,
                group: this.search.group,
                report_type: this.search.report_type,
                data_type: this.search.data_type
            }).then(response => {
                console.log(response.data);
                this.searchData = response.data.scopeData;
            })
                
        },
        methods: {
           
        }

    });

    </script>
    <script src="/assets/js/theme.js"></script>

</body>

</html>