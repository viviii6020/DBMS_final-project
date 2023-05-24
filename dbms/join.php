<?php
session_start();
$db = new PDO("mysql:dbname=dbms_project;host=localhost", "root", "");
$pId = $_POST['postId'];
$mId = $_SESSION['mId'];

$checkQuery = $db->prepare("SELECT * FROM `participate` WHERE mId = :mId");
$checkQuery->bindParam(':mId', $mId);
$checkQuery->execute();

$usernameExists = false;
foreach ($checkQuery as $row) {
    if ($pId == $row['pId']) {
        $usernameExists = true;
        break;
    }
}

if ($usernameExists) {
    $msg = "你已經參加過了";
} else {
    $addQuery = $db->prepare("INSERT INTO participate (pId, mId) VALUES (:pId, :mId)");
    $addQuery->bindParam(':pId', $pId);
    $addQuery->bindParam(':mId', $mId);
    $addQuery->execute();
    $msg = "成功報名";
}

echo "<script>";
echo "alert('$msg');";
echo "location.href='post.php';";
echo "</script>";
?>
