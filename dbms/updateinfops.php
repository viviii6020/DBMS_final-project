<?php
session_start();
$db = new PDO("mysql:dbname=dbms_project;host=localhost", "root", "");

$mId = $_SESSION['mId'];
$phone = $_POST["phone"];
$email = $_POST["email"];
$gender1 = $_POST["gender"];
$gender = implode(".", $gender1);
$username = $_POST["username"]; // Added a semicolon at the end

$resultAcc = $db->query("SELECT * FROM `member` WHERE `mId` != '$mId'");
$usernameExists = false;

foreach($resultAcc as $row){
    if($username==$row['username']){
        $usernameExists = true;
        break;
    }
}
if($usernameExists){
    echo "<script>";
    echo "alert('Username has been used');";
    echo "location.href='memberinfo.php';";
    echo "</script>";
}
else{
$sql = "UPDATE `member` SET `username` = :username, `email` = :email, `phone` = :phone,  `gender` = :gender WHERE `mId` = :mId";
$stmt = $db->prepare($sql);
$stmt->execute([
    ':username' => $username,
    ':email' => $email,
    ':phone' => $phone,
    ':gender' => $gender,
    ':mId' => $mId
]);


if ($stmt->rowCount() > 0) {
    echo "<script>";
    echo "alert('Update success!');";
    echo "location.href='memberinfo.php';";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Update failure!');";
    echo "location.href='memberinfo.php';";
    echo "</script>";
}
    
}
?>
