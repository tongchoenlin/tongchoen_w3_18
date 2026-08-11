<?php

    // แสดง error ทั้งหมดบนหน้าจอ (มีประโยชน์ตอนพัฒนา/ทดสอบ แต่ควรปิดเมื่อใช้งานจริงเพื่อความปลอดภัย)
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

// รับค่า id ของเกมที่ต้องการลบจาก URL (ผ่าน Method GET)
$id = $_GET['id'];

// ดึงไฟล์เชื่อมต่อฐานข้อมูลมาใช้งาน (ตัวแปร $con จะถูกนำมาใช้ต่อด้านล่าง)
include 'connect.php';

    // เขียนคำสั่ง SQL เพื่อลบข้อมูลในตาราง games โดยเลือกแถวที่ game_id ตรงกับค่า $id
    $sql = "DELETE FROM games WHERE game_id = '$id' ";
   
    // ส่งคำสั่ง SQL ไปประมวลผลที่ฐานข้อมูลผ่านการเชื่อมต่อ $con
    $result = mysqli_query($con, $sql);
    
// ตรวจสอบผลการรันคำสั่ง SQL
if(!$result){
    // ถ้าทำงานไม่สำเร็จ (เช่น เขียน SQL ผิด หรือหาตารางไม่เจอ) ให้แสดงข้อความ error
    echo "error";
}else{
    // ถ้าลบสำเร็จ ให้ส่งผู้ใช้งานกลับไปที่หน้า manage_game.php (ถอยกลับไป 1 โฟลเดอร์)
    header("location: ../manage_game.php");
    exit; // หยุดการทำงานของ Script ทันทีหลังส่ง header เพื่อป้องกันไม่ให้โค้ดส่วนอื่นถูกรันต่อ
}