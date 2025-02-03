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
        .page-content {
            margin-top: 60px;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include_once('include/nav.php'); ?>
    <?php include_once('include/sidebar.php'); ?>
    <div id="layout-wrapper">

        <div class="main-content">

            <div class="page-content pt-4">
                <div class="container-fluid">

                    <div class="row mt-2" id="report">


                        <div class="col-12 col-md-8 col-xl-6">
                            <h4 class="mt-0 header-title">รายงานการขาย</h4>
                            <div class="card m-b-30">
                                <div class="card-body">
                                 <h5 class="mt-0 header-title">เลือกเดือนที่ต้องการแสดงข้อมูล</h5>

                                    <select class="form-control mb-3" v-model="search.month" @change="getReport">
                                        <option v-for="md in monthData" :value="md.value">{{ md.name }}</option>
                                    </select>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="25%" class="text-center">ทดลองขับ (สำเร็จ)</th>
                                                <th width="25%" class="text-center">จอง</th>
                                                <th width="25%" class="text-center">%</th>
                                                <th width="25%" class="text-center">ออกบูธ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="text-center">{{ reportAll.testdrive }}</th>
                                                <th class="text-center">{{ reportAll.booking }}</th>
                                                <th class="text-center">{{ reportAll.percentage }}</th>
                                                <th class="text-center">{{ reportAll.booth }}</th>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                   
                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ชื่อเซลล์</th>
                                                <th class="text-center">ทดลองขับ</th>
                                                <th class="text-center">จอง</th>
                                                <th class="text-center">%</th>
                                                <th class="text-center">ออกบูธ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="d in reportData">
                                                <td>{{ d.name }}</td>
                                                <td class="text-center">{{ d.testdrive }}</td>
                                                <td class="text-center">{{ d.booking }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>

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

        var report = new Vue({
            el: '#report',
            data: {
                reportData: [],
                monthData: [],
                search: {
                    month: "<?php echo date('Y-m-01'); ?>"
                },
                reportAll: []
            },
            mounted: function () {
                axios.get('/mgr/system/report.api.php?get=sales&date=').then(response => {
                    console.log(response.data);
                    this.reportData = response.data.teamData;
                    this.monthData = response.data.selectDate;
                    this.reportAll = response.data.reportAll;
                });
            },
            methods: {
                getReport() {
                    axios.get('/mgr/system/report.api.php?get=sales&date=' + this.search.month).then(response => {
                        console.log(response.data);
                        this.reportData = response.data.teamData;
                        this.reportAll = response.data.reportAll;
                    });
                }
            }

        });

    </script>


    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>