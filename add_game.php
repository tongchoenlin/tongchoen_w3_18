<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore | เพิ่มข้อมูลเกม</title>
    <!-- นำแท็ก <link> เข้ามาไว้ใน <head> ตามมาตรฐาน HTML -->
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
                <a href="manage_game.php">จัดการเกม</a>
                <a href="add_game.php" class="current">เพิ่มเกม</a>
                <a href="game_type.php">ประเภทเกม</a>
            </nav>
        </div>
        <div class="site-header-bottom">
            <nav class="site-nav-bottom">
                <a href="index.php">รายการเกม <span class="chevron">▾</span></a>
                <a href="manage_game.php">จัดการข้อมูล <span class="chevron">▾</span></a>
                <a href="game_type.php">หมวดหมู่ <span class="chevron">▾</span></a>
            </nav>
            <div class="site-search">
                <input type="text" placeholder="ค้นหาเกมในร้าน...">
            </div>
        </div>
    </header>

    <h1>เพิ่มข้อมูลเกม</h1>

    <!-- ฟอร์มรับข้อมูล:
         - action="action/insert_game.php" คือไฟล์ที่จะมารับค่าไปบันทึก
         - method="post" ซ่อนข้อมูลที่ส่ง ไม่ให้แสดงบน URL -->
    <form action="action/insert_game.php" method="post">

        <!-- ช่องกรอกข้อมูล: ค่า 'name' จะถูกนำไปใช้รับในฝั่ง PHP ผ่าน $_POST['...'] -->
        <label for="">รหัสเกม</label>
        <input type="text" name="game_id"> <br>
            
        <label for="">ชื่อเกม</label>
        <input type="text" name="game_name"> <br>

        <label for="">ราคา</label>
        <input type="text" name="game_pice"> <br>

        <label for="">ลิงค์ภาพปก</label>
        <input type="text" name="game_cover"> <br>

        <?php
        // ดึงไฟล์เชื่อมต่อฐานข้อมูลมาใช้งาน
        include 'action/connect.php';

        // ดึงข้อมูลประเภทเกมทั้งหมดจากตาราง game_tyeps
        $sql = "SELECT * FROM game_tyeps";
        $result = mysqli_query($con, $sql);
        ?>

        <label for="ประเภท">ประเภทเกม</label>
        <select name="type_id" id="">
            <?php
                // วนลูปนำข้อมูลประเภทเกมทุกแถวมาสร้างเป็นตัวเลือก Dropdown
                foreach($result as $type){
                    ?>
                    <!-- ลบช่องว่างตรง value ออกเพื่อป้องกันค่าติดเว้นวรรคไปลงฐานข้อมูล -->
                    <option value="<?= $type["type_id"] ?>"><?= $type["type_name"] ?></option>
                    <?php
                }
            ?>   
        </select>

        <br>
        <!-- ปุ่ม Submit สำหรับส่งข้อมูลในฟอร์ม -->
        <button type="submit">บันทึก</button>

    </form>
    
</body>
</html>