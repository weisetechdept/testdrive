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
    <title>Alpha X</title>
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
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php 
            include_once('inc-page/nav.php');
            include_once('inc-page/sidebar.php');
        ?>
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div id="detail">
                        <div class="row">
                            <div class="col-10 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-4 font-size-18">รายชื่อพนักงานขายที่ต้องการเพิ่ม</h4>

                                        <table id="datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>เลือก</th>
                                                    <th>รหัส</th>
                                                    <th width="15px">ชื่อเล่น</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>ทีม</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>       
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div id="sendQuota">
                                            <button type="button" class="btn btn-success mt-4" @click="sendQuota" id="add-quota">
                                                <i class="mdi mdi-plus"></i> เพิ่มโควต้า
                                            </button>
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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script>
       $('#datatable').DataTable({
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                },
                "lengthMenu": "แสดง _MENU_ รายชื่อ",
                "zeroRecords": "ขออภัย ไม่มีข้อมูล",
                "info": "หน้า _PAGE_ ของ _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล",
                "search": "ค้นหา:",
            },
            "drawCallback": function () {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            },
            ajax: '/inbound/system/add-quota.api.php',
            "columns" : [
                {'data':'0',
                    "render": function ( data, type, row, meta ) {
                        return '<input type="checkbox" name="chk[]" value="'+data+'">';
                    }
                },
                {'data':'0'},
                {'data':'2'},
                {'data':'1'},
                {'data':'3'}
            ]
        });

        var sendQuota = new Vue({
            el: '#sendQuota',
            data () {
                return {
               
                }
            },
            methods: {
                sendQuota() {
                    var checkboxes = Array.from(document.querySelectorAll('input[name="chk[]"]:checked')).map(checkbox => checkbox.value)
                    if(checkboxes.length == 0) {
                        swal("เกิดข้อผิดพลาดบางอย่าง", "กรุณาเลือกสมาชิกที่ต้องการเพิ่มโควต้า", "warning");
                        return false;
                    } else {
                        swal({
                            title: "คุณแน่ใจหรือไม่?",
                            text: "โปรดตรวจสอบข้อมูลให้ครบถ้วนรก่อนกดยืนยันการทำรายการ",
                            icon: "warning",
                            buttons: ["ยกเลิก", "ยืนยัน"],
                            dangerMode: true,
                        }).then((willSend) => {

                            if (willSend) {
                                axios.post('/inbound/system/add-quota.ins.php', {
                                    memb_id: checkboxes
                                }).then(function (response) {
                                    console.log(response.data);
                                    if(response.data.status == 'success') {
                                        swal("สำเร็จ", response.data.message, "success").then(function() {
                                            window.location.href = '/admin/quota';
                                        });
                                    } else {
                                        swal("เกิดข้อผิดพลาดบางอย่าง", response.data.message, "error");
                                    }
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