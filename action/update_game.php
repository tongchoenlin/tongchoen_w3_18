<?php

    // แสดง error ทั้งหมดบนหน้าจอ
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

// รับค่าข้อมูลใหม่ที่ส่งมาจากฟอร์มแก้ไข (ผ่าน Method POST)
$game_id = $_POST["game_id"];       // รหัสเกมเดิมที่ต้องการแก้ไข (ใช้ใน WHERE)
$game_name = $_POST["game_name"];   // ชื่อเกมใหม่
$game_pice = $_POST["game_pice"];   // ราคาใหม่
$game_cover = $_POST["game_cover"]; // ภาพปกใหม่
$type_id = $_POST["type_id"];       // รหัสประเภทเกมใหม่

// ดึงไฟล์เชื่อมต่อฐานข้อมูล
include 'connect.php';

    // คำสั่ง SQL สำหรับอัปเดตข้อมูลตาราง games โดยอ้างอิงจาก game_id
    $sql = "UPDATE `games`
    SET 
    `game_name`='$game_name',
    `game_pice`='$game_pice',
    `game_cover`='$game_cover',
    `type_id`='$type_id' 
    WHERE game_id = '$game_id'
    ";

    // ส่งคำสั่ง SQL ไปประมวลผลที่ฐานข้อมูล
    $result = mysqli_query($con, $sql);

// ตรวจสอบผลการทำงาน
if(!$result){
    // หากอัปเดตไม่สำเร็จ
    echo "error";
}else{
    // หากแก้ไขสำเร็จ ส่งผู้ใช้กลับไปหน้า index.php
    header("location: ../index.php");
    exit; // หยุดการทำงานของ Script ทันที
}