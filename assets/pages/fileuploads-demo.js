/*
 Template Name: Xacton - Admin & Dashboard Template
 Author: Myra Studio
 File: File Uploads
*/


$('.dropify').dropify({
    messages: {
        'default': 'แตะเพื่ออัพโหลดรูป',
        'replace': 'แตะเพื่ออัพโหลดรูปแก้ใข',
        'remove': 'ลบรูปภาพ',
        'error': 'เกิดข้อมผิดพลาด โปรดลองใหม่อีกครั้ง'
    },
    error: {
        'fileSize': 'ขนาดของรูปเกินปริมาณที่กำหนด (1M max).'
    }
});