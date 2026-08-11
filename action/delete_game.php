<?php

    // แสดง error ในกรณีเกิดปัญหาบนหน้าเว็บ
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

// รับค่า id ของเกมที่ต้องการลบจาก URL (ผ่าน Method GET)
$id = $_GET['id'];

// ดึงไฟล์เชื่อมต่อฐานข้อมูล
include 'connect.php';

    // คำสั่ง SQL ลบข้อมูลในตาราง games แถวที่ game_id ตรงกับค่า $id
    $sql = "DELETE FROM games WHERE game_id = '$id' ";
   
    // ส่งคำสั่ง SQL ไปประมวลผลที่ฐานข้อมูล
    $result = mysqli_query($con, $sql);
    
// ตรวจสอบผลการลบข้อมูล
if(!$result){
    // ถ้าลบไม่สำเร็จ
    echo "error";
}else{
    // ถ้าลบสำเร็จ ส่งผู้ใช้งานกลับไปที่หน้า manage_game.php
    header("location: ../manage_game.php");
    exit; // หยุดการทำงานของ Script ทันที
}