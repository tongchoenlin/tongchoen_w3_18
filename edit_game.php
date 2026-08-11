<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลเกม</title>
    <style>
        /* ===== สไตล์พื้นหลังและฟอนต์ของหน้าเว็บ ===== */
        body {
            font-family: "Segoe UI", "Tahoma", "Noto Sans Thai", sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 30px;
            color: #2c3e50;
        }

        /* ===== กล่องจัดระเบียบฟอร์ม ===== */
        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* ===== ตกแต่งข้อความกำกับและช่องกรอกข้อมูล ===== */
        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: 600;
            color: #2c3e50;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #dcdfe6;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
            background-color: #fff;
            color: #2c3e50;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        /* เอฟเฟกต์เมื่อคลิกเลือกช่องกรอกข้อมูล */
        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.15);
        }

        /* ===== ตกแต่งปุ่มบันทึก ===== */
        button {
            display: block;
            width: 100%;
            padding: 12px 0;
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: #ffffff;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 10px rgba(44, 62, 80, 0.25);
            cursor: pointer;
            margin-top: 25px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        /* เอฟเฟกต์เมื่อเอาเมาส์วางบนปุ่ม */
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(44, 62, 80, 0.35);
        }

        /* เอฟเฟกต์ตอนกดปุ่ม */
        button:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>

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
    <select name="typr_id" id="">
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
                    <?= $type["type_id"] == $game["typr_id"] ? "selected" : "" ?>
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