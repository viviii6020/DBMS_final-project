<?php
session_start();
include('mysqlCon.php');

$username = $_POST["username"];
$password = $_POST["password"];
$method = $_POST["method"];

$resultAcc = $db->query("SELECT * FROM `member` WHERE `username` = '$username'");
$num = $resultAcc->rowCount();
if($method==1){

    if($num){
    
        foreach($resultAcc as $row){
            if($password==$row['password']){
                $url = 'index.php';
                $msg = "登入成功";
                $_SESSION['dbms_project'] = $username;
                $mId = $row['mId'];
                $_SESSION['mId'] = $mId;
                $add = "INSERT INTO logg (mId) VALUES ($mId)";
                $db->exec($add);
                if (!isset($_SESSION['mId'])) {
                    echo "You need to login first!";
                    exit();
                }

            }
            else{
                $url = 'login.php';
                $msg = "密碼錯誤";
            }
        } 
    }
    else{
        $url = 'login.php';
        $msg = "帳號不存在";
    }
}
else{
    if($num){
        $url = 'register.php';
        $msg = "此帳號已被註冊";
    }
    else{
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $gender1 = $_POST["gender"];
        $gender = implode(".", $gender1);
        $addmem ="INSERT INTO `member`(`username`,`email`,`password`,`phone`,`gender`)VALUES('$username','$email','$password','$phone','$gender')";
        $db->exec($addmem);

        $url = 'login.php';
        $msg = "註冊完成，請重新登入";
    }




}
echo "<script>";
echo "alert('$msg');";
echo "location.href='$url';";
echo "</script>";
?>