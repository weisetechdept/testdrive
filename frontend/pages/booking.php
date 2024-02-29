<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>จองรถทดลองขับ Toyota Paragon Motor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Toyota Paragon Motor Test Drive" name="description" />
    <meta content="Toyota Paragon Motor Test Drive" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <link href="/assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@100;200;300;400;500;600;700;800&family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/theme.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="/assets/css/frontend.css?r=<?php echo rand(0,999999);?>">

</head>

<body>
    <div id="testdrive">
                
    <header id="page-topbar">
        <div id="nav" class="navbar-header">
            <div class="d-flex align-items-left">
                <div class="d-flex align-items-left">
                    <img src="/assets/images/logo-toyotaparagon.png" alt="Logo" height="40" class="logo logo-dark">
                    <div class="s-li">ลงทะเบียนทดลองขับ</div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                
            </div>
        </div>
    </header>

    <div class="navbar-custom mt-main">
      
        <div class="navbar-topic">
            <p class="mb-0">{{ infoDisplay.topic }}</p>
        </div>

        <div class="red-bar mb-0">
            <div class="step active" id="barStep1">ขั้นตอน 1</div>
            <div class="step" id="barStep2">ขั้นตอน 2</div>
            <div class="step" id="barStep3">ขั้นตอน 3</div>
        </div>
    </div>

    <div id="layout-wrapper">

            <div class="container-fluid" id="step1"> 
                
                <div class="row">
                    <div class="card" style="border-radius: 0rem;border: 0;width: 100%;">
                        <div class="card-body" style="padding: 15px 0;">
                            <p style="text-align:center;margin: 15px 0 0 0;">เลือกสาขาที่ต้องการทดลองขับ</p>

                            <ul class="branch mt-4 mb-4">
                                <li class="tab-radio" @click="branchSelected">
                                    <label for="car1">สาขา<br />รังสิต คลอง 7</label>
                                    <input type="radio" id="car1" name="branch" value="ho">
                                </li>
                                <li class="tab-radio" @click="branchSelected">
                                    <label for="car2">สาขา<br />ตลาดไท</label>
                                    <input type="radio" id="car2" name="branch" value="tm">
                                </li>
                            </ul>

                            <div class="select-car">
                                <p style="text-align:center;margin: 70px 0 0 0;">เลือกรถยนต์ที่ต้องการทดลองขับ</p>
                                <div class="wrapper">
                                    <div class="icon"><i id="left" class="fa-solid fa-angle-left"></i></div>
                                    <ul class="tabs-box">

                                        <li class="tab" v-for="c in bk.car" :key="c.id" @click="selected.car = c.id" @change="getDate" :class="{ active: selected.car == c.id }">
                                            <img :src="c.img">
                                        </li>

                                    </ul>
                                    <div class="icon"><i id="right" class="fa-solid fa-angle-right"></i></div>
                                </div>
                                <div class="text-center mb-4">
                                    <button class="btn btn-danger waves-effect waves-light" @click="nextStep1">ถัดไป</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content pt-2 step2 animate__animated animate__fadeInRight">
                <div class="container-fluid"> 

                    <div class="row justify-content-md-center">

                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body">

                                    <label for="car">สาขาที่ต้องการทดลองขับ</label>
                                    <p class="book-tp" v-if="selected.branch == 'ho'">สำนักงานใหญ่ (รังสิตคลอง 7)</p>
                                    <p class="book-tp"  v-if="selected.branch == 'tm'">ตลาดไท</p>

                                    <label for="car">รถยนต์ทดลองขับ</label>
                                    <p class="book-tp">{{ infoDisplay.car }}</p>

                                    <div class="mb-3">

                                        <div class="form-group">
                                            <label for="date">วันที่จอง</label>
                                            <input type="date" id="date" class="form-control" v-model="selected.date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" @change="getTime">
                                        </div>

                                        <div class="form-group">
                                            <label for="time">เวลาจอง</label>
                                            <select id="time" name="time" v-model="selected.time" class="form-control" disabled>
                                                <option value="0">= เลือกเวลา =</option>
                                                <option v-for="t in bk.time" v-if="t.status == 1" :value="t.id">{{ t.time }}</option>
                                                <option v-for="t in bk.time" v-if="t.status == 0" :value="t.id" disabled>{{ t.time }} (ไม่ว่าง)</option>
                                            </select>
                                        </div>
                                        <div class="text-center">
                                            <p>บริษัท จะมอบหมายที่ปรึกษาการขาย<br />ติดต่อเพื่อยืนยันสิทธิ์ (วัน - เวลา) อีกครั้ง</p>
                                        </div>
                                        
                                    </div>
                                    <div class="text-center mt-4 pt-2 mb-3">
                                        <button class="btn btn-danger waves-effect waves-light" @click="nextStep2">ถัดไป</button>
                                    </div>
                                       
                                </div>
                            </div>
                        </div>
                    </div>

                  

                </div>
            </div>

            <div class="page-content pt-2 step3 animate__animated animate__fadeInRight">
                <div class="container-fluid"> 

                    <div class="row justify-content-md-center">

                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body">

                                    <label for="car">สาขาที่ต้องการทดลองขับ</label>
                                    <p class="book-tp" v-if="selected.branch == 'ho'"><b>สำนักงานใหญ่ (รังสิตคลอง 7)</b><br />41/1 หมู่ 2 ถ.รังสิต-นครนายก<br />ต.ลำผักกูด อ.ธัญบุรี จ.ปทุมธานี<br />โทร 02 957 1111</p>
                                    <p class="book-tp"  v-if="selected.branch == 'tm'"><b>ตลาดไท</b>88 หมู่ 9 ถ.พหลโยธิน<br />ต.คลองหนึ่ง อ.คลองหลวง จ.ปทุมธานี<br />โทร 02 516 8000</p>

                                    <label for="car">รถยนต์ทดลองขับ</label>
                                    <p class="book-tp">{{ infoDisplay.car }}</p>

                                    <label for="date">วันที่จอง</label>
                                    <p class="book-tp">{{ selected.date }}</p>

                                    <label for="time">เวลาจอง</label>
                                    <p class="book-tp">{{ infoDisplay.time }}</p>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">ชื่อ (ไม่ใส่คำนำหน้า)</label>
                                            <input type="text" id="fname" v-model="selected.fname" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">นามสกุล</label>
                                            <input type="text" id="lname" v-model="selected.lname" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">เบอร์โทรศัพท์</label>
                                            <input type="text" id="tel" v-model="selected.tel" class="form-control" maxlength="10">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="car">อีเมล (ถ้ามี)</label>
                                            <input type="text" id="email" v-model="selected.email" class="form-control">
                                        </div>
                                    </div>

                                   
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <p>
                                                <input type="checkbox" class="mr-1" id="condition" v-model="selected.condition">
                                                ข้าพเจ้าได้อ่าน รับทราบและเข้าใจ<a href="https://home.toyotaparagon.com/%e0%b8%99%e0%b9%82%e0%b8%a2%e0%b8%9a%e0%b8%b2%e0%b8%a2%e0%b8%84%e0%b8%a7%e0%b8%b2%e0%b8%a1%e0%b9%80%e0%b8%9b%e0%b9%87%e0%b8%99%e0%b8%aa%e0%b9%88%e0%b8%a7%e0%b8%99%e0%b8%95%e0%b8%b1%e0%b8%a7/" target="_blank">รายละเอียด ข้อกำหนดและเงื่อนไข</a>ในการเก็บรวบรวม ใช้ และ/หรือเปิดเผยข้อมูลส่วนบุคคล ซึ่งเกี่ยวกับข้าพเจ้าในเว็บไซต์นี้โดยตลอดแล้วเห็นว่าถูกต้องตามความประสงค์ของข้าพเจ้า
                                            </p>
                                        </div>
                                    </div>
                                        

                                    <div class="text-center mt-4 pt-2 mb-3">
                                        <button class="btn btn-danger waves-effect waves-light" @click="insData">จองรถ</button>
                                    </div>
                                       
                                </div>
                            </div>
                        </div>
                    </div>

                  

                </div>
            </div>

           
      

    </div>
 

  
    <div class="menu-overlay"></div>
    </div>

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
    <script src="/assets/js/theme.js"></script>

    <script src="/assets/js/booking.js?r=<?php echo rand(0,999999);?>"></script>
</body>

</html>