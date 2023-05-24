<?php
session_start();
$db = new PDO("mysql:dbname=dbms_project;host=localhost", "root", "");
$pId = $_POST['postId'];
$project = $_POST["project"];
$cost = $_POST["cost"];
$groupsize = $_POST["groupsize"];
$platform = $_POST["platform"];
$payment = $_POST["payment"];
$about = $_POST["about"];
$sdate = $_POST["start-time"];
$edate = $_POST["end-time"];
$mId = $_SESSION['mId'];
$new1 = implode(".", $payment);

if($_FILES["avatar"]["error"] > 0){
    echo "Error:" .$_FILES["avatar"]["error"];
}else{
    if(file_exists("pic/".$_FILES["avatar"]["name"])){
        $target_path="pic/";
       $target_path .= $_FILES["avatar"]["name"];
    }else{
       $target_path="pic/";
       $target_path .= $_FILES["avatar"]["name"];
    }
    if(move_uploaded_file($_FILES["avatar"]["tmp_name"],iconv("UTF-8","big5",$target_path))){
        $picture = $target_path;
    }else{
        echo"檔案上傳失敗，請再試一次!";
    }
}

$sql = "UPDATE `addpost` SET `project` = :project, `cost` = :cost, `groupsize` = :groupsize, `platform` = :platform, `payment` = :payment, `about` = :about, `sdate` = :sdate, `edate` = :edate, `picture` = :picture, `creater_mId` = :creater_mId WHERE `pId` = :pId";
$stmt = $db->prepare($sql);
$stmt->execute([
    ':project' => $project,
    ':cost' => $cost,
    ':groupsize' => $groupsize,
    ':platform' => $platform,
    ':payment' => $new1,
    ':about' => $about,
    ':sdate' => $sdate,
    ':edate' => $edate,
    ':picture' => $picture,
    ':creater_mId' => $mId,
    ':pId' => $pId
]);


if ($stmt->rowCount() > 0) {
    echo "<script>";
    echo "alert('Update success!');";
    echo "location.href='memberpost.php';";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Update failure!');";
    echo "location.href='memberpost.php';";
    echo "</script>";
}
?>