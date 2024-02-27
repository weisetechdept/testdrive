var testdrive = new Vue({
    el: '#testdrive',
    data: {
        sales:{
            id: '',
            quota: 0
        },
        bk:{
            car: [],
            time: [],
        },
        selected: {
            fname: '',
            lname: '',
            branch: '0',
            car: '0',
            date: '',
            time: '0',
            carimg: '',
            tel:'',
            condition: '',
            email: ''
        },
        infoDisplay: {
            topic: 'เลือกรุ่นรถยนต์ที่ต้องการทดลองขับ',
            car: '',
            time: ''
        }

    },
    mounted: function() {
        axios.get('/sales/system/booking.api.php?get=sales').then(function(response) {
            testdrive.sales.id = response.data.sales.id;
            testdrive.sales.quota = response.data.sales.quota;
        });

        var currentDate = new Date();
        currentDate.setDate(currentDate.getDate() + 7);
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
        var day = currentDate.getDate().toString().padStart(2, '0');
        var maxDate = year + '-' + month + '-' + day;
        document.getElementById('date').setAttribute('max', maxDate);

    },
    watch: {
        'selected.car': function(newCar, oldCar) {
            axios.post('/sales/system/booking.api.php?get=carInfo', {
                car: newCar
            }).then(function(response) {
                testdrive.infoDisplay.car = response.data.car.model;
            });
        },
        'selected.time': function(newTime, oldTime) {
            if(newTime == '1'){
                testdrive.infoDisplay.time = '08:00 - 08:45';
            } else if(newTime == '2'){
                testdrive.infoDisplay.time = '09:00 - 09:45';
            } else if(newTime == '3'){
                testdrive.infoDisplay.time = '10:00 - 10:45';
            } else if(newTime == '4'){
                testdrive.infoDisplay.time = '11:00 - 11:45';
            } else if(newTime == '5'){
                testdrive.infoDisplay.time = '12:00 - 12:45';
            } else if(newTime == '6'){
                testdrive.infoDisplay.time = '13:00 - 13:45';
            } else if(newTime == '7'){
                testdrive.infoDisplay.time = '14:00 - 14:45';
            } else if(newTime == '8'){
                testdrive.infoDisplay.time = '15:00 - 15:45';
            } else if(newTime == '9'){
                testdrive.infoDisplay.time = '16:00 - 16:45';
            }
        }
    },
    methods: {
        getCar(e) {
            axios.post('/sales/system/booking.api.php?get=car', {
                branch: e.target.value
            }).then(function(response) {
                
                testdrive.bk.car = response.data.car;
                testdrive.selected.car = '0';
                testdrive.selected.date = '';
                testdrive.selected.time = '0';

                document.getElementById('date').disabled = true;
                document.getElementById('time').disabled = true;
                document.getElementById('carimg').style.display = 'none';
                
            });

        },
        getDate(e) {
            testdrive.selected.car = e.target.value;

            document.getElementById('date').disabled = false;

            testdrive.selected.carimg = testdrive.bk.car.find(x => x.id == e.target.value).img;
            document.getElementById('carimg').style.display = 'block';

            testdrive.selected.date = '';
            testdrive.selected.time = '0';

            
            
        },
        getTime(e) {
            document.getElementById('time').disabled = false;
            axios.post('/sales/system/booking.api.php?get=time', {
                date: e.target.value,
                car: testdrive.selected.car
            }).then(function(response) {
                
                testdrive.bk.time = response.data.time;
                testdrive.selected.time = '0';
            });
        },
        nextStep1() {
            if(testdrive.selected.car == '0'){
                swal("โปรดเลือกรุ่นรถยนต์","แตะที่รถเพื่อเลือกรุ่นที่ต้องการทดลองขับ", {
                    icon: "warning",
                });
                return;
            } else {
                document.getElementById('step1').style.display = 'none';
                document.getElementById('barStep1').classList.remove('active');
                document.getElementById('barStep2').classList.add('active');
                document.querySelector('.step2').style.display = 'block';
                this.infoDisplay.topic = 'นัดหมายวันที่ เวลา ที่ต้องการทดลองขับ';
            }
        },
        nextStep2() {
            if(testdrive.selected.branch == '0' || testdrive.selected.car == '0' || testdrive.selected.date == '0' || testdrive.selected.time == '0'){
                swal("โปรดตรวจสอบ","กรุณากรอกข้อมูลให้ครบถ้วน", {
                    icon: "warning",
                });
                return;
            } else {
                document.getElementById('step1').style.display = 'none';
                document.getElementById('barStep2').classList.remove('active');
                document.getElementById('barStep3').classList.add('active');
                document.querySelector('.step2').style.display = 'none';
                document.querySelector('.step3').style.display = 'block';
                this.infoDisplay.topic = 'กรอกข้อมูลส่วนตัว';
            }
        },
        branchSelected(e) {

            var branch = document.querySelectorAll('.tab-radio');
            branch.forEach(function(item) {
                item.classList.remove('b-active');
            });
            e.currentTarget.classList.add('b-active');
            document.querySelector('.select-car').style.display = 'block';
            this.selected.branch = e.currentTarget.querySelector('input').value;

            testdrive.selected.car = '0';
            testdrive.selected.date = '';
            testdrive.selected.time = '0';

                axios.post('/sales/system/booking.api.php?get=car', {
                    branch: e.currentTarget.querySelector('input').value
                }).then(function(response) {
                    testdrive.bk.car = response.data.car;
                    document.getElementById('time').disabled = true;
                });
            
        },
        insData(){
            if( testdrive.selected.car == '0' || testdrive.selected.date == '0' || testdrive.selected.time == '0' || 
                testdrive.selected.fname == '' || testdrive.selected.lname == '' || testdrive.selected.tel == ''){
                    swal("โปรดตรวจสอบ","กรุณากรอกข้อมูลให้ครบถ้วน", {
                        icon: "warning",
                    });
                    return;
            } else if(testdrive.selected.condition == false){
                swal("โปรดตรวจสอบ","กรุณายอมรับข้อกำหนดและเงื่อนไข", {
                    icon: "warning",
                });
                return;

            } else {
                axios.post('/frontend/system/booking.ins.php',{
                    car: testdrive.selected.car,
                    date: testdrive.selected.date,
                    time: testdrive.selected.time,
                    fname: testdrive.selected.fname,
                    lname: testdrive.selected.lname,
                    tel: testdrive.selected.tel,
                    condition: testdrive.selected.condition,
                    email: testdrive.selected.email
                }).then(function(response) {

                    if(response.data.status == 'success'){
                        swal("ทำการจองสำเร็จ","บริษัท จะมอบหมายที่ปรึกษาการขายติดต่อ \n เพื่อยืนยันสิทธิ์ (วัน - เวลา) อีกครั้ง", {
                            icon: "success",
                        }).then((value) => {
                            window.location.href = '/thank';
                        });
                    } else {
                        swal("ไม่สำเร็จ","โปรดทำรายการใหม่อีกครั้ง",response.data.message, {
                            icon: "error",
                        })
                    }
                });
            }
        }
        
    }
});

const tabsBox = document.querySelector(".tabs-box"),
allTabs = tabsBox.querySelectorAll(".tab"),
arrowIcons = document.querySelectorAll(".icon i");

let isDragging = false;

const handleIcons = (scrollVal) => {
    let maxScrollableWidth = tabsBox.scrollWidth - tabsBox.clientWidth;
    arrowIcons[0].parentElement.style.display = scrollVal <= 0 ? "none" : "flex";
    arrowIcons[1].parentElement.style.display = maxScrollableWidth - scrollVal <= 1 ? "none" : "flex";
}

arrowIcons.forEach(icon => {
    icon.addEventListener("click", () => {
        let scrollWidth = tabsBox.scrollLeft += icon.id === "left" ? -324 : 324;
        handleIcons(scrollWidth);
    });
});

allTabs.forEach(tab => {
    tab.addEventListener("click", () => {
        tabsBox.querySelector(".active").classList.remove("active");
        tab.classList.add("active");
    });
});

const dragging = (e) => {
    if(!isDragging) return;
    tabsBox.classList.add("dragging");
    tabsBox.scrollLeft -= e.movementX;
    handleIcons(tabsBox.scrollLeft)
}

const dragStop = () => {
    isDragging = false;
    tabsBox.classList.remove("dragging");
}

tabsBox.addEventListener("mousedown", () => isDragging = true);
tabsBox.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);
