<!DOCTYPE html>
<!-- ย้ายแท็ก <link> เข้ามาไว้ภายใน <head> ให้ถูกต้องตามมาตรฐาน HTML -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore | จัดการข้อมูลเกม</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="site-header">
    <div class="site-header-top">
        <a href="index.php" class="site-logo">
            <span class="site-logo-icon">🎮</span>
            <span class="site-logo-text">GameStore</span>
        </a>
        <nav class="site-nav-top">
            <a href="index.php">หน้าหลัก</a>
            <a href="manage_game.php" class="current">จัดการเกม</a>
            <a href="add_game.php">เพิ่มเกม</a>
            <a href="game_type.php">ประเภทเกม</a>
        </nav>
    </div>
    <div class="site-header-bottom">
        <nav class="site-nav-bottom">
            <a href="index.php">รายการเกม <span class="chevron">▾</span></a>
            <a href="manage_game.php" class="current">จัดการข้อมูล <span class="chevron">▾</span></a>
            <a href="game_type.php">หมวดหมู่ <span class="chevron">▾</span></a>
        </nav>
        <div class="site-search">
            <input type="text" placeholder="ค้นหาเกมในร้าน...">
        </div>
    </div>
</header>

<h1>จัดการข้อมูลเกม</h1>

<?php
// แสดง error ทั้งหมดบนหน้าจอ (ใช้ช่วงพัฒนาโปรแกรม)
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// ดึงไฟล์เชื่อมต่อฐานข้อมูล
include 'action/connect.php';

// ดึงข้อมูลเกมทั้งหมดจากตาราง games
$sql = "SELECT * FROM games";

// ส่งคำสั่ง SQL ไปประมวลผลผ่านตัวแปรเชื่อมต่อ $con
$result = mysqli_query($con, $sql);
?>

<!-- ตารางแสดงรายการข้อมูลเกม -->
<table border="1">
<thead>
    <tr>
        <th>รหัสเกม</th>
        <th>ชื่อเกม</th>
        <th>ราคา</th>
        <th>ภาพปก</th>
        <th>ประเภท</th>
        <th>จัดการ</th>
    </tr>
</thead>
<tbody>
<?php
// วนลูปนำข้อมูลเกมแต่ละรายการใน $result ออกมาแสดงผลในแต่ละแถว (<tr>)
foreach($result as $game){
?>
<tr>
    <!-- แสดงข้อมูลในแต่ละคอลัมน์ -->
    <td> <?= $game["game_id"] ?> </td>
    <td> <?= $game["game_name"] ?> </td>
    <td> <?= $game["game_pice"] ?> </td>
    <td>
        <!-- แท็กแสดงรูปภาพ นำ URL จากฐานข้อมูลมาใส่ใน src -->
        <img src="<?= $game["game_cover"] ?>" style="width:200px">
    </td>
    <td> <?= $game["type_id"] ?> </td>
    <td>
        <!-- ปุ่มแก้ไข: ส่ง game_id ผ่าน URL (GET) ไปยังหน้า edit_game.php -->
        <a href="edit_game.php?id=<?=$game['game_id']?>">แก้ไข</a>

        <!-- ปุ่มลบ: ส่ง game_id ผ่าน URL (GET) ไปให้ไฟล์ delete_game.php ประมวลผล -->
        <a href="action/delete_game.php?id=<?= $game['game_id']?>" onclick="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?');">ลบ</a>
    </td>
</tr>
<?php
}
?>
</tbody>
</table>

</body>
</html>