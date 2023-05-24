<?php
session_start();

$mId = $_SESSION['mId'];
$project = $_POST["project"];
$cost = $_POST["cost"];
$groupsize = $_POST["groupsize"];
$platform = $_POST["platform"];
$payment = $_POST["payment"];
$about = $_POST["about"];
$sdate = $_POST["start-time"];
$edate = $_POST["end-time"];

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

$db = new PDO("mysql:dbname=dbms_project;host=localhost", "root", "");

$add = "INSERT INTO addpost (project,cost,groupsize,platform,payment,about,sdate,edate,picture,creater_mId) 
        VALUES('$project', $cost, $groupsize, '$platform', '$new1', '$about', '$sdate', '$edate', '$picture',$mId)";

$db->exec($add);

?>
<script>
    alert("Upload success!");
    location.href='javascript:history.go(-2)';
</script>
