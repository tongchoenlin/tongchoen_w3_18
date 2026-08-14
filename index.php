<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore | หน้าหลัก</title>
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
                <a href="index.php" class="current">หน้าหลัก</a>
                <a href="manage_game.php">จัดการเกม</a>
                <a href="add_game.php">เพิ่มเกม</a>
                <a href="game_type.php">ประเภทเกม</a>
            </nav>
        </div>
        <div class="site-header-bottom">
            <nav class="site-nav-bottom">
                <a href="index.php" class="current">รายการเกม <span class="chevron">▾</span></a>
                <a href="manage_game.php">จัดการข้อมูล <span class="chevron">▾</span></a>
                <a href="game_type.php">หมวดหมู่ <span class="chevron">▾</span></a>
            </nav>
            <div class="site-search">
                <input type="text" placeholder="ค้นหาเกมในร้าน...">
            </div>
        </div>
    </header>

    <h1>รายการเกมทั้งหมด</h1>

    <?php
    //แสดง error

// Report all PHP errors
error_reporting(E_ALL);

// บังคับให้แสดงข้อผิดพลาดบนหน้าจอ
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

        include 'action/connect.php';

      //  if(!$con){
     //       echo 'Can Not Connect DB.';
      //  }else{
     //       echo 'Connect Success.';
      //  }
//           เลือก ทั้งหมด จาก ตารางgame 
      $sql = "SELECT * FROM games";
      //            ทำงานที่ไหน,ทำอะไร
      $result = mysqli_query($con, $sql);
      // ทดสอบ
    // var_dump($result);
    ?>

    <table border=1>
        <thead>
            <th>รหัสเกม</th>
            <th>ชื่อเกม</th>
            <th>ราคา</th>
            <th>ภาพปก</th>
            <th>ประเภท</th>
        </thead>

        <?php
            foreach($result as $game){
                      ?>
                    <tr>
                        <td> <?= $game["game_id"] ?> </td>
                        <td><?= $game["game_name"] ?> </td>
                        <td><?= $game["game_pice"] ?> </td>
                        <td>
                            <img
                                 src="<?= $game["game_cover"] ?>"
                                 style="width:200px;"
                                 >
                        </td>
                            
                        <td><?= $game["type_id"] ?> </td>   
                    </tr>
                    <?php

                    }
            ?>         
    </table>

    <?php
        foreach($result as $game){
            //var_dump($game);
        }
        ?>
    <a href="game_type.php" class="btn">ดูประเภทเกม</a>
</body>
</html>