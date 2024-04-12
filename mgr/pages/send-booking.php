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
    <?php include_once('include/nav.php'); ?>
    <?php include_once('include/sidebar.php'); ?>
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
                                   
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>รหัส</td>
                                                <td>{{ detail.id }}</td>
                                            </tr>
                                            <tr>
                                                <td>ชื่อ - นามสกุล</td>
                                                <td>{{ detail.name }}</td>
                                            </tr>
                                            <tr>
                                                <td>โทรศัพท์</td>
                                                <td>{{ detail.tel }}
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>รถยนต์</td>
                                                <td>{{ detail.car }}</td>
                                            </tr>
                                            <tr>
                                                <td>วันที่จอง</td>
                                                <td>{{ detail.bk_date }}</td>
                                            <tr>
                                                <td>เวลาที่จอง</td>
                                                <td>{{ detail.bk_time }}</td>
                                            </tr>
                                            <tr>
                                                <td>หมายเหตุ</td>
                                                <td>{{ detail.bk_note }}</td>
                                            </tr>
                                            <tr>
                                                <td>สถานะ</td>
                                                <td v-if="detail.status == '0'"><span class="badge badge-soft-warning">ยังไม่ทดลองขับ</span></td>
                                                <td v-else-if="detail.status == '1'"><span class="badge badge-soft-primary">เบิกกุญแจ</span></td>
                                                <td v-else-if="detail.status == '2'"><span class="badge badge-soft-success">สำเร็จ</span></td>
                                                <td v-else-if="detail.status == '10'"><span class="badge badge-soft-danger">ยกเลิก</span></td>
                                            </tr>
                                            <tr>
                                                <td>วันที่ขอจอง</td>
                                                <td>{{ detail.create }}</td>
                                            </tr>
                                            <tr>
                                                <td>แหล่งที่มา</td>
                                                <td v-if="detail.where == '1'"><span class="badge badge-soft-success">ออนไลน์</span></td>
                                                <td v-else-if="detail.where == '2'"><span class="badge badge-soft-primary">เซลล์</span></td>
                                                <td v-else-if="detail.where == '3'"><span class="badge badge-soft-info">TBR</span></td>
                                                <td v-else-if="detail.where == '4'"><span class="badge badge-soft-secondary">Walk-in</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            
                                            <div class="form-group">
                                                <h4 class="mb-2 font-size-18">ส่งการจองให้ลูกทีม</h4>
                                                <select v-model="selected" class="form-control">
                                                    <option value="0">= เลือกเซลล์ที่จะส่งข้อมูลให้ =</option>
                                                    <option v-for="item in team" :value="item.id">{{ item.name }}</option>
                                                </select>
                                                <button @click="sendData" class="btn btn-success mt-2">ส่งการจอง</button>
                                            </div>
                                           
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
                detail: [],
                team: [],
                selected: '0'
            },
            mounted () {
                axios.get('/mgr/system/detail.api.php?id=<?php echo $id; ?>').then(function(response) {
                    dedrive.detail = response.data.detail;
                });
                axios.get('/mgr/system/team.api.php').then(function(response) {
                    dedrive.team = response.data.user;
                });
            },
            methods: {
                sendData() {
                    if(this.selected == '0'){
                        swal("แจ้งเตือน","กรุณาเลือกเซลล์ที่จะส่งข้อมูลให้", {
                            icon: "warning",
                        });
                    } else {
                        axios.post('/mgr/system/send-bk-to.api.php', {
                            id: this.detail.id,
                            sales: this.selected
                        }).then(function(response) {
                            if(response.data.status == 'success'){
                                swal("สำเร็จ",response.data.message, {
                                    icon: "success",
                                }).then((value) => {
                                    window.location.href = '/mgr/adsign';
                                });
                            } else {
                                swal("แจ้งเตือน",response.data.message, {
                                    icon: "warning",
                                }).then((value) => {
                                    window.location.href = '/mgr/adsign';
                                })
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