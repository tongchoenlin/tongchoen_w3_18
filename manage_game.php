<!DOCTYPE html>
<link rel="stylesheet" href="style.css">
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include 'action/connect.php';

$sql = "SELECT * FROM games";

$result = mysqli_query($con, $sql);
?>

<table border=1>
<thead>
<th>รหัสเกม</th>
<th>ชื่อเกม</th>
<th>ราคา</th>
<th>ภาพปก</th>
<th>ประเภท</th>
<th>จัดการ</th>
</thead>

<?php
foreach($result as $game){
?>
<tr>
<td> <?= $game["game_id"] ?> </td>
<td> <?= $game["game_name"] ?> </td>
<td> <?= $game["game_pice"] ?> </td>
<td>
<img
src="<?= $game["game_cover"] ?>"
style="width:200px"
>
</td>
<td> <?= $game["typr_id"] ?> </td>
<td>
    <!--แก้ไข-->
    <a href="edit_game.php?id=<?=$game['game_id']?>">แก้ไข</a>
    <!--ลบ-->
    <a href="action/delete_game.php?id=<?= $game['game_id']?>">ลบ</a>
</td>
</tr>
<?php
}
?>

</table>

</body>
</html>
