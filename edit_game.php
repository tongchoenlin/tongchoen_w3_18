<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* ===== General Page Style ===== */
        body {
            font-family: "Segoe UI", "Tahoma", "Noto Sans Thai", sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 30px;
            color: #2c3e50;
        }

        /* ===== Form Container ===== */
        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* ===== Form Elements ===== */
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

        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.15);
        }

        /* ===== Submit Button ===== */
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

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(44, 62, 80, 0.35);
        }

        button:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>

<?php
        // <!--รับไอดีที่จะแก้ไขมา-->
        $id = $_GET['id'];

        include 'action/connect.php';

        $sql = "SELECT * FROM games WHERE game_id = '$id' ";

        $result = mysqli_query($con, $sql);

        $game = mysqli_fetch_assoc($result);

        // var_dump($game);
?>

    <form action="action/update_game.php" method="post">

    <label for="">รหัสเกม</label>
    <input type="text" name="game_id" value="<?= $game['game_id'] ?>"> <br>
        
    <label for="">ชื่อเกม</label>
    <input type="text" name="game_name" value="<?= $game['game_name'] ?>"> <br>

    <label for="">ราคา</label>
    <input type="text" name="game_pice" value="<?= $game['game_pice'] ?>"> <br>

    <label for="">ลิงค์ภาพปก</label>
    <input type="text" name="game_cover" value="<?= $game['game_cover'] ?>"> <br>

    <?php
    include 'action/connect.php';

    $sql = "SELECT * FROM game_tyeps";

    $result = mysqli_query($con, $sql);
    ?>
    <label for="ประเภท">ประเภท</label>
    <select name="typr_id" id="">
        <?php
            foreach($result as $type){
                ?>
                <option 
                value=" <?= $type ["type_id"] ?> "
                <?= $type["type_id"] == $game["type_id"] ? "selected" : ""?>
                 >
                  <?= $type ["type_name"] ?> </option>
                <?php
            }
?>   
                
               


    </select>

    <br>
    <button>บันทึก</button>

    </form>
    
</body>
</html>