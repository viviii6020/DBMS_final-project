<?php
session_start();

$sender = $_SESSION["dbms_project"];
$receiver = $_POST["receiver"];
$subject = $_POST["message-title"];
$content = $_POST["message-text"];


$db = new PDO("mysql:dbname=dbms_project;host=localhost", "root", "");

if($_SESSION["dbms_project"]!=$receiver){
        $sql = "SELECT * FROM member WHERE username = '$receiver'";
        $result = $db->query($sql);

        $rows = $result->fetchAll();
        if (count($rows) > 0) {
                $add = "INSERT INTO chat (send_username,rece_username,title,content) 
                VALUES('$sender', '$receiver', '$subject','$content')";
                $db->exec($add);
                $msg="Sending success!";
        }else{
                $msg = "Receiver not exist";
        }
}else{
        $msg = "你無法寄信給自己";
}

?>
<script>
alert("<?php echo $msg; ?>");
location.href='javascript:history.go(-2)';
</script>