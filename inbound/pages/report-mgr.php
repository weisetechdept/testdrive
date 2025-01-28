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
        .report-data {
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
        <div class="main-content" id="dedrive"  v-cloak>

            <div class="page-content">
                <div class="container-fluid">

                    <div>
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">รายงานสำหรับบริหารงาน</h4>

                                        <div class="row">
                                            <div class="col-12">
                                                <label>เดือน/ปี ของข้อมูล</label>
                                                <div class="form-select mb-3">
                                                    <select class="form-control" v-model="search.date" @change="getReport">
                                                        <option value="0">เลือกเดือนที่ต้องการ</option>
                                                        <option v-for="search in searchDate" :value="search.value">{{ search.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row report-data">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div v-if="!loading">

                                            <h4 class="mb-2 font-size-18">รายงานทดลองขับประจำเดือน {{ search.monthName }}</h4>
                                            
                                            <table class="table table-bordered table-responsive mb-4">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" rowspan="2" style="text-align: center; vertical-align: middle;width: 100px;">Branch</th>
                                                        <th scope="col" colspan="9" class="col-center">TEST DRIVE</th>
                                                        <th scope="col" colspan="3" class="col-center">BOOTH</th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" width="8%" class="col-center">IN</th>
                                                        <th scope="col" width="8%" class="col-center">BK</th>
                                                        <th scope="col" width="8%" class="col-center bg-bold-table">%</th>
                                                        <th scope="col" width="8%" class="col-center">OUT</th>
                                                        <th scope="col" width="8%" class="col-center">BK</th>
                                                        <th scope="col" width="8%" class="col-center bg-bold-table">%</th>
                                                        <th scope="col" width="8%" class="col-center">TOTAL</th>
                                                        <th scope="col" width="8%" class="col-center">BK</th>
                                                        <th scope="col" width="8%" class="col-center bg-bold-table">%</th>
                                                        <th scope="col" width="8%" class="col-center">TOTAL</th>
                                                        <th scope="col" width="8%" class="col-center">BK</th>
                                                        <th scope="col" width="8%" class="col-center bg-bold-table">%</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="col-center">HO</td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.HO?.ALL?.inDataALL || '0' }}</a></td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.HO?.ALL?.inDataBKALL || '0' }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ reportTeam.HO?.ALL?.inDataPerALL || '0' }}</td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.HO?.ALL?.outDataALL || '0' }}</a></td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.HO?.ALL?.outDataBKALL || '0' }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ reportTeam.HO?.ALL?.outDataPerALL || '0' }}</td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.HO?.ALL?.countTotal || '0' }}</a></td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.HO?.ALL?.countTotalBK || '0' }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ reportTeam.HO?.ALL?.countTotalPer || '0' }}</td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.HO?.ALL?.countBootTotal || '0' }}</a></td>
                                                        <td class="col-center">-</td>
                                                        <td class="col-center bg-bold-table">-</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-center">TM</td>
                                                        <td class="col-center"><a href="/admin/rmgr/ " target="_blank">{{ reportTeam.TM?.ALL?.inDataALL || '0' }}</a></td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.TM?.ALL?.inDataBKALL || '0' }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ reportTeam.TM?.ALL?.inDataPerALL || '0' }}</td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.TM?.ALL?.outDataALL || '0' }}</a></td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.TM?.ALL?.outDataBKALL || '0' }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ reportTeam.TM?.ALL?.outDataPerALL || '0' }}</td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.TM?.ALL?.countTotal || '0' }}</a></td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.TM?.ALL?.countTotalBK || '0' }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ reportTeam.TM?.ALL?.countTotalPer || '0' }}</td>
                                                        <td class="col-center"><a href="#" target="_blank">{{ reportTeam.TM?.ALL?.countBootTotal || '0' }}</a></td>
                                                        <td class="col-center">-</td>
                                                        <td class="col-center bg-bold-table">-</td>
                                                    </tr>
                                                    <tr class="bg-bold-table">
                                                        <td class="col-center">ALL</td>
                                                        <td class="col-center">{{ reportTeam.HO?.ALL?.inDataALL + reportTeam.TM?.ALL?.inDataALL }}</td>
                                                        <td class="col-center">{{ reportTeam.HO?.ALL?.inDataBKALL + reportTeam.TM?.ALL?.inDataBKALL }}</td>
                                                        <td class="col-center bg-extrabold">{{ reportTeam.HO?.ALL?.inDataPerALL + reportTeam.TM?.ALL?.inDataPerALL }}</td>
                                                        <td class="col-center">{{ reportTeam.HO?.ALL?.outDataALL + reportTeam.TM?.ALL?.outDataALL }}</td>
                                                        <td class="col-center">{{ reportTeam.HO?.ALL?.outDataBKALL + reportTeam.TM?.ALL?.outDataBKALL }}</td>
                                                        <td class="col-center bg-extrabold">{{ reportTeam.HO?.ALL?.outDataPerALL + reportTeam.TM?.ALL?.outDataPerALL }}</td>
                                                        <td class="col-center">{{  reportTeam.HO?.ALL?.countTotal +  reportTeam.TM?.ALL?.countTotal  }}</td>
                                                        <td class="col-center">{{ reportTeam.HO?.ALL?.countTotalBK + reportTeam.TM?.ALL?.countTotalBK }}</td>
                                                        <td class="col-center bg-extrabold">{{ reportTeam.HO?.ALL?.countTotalPer + reportTeam.TM?.ALL?.countTotalPer }}</td>
                                                        <td class="col-center">{{ reportTeam.HO?.ALL?.countBootTotal + reportTeam.TM?.ALL?.countBootTotal }}</td>
                                                        <td class="col-center">-</td>
                                                        <td class="col-center bg-extrabold">-</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <h4 class="mb-2 font-size-18">รายงานทดลองขับแยกรายทีม สาขาสำนักงานใหญ่</h4>
                                            <table class="table table-bordered table-responsive mb-4">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" rowspan="2" style="text-align: center; vertical-align: middle;width: 100px;">TEAM</th>
                                                        <th scope="col" colspan="9" class="col-center">TEST DRIVE</th>
                                                        <th scope="col" colspan="3" class="col-center">BOOTH</th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" width="8%" class="col-center">IN</th>
                                                        <th scope="col" width="8%" class="col-center">BK</th>
                                                        <th scope="col" width="8%" class="col-center bg-bold-table">%</th>
                                                        <th scope="col" width="8%" class="col-center">OUT</th>
                                                        <th scope="col" width="8%" class="col-center">BK</th>
                                                        <th scope="col" width="8%" class="col-center bg-bold-table">%</th>
                                                        <th scope="col" width="8%" class="col-center">TOTAL</th>
                                                        <th scope="col" width="8%" class="col-center">BK</th>
                                                        <th scope="col" width="8%" class="col-center bg-bold-table">%</th>
                                                        <th scope="col" width="8%" class="col-center">TOTAL</th>
                                                        <th scope="col" width="8%" class="col-center">BK</th>
                                                        <th scope="col" width="8%" class="col-center bg-bold-table">%</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(team, index) in reportTeam.HO" :key="index" v-if="index !== 'ALL'">
                                                        <td class="col-center">{{ index }}</td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/in/' + search.date" target="_blank">{{ team.countIn }}</a></td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/inBK/' + search.date" target="_blank">{{ team.countInBK }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ team.countInPer }}</td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/out/'+ search.date" target="_blank">{{ team.countOut }}</a></td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/outBK/'+ search.date" target="_blank">{{ team.countOutBK }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ team.countOutPer }}</td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/total/'+ search.date" target="_blank">{{ team.total }}</a></td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/totalBK/'+ search.date" target="_blank">{{ team.totalBK }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ team.totalPer }}</td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/boot/'+ search.date" target="_blank">{{ team.countBootTotal }}</a></td>
                                                        <td class="col-center">{{ team.countBootBK }}</td>
                                                        <td class="col-center bg-bold-table">{{ team.countBootPer }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <h4 class="mb-2 font-size-18">รายงานทดลองขับแยกรายทีม สาขาตลาดไท</h4>
                                            <table class="table table-bordered table-responsive mb-4">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" rowspan="2" style="text-align: center; vertical-align: middle;width: 100px;">TEAM</th>
                                                        <th scope="col" colspan="9" class="col-center">TEST DRIVE</th>
                                                        <th scope="col" colspan="3" class="col-center">BOOTH</th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" width="8%" class="col-center">IN</th>
                                                        <th scope="col" width="8%" class="col-center">BK</th>
                                                        <th scope="col" width="8%" class="col-center bg-bold-table">%</th>
                                                        <th scope="col" width="8%" class="col-center">OUT</th>
                                                        <th scope="col" width="8%" class="col-center">BK</th>
                                                        <th scope="col" width="8%" class="col-center bg-bold-table">%</th>
                                                        <th scope="col" width="8%" class="col-center">TOTAL</th>
                                                        <th scope="col" width="8%" class="col-center">BK</th>
                                                        <th scope="col" width="8%" class="col-center bg-bold-table">%</th>
                                                        <th scope="col" width="8%" class="col-center">TOTAL</th>
                                                        <th scope="col" width="8%" class="col-center">BK</th>
                                                        <th scope="col" width="8%" class="col-center bg-bold-table">%</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(team, index) in reportTeam.TM" :key="index" v-if="index !== 'ALL'">
                                                        <td class="col-center">{{ index }}</td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/in/' + search.date" target="_blank">{{ team.countIn }}</a></td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/inBK/' + search.date" target="_blank">{{ team.countInBK }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ team.countInPer }}</td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/out/' + search.date" target="_blank">{{ team.countOut }}</a></td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/outBK/' + search.date" target="_blank">{{ team.countOutBK }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ team.countOutPer }}</td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/total/' + search.date" target="_blank">{{ team.total }}</a></td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/totalBK/' + search.date" target="_blank">{{ team.totalBK }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ team.totalPer }}</td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/team/'+ index +'/boot/' + search.date" target="_blank">{{ team.countBootTotal }}</a></td>
                                                        <td class="col-center">{{ team.countBootBK }}</td>
                                                        <td class="col-center bg-bold-table">{{ team.countBootPer }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <h4 class="mb-2 font-size-18">รายงานทดลองขับแยกตามรุ่นรถยนต์</h4>
                                            <table class="table table-bordered table-responsive mb-4">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" colspan="2" class="col-center">รายละเอียดรถยนต์</th>
                                                        <th scope="col" colspan="7" class="col-center">TEST DRIVE</th>
                                                        <th scope="col" colspan="3" class="col-center">BOOTH</th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" class="col-center">Series / Model</th>
                                                        <th scope="col" class="col-center" width="175px">Vin No.</th>
                                                        <th scope="col" width="7%" class="col-center bg-bold-table">Total</th>
                                                        <th scope="col" width="7%" class="col-center">IN</th>
                                                        <th scope="col" width="7%" class="col-center">BK</th>
                                                        <th scope="col" width="7%" class="col-center bg-bold-table">%</th>
                                                        <th scope="col" width="7%" class="col-center">OUT</th>
                                                        <th scope="col" width="7%" class="col-center">BK</th>
                                                        <th scope="col" width="7%" class="col-center bg-bold-table">%</th>
                                                        <th scope="col" width="7%" class="col-center">TOTAL</th>
                                                        <th scope="col" width="7%" class="col-center">BK</th>
                                                        <th scope="col" width="7%" class="col-center bg-bold-table">%</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="car in reportCars">
                                                        <td>{{ car.model }}</td>
                                                        <td class="col-center">{{ car.vin }}</td>
                                                        <td class="col-center bg-bold-table"><a :href="'/admin/rmgr/car/'+ car.id +'/in/' + search.date" target="_blank">{{ car.total }}</a></td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/car/'+ car.id +'/in/' + search.date" target="_blank">{{ car.countIn }}</a></td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/car/'+ car.id +'/inBK/' + search.date" target="_blank">{{ car.countInBK }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ car.countInPer }}</td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/car/'+ car.id +'/out/' + search.date" target="_blank">{{ car.countOut }}</a></td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/car/'+ car.id +'/outBK/' + search.date" target="_blank">{{ car.countOutBK }}</a></td>
                                                        <td class="col-center bg-bold-table">{{ car.countOutPer }}</td>
                                                        <td class="col-center"><a :href="'/admin/rmgr/car/'+ car.id +'/boot/' + search.date" target="_blank">{{ car.countBootTotal }}</a></td>
                                                        <td class="col-center">{{ car.countBootBK }}</td>
                                                        <td class="col-center bg-bold-table">{{ car.countBootPer }}</td>
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
                date: '0',
                monthName: ''
            },
            reportCars: [],
            searchData: [],
            reportTeam: [],
            searchDate: [],
            loading: false // เพิ่มตัวแปร loading

        },
        mounted () {
            //this.getReport();
            axios.get('/inbound/system/report-mgr-test.api.php?date=get').then((response) => {
                console.log(response.data);
                this.searchDate = response.data.searchDate;
            })
        },
        methods: {
            getSeach () {
                this.getReport();
            },
            getReport() {
                document.querySelector('.report-data').style.display = 'block';
                this.search.monthName = this.searchDate.find(date => date.value === this.search.date)?.name || '';

                this.loading = true; // เริ่มโหลด
                axios.post('/inbound/system/report-mgr-test.api.php?report=get&date='+ this.search.date, {
                    formdate: this.search.date,
                }).then((response) => {

                    console.log(response.data);

                    this.reportCars = response.data.car_report;
                    this.reportTeam = response.data.byTeam;

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