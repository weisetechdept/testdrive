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

                    <div id="dedrive">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-4 font-size-18">รายการจองทั้งหมด</h4>

                                        <div class="form-row">
                                          <div class="col-md-3 mb-3">
                                            <label>ตั้งแต่วันที่</label>
                                            <input type="date" id="formdate" class="form-control" v-model="search.formdate">
                                          </div>
                                          <div class="col-md-3 mb-3">
                                            <label>ถึงวันที่</label>
                                            <input type="date" id="todate" class="form-control" v-model="search.todate">
                                          </div>
                                          <div class="col-md-3 mb-3">
                                            <label>โมเดลรถยนต์</label>
                                            <select class="form-control" v-model="search.model" id="model">
                                                <option value="all">ทั้งหมด</option>
                                                <option v-for="item in model" :value="item.id">{{ item.model }}</option>
                                            </select>
                                          </div>
                                          <div class="col-md-3 mb-3">
                                            <label>สถานะ</label>
                                            <select class="form-control" v-model="search.status" id="status">
                                                <option value="all">ทั้งหมด</option>
                                                <option value="0">ยังไม่ทดลองขับ</option>
                                                <option value="1">รับกุญแจ</option>
                                                <option value="2">สำเร็จ</option>
                                                <option value="10">ยกเลิก</option>
                                            </select>
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
                                        <h4 class="mb-4 font-size-18">รายการจองทั้งหมดของ <?php echo strtoupper($branch); ?></h4>
                                        

                                        <table id="datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>รหัสจอง</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>เบอร์โทรศัพท์</th>
                                                    <th>โมเดล</th>
                                                    <th>วันที่จอง</th>
                                                    <th>เวลาที่จอง</th>
                                                    <th>เซลล์</th>
                                                    <th>ที่มา</th>
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
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>รหัสจอง</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>เบอร์โทรศัพท์</th>
                                                    <th>โมเดล</th>
                                                    <th>วันที่จอง</th>
                                                    <th>เวลาที่จอง</th>
                                                    <th>เซลล์</th>
                                                    <th>ที่มา</th>
                                                    <th>สถานะ</th>
                                                    <th>จัดการ</th>
                                                </tr>
                                            </tfoot>
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
        ajax: '/inbound/system/report.api.php?ac=search',
        "columns" : [
            {'data':'0'},
            {'data':'1'},
            {'data':'2'},
            {'data':'3'},
            {'data':'4'},
            {'data':'5'},
            {'data':'6'},
            {'data':'9',
                "render": function ( data, type, full, meta ) {
                    if(data == '1'){
                        return '<span class="badge badge-success">ออนไลน์</span>';
                    }else if(data == '2'){
                        return '<span class="badge badge-primary">เซลล์</span>';
                    } else if(data == '3') {
                        return '<span class="badge badge-info">TBR</span>';
                    }
                }
            },
            {'data':'7',
                "render": function ( data, type, full, meta ) {
                    if(data == '0'){
                        return '<span class="badge badge-warning">ยังไม่ทดลองขับ</span>';
                    }else if(data == '1'){
                        return '<span class="badge badge-primary">รับกุญแจ</span>';
                    }else if(data == '2'){
                        return '<span class="badge badge-success">สำเร็จ</span>';
                    }else if(data == '10'){
                        return '<span class="badge badge-danger">ยกเลิก</span>';
                    }
                }
            },
            { 
                'data': '0',
                sortable: false,
                "render": function ( data, type, full, meta ) {
                    return '<a href="/admin/de/'+data+'" class="btn btn-sm btn-outline-primary editBtn" role="button"><span class="mdi mdi-account-edit"></span> จัดการ</a>';
                }
            }
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'print'
        ]
        
    });

    var dedrive = new Vue({
        el: '#dedrive', 
        data: {
            model: [],
            search: {
                formdate: '<?php echo date('Y-m-01');?>',
                todate: '<?php echo date('Y-m-d');?>',
                model: 'all',
                status: 'all'
            }
        },
        mounted () {
            axios.get('/inbound/system/report.api.php?ac=car').then(function(response) {
                dedrive.model = response.data.car;
            });
        },
        methods: {
            searchData(){
                $('#datatable').DataTable().ajax.url('/inbound/system/report.api.php?ac=search&formdate=' + dedrive.search.formdate + '&todate=' + dedrive.search.todate +'&status=' + dedrive.search.status +'&model=' + dedrive.search.model).load(function() {
                    if(this.data.length == 0){
                        swal("ไม่พบข้อมูล", "ไม่พบข้อมูลในช่วงเวลา "+dedrive.search.formdate+" ถึง "+dedrive.search.todate+" กรุณาลองใหม่อีกครั้ง", "error");
                    } else {
                        swal("ค้นหาสำเร็จ", "ค้าหาข้อมูลช่วงเวลา "+dedrive.search.formdate+" ถึง "+dedrive.search.todate+" สำเร็จ!", "success");
                    }
                    
                });
            }
        }
    });

    </script>
    <script src="/assets/js/theme.js"></script>

</body>

</html>