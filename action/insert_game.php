<?php

    // แสดง error ในกรณีที่เกิดปัญหา
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

$game_id = $_POST["game_id"];
$game_name = $_POST["game_name"];
$game_pice = $_POST["game_pice"];
$game_cover = $_POST["game_cover"];
$typr_id = $_POST["typr_id"];

include 'connect.php';

    $sql = "INSERT INTO `games`
    (`game_id`, `game_name`, `game_pice`, `game_cover`, `typr_id`) 
    VALUES 
    ('$game_id','$game_name','$game_pice','$game_cover','$typr_id')";

    $result = mysqli_query($con, $sql);
if(!$result){
    echo "error";
}else{
    header("location: ../index.php");
    exit;
}
