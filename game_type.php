<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประเภทเกม</title>
</head>
<body>

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

    <br>
    <a href="index.php" class="btn">กลับหน้าหลัก</a>

</body>
</html>