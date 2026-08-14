<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore | ประเภทเกม</title>
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
                <a href="manage_game.php">จัดการเกม</a>
                <a href="add_game.php">เพิ่มเกม</a>
                <a href="game_type.php" class="current">ประเภทเกม</a>
            </nav>
        </div>
        <div class="site-header-bottom">
            <nav class="site-nav-bottom">
                <a href="index.php">รายการเกม <span class="chevron">▾</span></a>
                <a href="manage_game.php">จัดการข้อมูล <span class="chevron">▾</span></a>
                <a href="game_type.php" class="current">หมวดหมู่ <span class="chevron">▾</span></a>
            </nav>
            <div class="site-search">
                <input type="text" placeholder="ค้นหาเกมในร้าน...">
            </div>
        </div>
    </header>

    <h1>ประเภทเกมทั้งหมด</h1>

    <?php
    // แสดง error ในกรณีที่เกิดปัญหา
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    // ดึงไฟล์เชื่อมต่อฐานข้อมูล
    include 'action/connect.php';

    // คำสั่ง SQL ดึงข้อมูลจากตาราง game_tyeps (พิมพ์สะกดตามในรูปภาพ)
    $sql = "SELECT * FROM game_tyeps";
    $result = mysqli_query($con, $sql);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>รหัสประเภท</th>
                <th>ชื่อประเภทเกม</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // วนลูปแสดงข้อมูลประเภทเกม
            foreach($result as $type){
        ?>
                <tr>
                    <td><?= $type["type_id"] ?></td>
                    <td><?= $type["type_name"] ?></td>
                </tr>
        <?php
            }
        ?>         
        </tbody>
    </table>


</body>
</html>