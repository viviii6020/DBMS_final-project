<?php
session_start();
$db = new PDO("mysql:dbname=dbms_project;host=localhost", "root", "");
$pId = $_POST['postId'];
$mId = $_SESSION['mId'];
$resultAcc = $db->query("SELECT * FROM `favorite` WHERE mId = $mId");
$usernameExists = false;

        foreach($resultAcc as $row){
        if($pId==$row['pId']){
            $usernameExists = true;
             break;
        }            
        }
        if($usernameExists){
            $msg = "取消收藏";
            $dele = "DELETE FROM `favorite` WHERE `pId`=:pId ";
            $statement = $db->prepare($dele);
            $statement->execute([':pId' => $pId]);
        }else{
            $add = "INSERT INTO favorite (pId,mId) VALUES($pId,$mId)";
            $db->exec($add);
            $msg = "成功收藏";
        }
echo "<script>";
echo "alert('$msg');";
echo "location.href='post.php';";
echo "</script>";
?>