<?php
    $db = new PDO("mysql:dbname=dbms_project;host=localhost", "root", "");
    $pId = $_POST['postId'];
    $dele = "DELETE FROM `addpost` WHERE `pId`=:pId";
    $statement = $db->prepare($dele);
    $statement->execute([':pId' => $pId]);
    echo "<script>";
    echo "alert('Delete success!');";
    echo "location.href='index.php';";
    echo "</script>";
    exit();
?>