<?php
    include "db_mysql.php";
    $user = $_POST['username'];
    $result = db_check_uname_exists($user);
    echo $result;
?>