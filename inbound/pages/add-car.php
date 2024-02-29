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
                                <h4 class="mb-0 font-size-18">เพิ่มรถยนต์ใหม่</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h4 class="card-title">ข้อมูล</h4>
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>รุ่นรถยนต์</td>
                                                <td><input type="text" v-model="send.model" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>สาขา</td>
                                                <td>
                                                    <select v-model="send.branch" class="form-control">
                                                        <option value="0">= เลือกสาขา =</option>
                                                        <option value="ho">สำนักงานใหญ่ (คลอง 7)</option>
                                                        <option value="tm">ตลาดไท</option>
                                                    </select>
                                                </td>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                    <buttons class="btn btn-success ml-2 mt-2" @click="saveData">บันทึก</buttons>
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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- third party js ends -->

    <script>
         var dedrive = new Vue({
            el: '#dedrive',
            data: {
                send: {
                    model: '',
                    branch: '0',
                },
            },
            methods: {
                saveData() {
                    swal({
                        title: "แก้ใขข้อมูล",
                        text: "คุณต้องการแก้ใขข้อมูลรถทดลองขับหรือไม่?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            axios.post('/inbound/system/car-add.api.php', {
                                model: dedrive.send.model,
                                branch: dedrive.send.branch
                            }).then(function(response) {
                                if(response.data.status == '200') {

                                    swal("สำเร็จ", "สร้างสำเร็จ", "success",{ 
                                            button: "ตกลง"
                                        }).then((value) => {
                                            window.location.href = '/admin/car';
                                        });
                                    
                                } else if(response.data.status == '500')  {

                                    swal("เกิดข้อผิดพลาดบางอย่าง", {
                                        icon: "error",
                                    });

                                }
                            });
                        }
                    });
                }
            }
        });

        
    </script>
    <script src="/assets/js/theme.js"></script>

</body>

</html>