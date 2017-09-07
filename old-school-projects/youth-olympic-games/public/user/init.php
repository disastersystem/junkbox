<?php
    //error_reporting(0);

    $DB_host = "127.0.0.1";
    $DB_user = "root";
    $DB_pass = "";
    $DB_name = "susannlundekvam2";

    /*$DB_host = "susannlundekvam2.mysql.domeneshop.no";
    $DB_user = "susannlundekvam2";
    $DB_pass = "7zBiYeBmXXdLXEi";
    $DB_name = "susannlundekvam2";*/

    try {
         $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
         $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $e) {
         echo $e->getMessage();
         //echo "You're the exception, you're special.";
    }
?>
