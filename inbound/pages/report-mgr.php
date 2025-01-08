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
        <div class="main-content" id="dedrive"  v-cloak>

            <div class="page-content">
                <div class="container-fluid">

                    <div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-4 font-size-18">รายงานสำหรับบริหารงาน</h4>

                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label>เดือน</label>
                                                <div class="form-select mb-2">
                                                    <select class="form-control">
                                                        <option value="all">มกราคม 2568</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label>รุ่นรถ</label>
                                                <div class="form-select mb-2">
                                                    <select class="form-control">
                                                        <option value="all">ทั้งหมด</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-3 mb-3">
                                                <label>สาขา</label>
                                                <div class="form-select mb-2">
                                                    <select class="form-control">
                                                        <option value="all">ทั้งหมด</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label>ทีม</label>
                                                <div class="form-select mb-2">
                                                    <select class="form-control">
                                                        <option value="all">ทั้งหมด</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        
                                        <button class="btn btn-primary" @click="searchData">ค้นหา</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-4 font-size-18">รายงานสำหรับบริหารงาน</h4>
                                        
                                        <table v-if="!loading" class="table table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th scope="col" rowspan="2" style="text-align: center; vertical-align: middle;width: 100px;">Branch</th>
                                                    <th scope="col" colspan="9" class="col-center">TEST DRIVE</th>
                                                    <th scope="col" colspan="3" class="col-center">BOOTH</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col" width="8%" class="col-center">IN</th>
                                                    <th scope="col" width="8%" class="col-center">BK</th>
                                                    <th scope="col" width="8%" class="col-center bg-extrabold">%</th>
                                                    <th scope="col" width="8%" class="col-center">OUT</th>
                                                    <th scope="col" width="8%" class="col-center">BK</th>
                                                    <th scope="col" width="8%" class="col-center bg-extrabold">%</th>
                                                    <th scope="col" width="8%" class="col-center">TOTAL</th>
                                                    <th scope="col" width="8%" class="col-center">BK</th>
                                                    <th scope="col" width="8%" class="col-center bg-extrabold">%</th>
                                                    <th scope="col" width="8%" class="col-center">TOTAL</th>
                                                    <th scope="col" width="8%" class="col-center">BK</th>
                                                    <th scope="col" width="8%" class="col-center bg-extrabold">%</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="col-center">HO</td>
                                                    <td class="col-center">{{reportData.TestDIn.HO}}</td>
                                                    <td class="col-center">{{reportData.TestDInBk.HO}}</td>
                                                    <td class="col-center bg-extrabold">{{reportData.TestDInPer.HO}}</td>
                                                    <td class="col-center">{{reportData.TestDOut.HO}}</td>
                                                    <td class="col-center">{{reportData.TestDOutBk.HO}}</td>
                                                    <td class="col-center bg-extrabold">{{reportData.TestDOutPer.HO}}</td>
                                                    <td class="col-center">{{reportData.TestDAll.HO}}</td>
                                                    <td class="col-center">{{reportData.TestDAllBk.HO}}</td>
                                                    <td class="col-center bg-extrabold">{{reportData.TestDAllPer.HO}}</td>
                                                    <td class="col-center">{{reportData.TestDBooth.HO}}</td>
                                                    <td class="col-center">-</td>
                                                    <td class="col-center bg-extrabold">-</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-center">TM</td>
                                                    <td class="col-center">{{reportData.TestDIn.TM}}</td>
                                                    <td class="col-center">{{reportData.TestDInBk.TM}}</td>
                                                    <td class="col-center bg-extrabold">{{reportData.TestDInPer.TM}}</td>
                                                    <td class="col-center">{{reportData.TestDOut.TM}}</td>
                                                    <td class="col-center">{{reportData.TestDOutBk.TM}}</td>
                                                    <td class="col-center bg-extrabold">{{reportData.TestDOutPer.TM}}</td>
                                                    <td class="col-center">{{reportData.TestDAll.TM}}</td>
                                                    <td class="col-center">{{reportData.TestDAllBk.TM}}</td>
                                                    <td class="col-center bg-extrabold">{{reportData.TestDAllPer.TM}}</td>
                                                    <td class="col-center">{{reportData.TestDBooth.TM}}</td>
                                                    <td class="col-center">-</td>
                                                    <td class="col-center bg-extrabold">-</td>
                                                </tr>
                                                <tr class="bg-bold-table">
                                                    <td class="col-center">ALL</td>
                                                    <td class="col-center">{{reportData.TestDIn.All}}</td>
                                                    <td class="col-center">{{reportData.TestDInBk.All}}</td>
                                                    <td class="col-center bg-extrabold">{{reportData.TestDInPer.All}}</td>
                                                    <td class="col-center">{{reportData.TestDOut.All}}</td>
                                                    <td class="col-center">{{reportData.TestDOutBk.All}}</td>
                                                    <td class="col-center bg-extrabold">{{reportData.TestDOutPer.All}}</td>
                                                    <td class="col-center">{{reportData.TestDAll.All}}</td>
                                                    <td class="col-center">{{reportData.TestDAllBk.All}}</td>
                                                    <td class="col-center bg-extrabold">{{reportData.TestDAllPer.All}}</td>
                                                    <td class="col-center">{{reportData.TestDBooth.All}}</td>
                                                    <td class="col-center">-</td>
                                                    <td class="col-center bg-extrabold">-</td>
                                                </tr>
                                            </tbody>
                                        </table>

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
                formdate: '<?php echo date('Y-m-01');?>',
                todate: '<?php echo date('Y-m-d');?>',
                model: 'all',
                status: 'all',
                where: 'all'
            },
            searchData: [],
            reportData: {
                TestDIn: {},
                TestDInBk: {},
                TestDInPer: {},
                TestDOut: {},
                TestDOutBk: {},
                TestDOutPer: {},
                TestDAll: {},
                TestDAllBk: {},
                TestDAllPer: {},
                TestDBooth: {}
            },
            loading: false // เพิ่มตัวแปร loading
        },
        mounted () {
            this.getReport();
        },
        methods: {
            getReport() {
                this.loading = true; // เริ่มโหลด
                axios.post('/inbound/system/report-mgr.api.php', {
                    formdate: this.search.formdate,
                    todate: this.search.todate,
                    model: this.search.model,
                    status: this.search.status,
                    where: this.search.where
                }).then((response) => {
                    console.log(response.data);
                    this.reportData.TestDIn = response.data.TestDIn;
                    this.reportData.TestDInBk = response.data.TestDInBk;
                    this.reportData.TestDInPer = response.data.TestDInPer;
                    this.reportData.TestDOut = response.data.TestDOut;
                    this.reportData.TestDOutBk = response.data.TestDOutBk;
                    this.reportData.TestDOutPer = response.data.TestDOutPer;
                    this.reportData.TestDAll = response.data.TestDAll;
                    this.reportData.TestDAllBk = response.data.TestDAllBk;
                    this.reportData.TestDAllPer = response.data.TestDAllPer;
                    this.reportData.TestDBooth = response.data.TestDBooth;
                }).catch((error) => {
                    console.error('Error fetching data:', error);
                }).finally(() => {
                    this.loading = false; // สิ้นสุดการโหลด
                });
            }
        }
    });

    </script>
    <script src="/assets/js/theme.js"></script>

</body>

</html>