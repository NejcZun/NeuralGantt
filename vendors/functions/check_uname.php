<?php
    $user = $_POST['username'];
    echo $user;
    $result = db_check_uname_exists($user);
    echo $result;
?>