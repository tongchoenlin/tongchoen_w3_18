<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore | แก้ไขข้อมูลเกม</title>
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

<h1>แก้ไขข้อมูลเกม</h1>

<?php
        // รับค่ารหัสเกม (id) ที่ส่งมาจาก URL ผ่าน Method GET (เช่น edit_game.php?id=1)
        $id = $_GET['id'];

        // ดึงไฟล์เชื่อมต่อฐานข้อมูล
        include 'action/connect.php';

        // ดึงข้อมูลของเกมเฉพาะ id ที่ตรงกับค่าที่รับมา
        $sql = "SELECT * FROM games WHERE game_id = '$id' ";

        // ประมวลผลคำสั่ง SQL
        $result = mysqli_query($con, $sql);

        // ดึงข้อมูลออกมา 1 แถวในรูปแบบ Array Associative เพื่อนำมาเติมใส่ในช่องกรอกข้อมูล (Value)
        $game = mysqli_fetch_assoc($result);

        // var_dump($game); // คำสั่งเช็คค่าตัวแปรเพื่อทดสอบความถูกต้อง (ปิดไว้)
?>

    <!-- ฟอร์มแก้ไขข้อมูลเกม ส่งข้อมูลใหม่ไปยังไฟล์ update_game.php ด้วย POST -->
    <form action="action/update_game.php" method="post">

    <!-- ช่องกรอกข้อมูลเดิม เพื่อให้ผู้ใช้กดแก้ไขเพิ่มเติม -->
    <!-- ปรับใส่ readonly ตรงรหัสเกม เพื่อป้องกันไม่ให้ผู้ใช้แก้ไข Primary Key -->
    <label for="">รหัสเกม</label>
    <input type="text" name="game_id" value="<?= $game['game_id'] ?>" readonly> <br>
        
    <label for="">ชื่อเกม</label>
    <input type="text" name="game_name" value="<?= $game['game_name'] ?>"> <br>

    <label for="">ราคา</label>
    <input type="text" name="game_pice" value="<?= $game['game_pice'] ?>"> <br>

    <label for="">ลิงค์ภาพปก</label>
    <input type="text" name="game_cover" value="<?= $game['game_cover'] ?>"> <br>

    <?php
    // ดึงรายการประเภทเกมทั้งหมดมาทำเป็นตัวเลือก Dropdown
    $sql_type = "SELECT * FROM game_tyeps";
    $result_type = mysqli_query($con, $sql_type);
    ?>
    <label for="ประเภท">ประเภท</label>
    <select name="type_id" id="">
        <?php
            // วนลูปสร้างตัวเลือก <option>
            foreach($result_type as $type){
                ?>
                <!-- 
                     1. ลบช่องว่างตรง value="<?= $type["type_id"] ?>" เพื่อไม่ให้ติดเว้นวรรค
                     2. แก้ไขการสะกด $game["typr_id"] ให้ตรงตามชื่อคอลัมน์เดิมในตาราง games
                     3. เช็คเงื่อนไข Ternary Operator: ถ้า type_id ของประเภท ตรงกับ typr_id ของเกม ให้ใส่คำสั่ง selected เพื่อดึงค่าเดิมขึ้นมาโชว์ก่อน
                -->
                <option 
                    value="<?= $type["type_id"] ?>" 
                    <?= $type["type_id"] == $game["type_id"] ? "selected" : "" ?>
                >
                    <?= $type["type_name"] ?> 
                </option>
                <?php
            }
        ?>   
    </select>

    <br>
    <!-- ปุ่มสำหรับกดเพื่อส่งข้อมูลที่แก้ไขแล้ว -->
    <button type="submit">บันทึกการแก้ไข</button>

    </form>
    
</body>
</html>