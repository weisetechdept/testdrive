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
    <title>Alpha X Admin</title>
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
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="/admin/addevent" type="button" class="btn btn-primary btn-block">
                                            <i class="mdi mdi-plus"></i> เพิ่มการนำรถไปใช้ทำกิจกรรม
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-10">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-4 font-size-18">รายการจองทั้งหมดของ <?php echo strtoupper($branch); ?></h4>

                                        <table id="datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>รหัส</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>หมายเหตุ</th>
                                                    <th>รถยนต์</th>
                                                    <th>จากวันที่</th>
                                                    <th>ถึงวันที่</th>
                                                    <th>สถานะ</th>
                                                    <th>วันที่แจ้ง</th>
                                                    <th>จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
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
            ajax: '/inbound/system/eventblock.api.php?get=list',
            "columns" : [
                {'data':'0'},
                {'data':'1'},
                {'data':'2'},
                {'data':'3'},
                {'data':'4'},
                {'data':'5'},
                {'data':'6',
                    render: function(data, type, row, meta){
                        if(data == '1'){
                            return '<span class="badge badge-success">ใช้งาน</span>';
                        }else if(data == '10'){
                            return '<span class="badge badge-danger">ยกเลิก</span>';
                        }
                    }
                },
                {'data':'7'},
                {'data':'0',
                    render: function(data, type, row, meta){
                        return '<button onClick="upStatus('+data+')" class="btn btn-outline-warning btn-sm">เปลี่ยนสถานะ</button>';
                    }
                }
            ]
        });

        function upStatus(id){
            swal({
                title: "คุณต้องการเปลี่ยนสถานะใช่หรือไม่?",
                text: "เมื่อเปลี่ยนสถานะแล้วจะไม่สามารถย้อนกลับได้",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.get('/inbound/system/eventblock.api.php?get=update&id='+id)
                    .then(function (response) {
                        if(response.data.status == 'success'){
                            swal("เปลี่ยนสถานะสำเร็จ", {
                                icon: "success",
                            });
                            $('#datatable').DataTable().ajax.reload();
                        } else {
                            swal("เปลี่ยนสถานะไม่สำเร็จ", {
                                icon: "error",
                            });
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            });
        }

    </script>
    <script src="/assets/js/theme.js"></script>

</body>

</html>