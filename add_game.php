<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="style.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="action/insert_game.php" method="post">

    <label for="">รหัสเกม</label>
    <input type="text" name="game_id"> <br>
        
    <label for="">ชื่อเกม</label>
    <input type="text" name="game_name"> <br>

    <label for="">ราคา</label>
    <input type="text" name="game_pice"> <br>

    <label for="">ลิงค์ภาพปก</label>
    <input type="text" name="game_cover"> <br>

    <?php
    include 'action/connect.php';

    $sql = "SELECT * FROM game_tyeps";

    $result = mysqli_query($con, $sql);
    ?>
    <label for="ประเภท"></label>
    <select name="typr_id" id="">
        <?php
            foreach($result as $type){
                ?>
                <option value=" <?= $type ["type_id"] ?> " > <?= $type ["type_name"] ?> </option>

                <?php
            }
?>   
                
               


    </select>

    <br>
    <button>บันทึก</button>

    </form>
    
</body>
</html>