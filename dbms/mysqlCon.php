<?php

$db = new PDO("mysql:dbname=dbms_project;host=localhost", "root", "");

    if(!$db){
        printf("connect db failed");
        exit();
    }

?>