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
    </style>
</head>

<body>
    <?php include_once('include/nav.php'); ?>
    <?php include_once('include/sidebar.php'); ?>
    <div id="layout-wrapper">

        <div class="main-content">

            <div class="page-content pt-4">
                <div class="container-fluid">

                    <div class="row home-content">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">การจองทั้งหมดเดือน </h4>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                   
                                    <table id="datatable" class="table dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>ลูกค้า</th>
                                                <th>วัน</th>
                                                <th>เวลา</th>
                                                <th>รถยนต์</th>
                                                <th>ที่มา</th>
                                                <th>ผู้ดูแล</th>
                                                <th>สถานะ</th>
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
       $('#datatable').DataTable({
            "order": [[ 1, "desc" ]],
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
            ajax: '/mgr/system/testBk.api.php?get=list&date=<?php echo $date; ?>',
            "columns" : [
                {'data':'1'},
                {'data':'3',
                    "render": function ( data, type, full, meta ) {
                        var d = new Date(data);
                        var month = d.getMonth()+1;
                        var day = d.getDate();
                        var output = (day<10 ? '0' : '') + day + '/' + (month<10 ? '0' : '') + month;
                        return output;
                    }
                },
                {'data':'4'},
                {'data':'2'},
                {'data':'6',
                    "render": function ( data, type, full, meta ) {
                        if(data == '1'){
                            return '<span class="badge badge-success">ออนไลน์</span>';
                        }else if(data == '2'){
                            return '<span class="badge badge-primary">เซลล์</span>';
                        } else if(data == '3') {
                            return '<span class="badge badge-info">TBR</span>';
                        }  else if(data == '4') {
                            return '<span class="badge badge-secondary">Walk-in</span>';
                        }
                    }
                },
                {'data':'7'},
                { 
                    'data': '5',
                    sortable: false,
                    "render": function ( data, type, full, meta ) {
                        if(data == '0'){
                            return '<span class="badge badge-soft-warning">ยังไม่ทดลองขับ</span>';
                        } else if(data == '1') {
                            return '<span class="badge badge-soft-primary">เบิกกุญแจ</span>';
                        } else if(data == '2') {
                            return '<span class="badge badge-soft-success">สำเร็จ</span>';
                        } else if(data == '10') {
                            return '<span class="badge badge-soft-danger">ยกเลิก</span>';
                        }
                    }
                },
                { 
                    'data': '0',
                    sortable: false,
                    "render": function ( data, type, full, meta ) {
                        return '<a href="/mgr/de/'+data+'" class="btn btn-sm btn-outline-primary editBtn" role="button"><span class="mdi mdi-account-edit"></span> จัดการ</a>';
                    }
                }
            ],
        });

        var count = new Vue({
            el: '#count',
            data: {
                all: 0,
                
            },
            mounted: function () {
                axios.get('/mgr/system/testBk.api.php?get=count&date=<?php echo $date; ?>').then(response => {

                    console.log(response.data);
                });
            }
        });

    </script>


    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>