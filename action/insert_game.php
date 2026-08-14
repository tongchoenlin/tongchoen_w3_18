<?php 
error_reporting(E_ALL); 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 

$game_id = $_POST["game_id"]; 
$game_name = $_POST["game_name"]; 
$game_pice = $_POST["game_pice"]; 
$game_cover = $_POST["game_cover"]; 
$type_id = $_POST["type_id"];
// 1. นำบรรทัดรับค่ากลับมา (และแปลงเป็นตัวเลข int)
$type_id = !empty($_POST["type_id"]) ? (int)$_POST["type_id"] : 0; 

include 'connect.php'; 

// 2. ใช้ตัวแปร $typr_id ที่ส่งมาจากฟอร์มเข้าไปใส่ในคำสั่ง SQL (เอาตัวแปรใส่เข้าไปตรงๆ ไม่ต้องมีครอบเครื่องหมายคำพูดดี่ยว)
$sql = "INSERT INTO `games` (`game_id`, `game_name`, `game_pice`, `game_cover`, `type_id`) 
        VALUES ('$game_id', '$game_name', '$game_pice', '$game_cover', $typr_id)"; 

$result = mysqli_query($con,$sql); 

if(!$result){ 
    echo "error"; 
}else{ 
    header("location: ../index.php"); 
    exit; 
}
