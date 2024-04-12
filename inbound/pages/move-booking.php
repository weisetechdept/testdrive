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

        .home-content {
            margin-top: 60px;
        }
        .check-list p {
            margin-bottom: 5px;
            padding-left: 10px;
            font-size: 14px;
        }
        .red {
            color: red;
        }
        .green{
            color: green;
        }
        .swal-text {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php 
        include_once('inc-page/nav.php');
        include_once('inc-page/sidebar.php');
    ?>
    <div id="layout-wrapper">

        <div class="main-content" id="dedrive">

            <div class="page-content pt-4">
                <div class="container-fluid">

                    <div class="row home-content">
                        <div class="col-lg-6 col-md-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">รายละเอียด</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-6 col-md-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h4 class="card-title">ข้อมูล</h4>
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td width="150px">รหัส</td>
                                                <td>{{ detail.id }}</td>
                                            </tr>
                                            <tr>
                                                <td>ชื่อ - นามสกุล</td>
                                                <td>{{ detail.name }}</td>
                                            </tr>
                                            <tr>
                                                <td>สาขา</td>
                                                <td>   
                                                    <span v-if="detail.branch == 'ho'">สำนักงานใหญ่ (คลอง 7)</span>
                                                    <span v-else-if="detail.branch == 'tm'">ตลาดไท</span>
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>รถยนต์</td>
                                                <td>{{ detail.model }}</td>
                                            </tr>
                                            <tr>
                                                <td>วันที่ขอย้ายการจอง</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="date" id="date" class="form-control" v-model="selected.date" min="<?php echo date('Y-m-d'); ?>" @change="getTime">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>เวลาขอย้ายการจอง</td>
                                                <td>
                                                    <div class="form-group">
                                                        <select id="time" name="time" v-model="selected.time" class="form-control" disabled>
                                                            <option value="0">= เลือกเวลา =</option>
                                                            <option v-for="t in bk.time" v-if="t.status == 1" :value="t.id">{{ t.time }}</option>
                                                            <option v-for="t in bk.time" v-if="t.status == 0" :value="t.id" disabled>{{ t.time }} (ไม่ว่าง)</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>

                                           
                                        </tbody>
                                    </table>

                                    <buttons class="btn btn-success mt-3 ml-2" @click="edtData">ย้ายการจอง</buttons>
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

    <script>
         var dedrive = new Vue({
            el: '#dedrive', 
            data: {
                detail: {
                    id: '',
                    model: '',
                    branch: '',
                    car: '',
                    name: ''
                },
                selected: {
                    date: '',
                    time: ''
                },
                bk: {
                    time: []
                }
            },
            mounted () {
                axios.get('/inbound/system/move-bk.api.php?id=<?php echo $id; ?>&get=data').then(function(response) {
                    dedrive.detail.id = response.data.id;
                    dedrive.detail.name = response.data.name;
                    dedrive.detail.branch = response.data.branch;
                    dedrive.detail.model = response.data.model;
                    dedrive.detail.car = response.data.model_id;
                });
            },
            methods: {
                getTime(e) {
                    document.getElementById('time').disabled = false;
                    axios.post('/inbound/system/move-bk.api.php?get=time', {
                        date: dedrive.selected.date,
                        car: dedrive.detail.car
                    }).then(function(response) {
                        console.log(response.data);
                        dedrive.bk.time = response.data.time;
                        dedrive.selected.time = '0';
                    });
                },
                edtData() {
                    if(dedrive.selected.time == '0'){
                        swal("เกิดข้อผิดพลาด","กรุณาเลือกวันที่ และเวลาที่ต้องการย้าย", {
                            icon: "warning",
                        });
                        return;
                    } else {
                        axios.post('/inbound/system/move-bk.api.php?get=edit', {
                            id: dedrive.detail.id,
                            date: dedrive.selected.date,
                            time: dedrive.selected.time
                        }).then(function(response) {
                            if(response.data.status == 'success'){
                                swal("สำเร็จ", "ย้ายการจองสำเร็จ", {
                                    icon: "success",
                                }).then((value) => {
                                    window.location.href = '/admin/de/<?php echo $id; ?>';
                                });
                            } else if(response.data.status == 'failed') {
                                swal("เกิดข้อผิดพลาด", "ไม่สามารถย้ายการจองได้", {
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