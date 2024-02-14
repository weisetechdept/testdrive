<?php
    session_start();
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Alpha 77 Admin</title>
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

        <div class="main-content">

            <div class="page-content pt-4">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">รายการจอง</h4>
                            </div>
                        </div>
                    </div>    

                    <div class="row" id="search">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">รถทดลองขับ</label>
                                            <select id="car" name="car" class="form-control">
                                                <option value="0">= เลือกรถทดลองขับ =</option>
                                                <option value="1">Toyota Yaris</option>
                                                <option value="2">Toyota Vios</option>
                                                <option value="3">Toyota Altis</option>
                                                <option value="4">Toyota Camry</option>
                                                <option value="5">Toyota Fortuner</option>
                                                <option value="6">Toyota Hilux</option>
                                                <option value="7">Toyota C-HR</option>
                                                <option value="8">Toyota Corolla Cross</option>
                                                <option value="9">Toyota Sienta</option>
                                                <option value="10">Toyota Innova</option>
                                                <option value="11">Toyota Commuter</option>
                                                <option value="12">Toyota Hiace</option>
                                                <option value="13">Toyota Alphard</option>
                                                <option value="14">Toyota Vellfire</option>
                                                <option value="15">Toyota GR Yaris</option>
                                                <option value="16">Toyota GR Supra</option>
                                                <option value="17">Toyota GR Fortuner</option>
                                                <option value="18">Toyota GR Hilux</option>
                                                <option value="19">Toyota GR 86</option>
                                                <option value="20">Toyota GR Corolla</option>
                                                <option value="21">Toyota GR Land Cruiser</option>
                                                <option value="22">Toyota GR Hiace</option>
                                                <option value="23">Toyota GR Alphard</option>
                                                <option value="24">Toyota GR Vellfire</option>
                                                <option value="25">Toyota GR Yaris Cross</option>
                                                <option value="26">Toyota GR Supra GT4</option>
                                                <option value="27">Toyota GR Super Sport</option>
                                                <option value="28">Toyota GR Super Sport Hypercar</option>
                                                <option value="29">Toyota GR Super Sport Concept</option>
                                                <option value="30">Toyota GR Super Sport LM Hypercar</option>
                                                <option value="31">Toyota GR Super Sport LM Hypercar Concept</option>
                                                <option value="32">Toyota GR Super Sport LM Hypercar Prototype</option>
                                                <option value="33">Toyota GR Super Sport LM Hypercar Prototype Concept</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="date">วันที่จอง</label>
                                            <input type="date" id="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="time">เวลาจอง</label>
                                            <select id="time" name="time" class="form-control">
                                                <option value="0">= เลือกเวลา =</option>
                                                <option value="1">08:00น. - 08:45น.</option>
                                                <option value="2">09:00น. - 09:45น.</option>
                                                <option value="3" disabled>10:00น. - 10:45น.</option>
                                                <option value="4" disabled>11:00น. - 11:45น.</option>
                                                <option value="5">12:00น. - 12:45น.</option>
                                                <option value="6">13:00น. - 13:45น.</option>
                                                <option value="7">14:00น. - 14:45น.</option>
                                                <option value="8">15:00น. - 15:45น.</option>
                                                <option value="9">16:00น. - 16:45น.</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary waves-effect waves-light" @click="chkAgrnt">จองรถ</button>
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
       
    </script>


    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>