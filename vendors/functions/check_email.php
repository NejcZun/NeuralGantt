<?php
    include "db_mysql.php";
    $email = $_POST['email'];
    $result = db_check_email_exists($email);
    echo $result;
?>