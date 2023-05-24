<?php
    $db = new PDO("mysql:dbname=dbms_project;host=localhost", "root", "");
    $pId = $_POST['postId'];
    $mId = $_POST['postmId'];
    $dele = "DELETE FROM `participate` WHERE `pId`=:pId AND `mId`=:mId";
    $statement = $db->prepare($dele);
    $statement->execute([':pId' => $pId,
                         ':mId' => $mId]);
    echo "<script>";
    echo "alert('Delete success!');";
    echo "location.href='memberpost.php';";
    echo "</script>";
    exit();
?>