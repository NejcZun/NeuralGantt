<?php
$host = "localhost";
$port = 3306;
$username = "root";
$password = "";
$database = "gantt";

$db = new PDO("mysql:host=$host;port=$port",
               $username,
               $password);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("use `$database`");

function db_get_users(){
    global $db;

    $str = "SELECT * FROM user";
    $stmt = $db->prepare($str);
    $stmt->execute();
    return $stmt->fetch();
}

function db_user_exists($user){
    global $db;

    $query = "SELECT EXISTS(SELECT id from user WHERE uname = :uname) AS checkUser";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result['checkUser'] == 1) return true;
    return false;
}
function db_user_exists_byId($id){
    global $db;

    $query = "SELECT EXISTS(SELECT id from user WHERE id = :id) AS checkUser";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result['checkUser'] == 1) return true;
    return false;
}

function db_get_userSalt($user){
    global $db;

    $query = "SELECT salt FROM user WHERE uname = :uname";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['salt'];
}
function db_get_firstName($user){
    global $db;

    $query = "SELECT fname FROM user WHERE uname = :uname";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['fname'];
}
function db_get_lastName($user){
    global $db;

    $query = "SELECT lname FROM user WHERE uname = :uname";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['lname'];
}
function db_get_userId($user){
    global $db;

    $query = "SELECT id FROM user WHERE uname = :uname";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['id'];
}
function db_get_userRoleName($user){
    global $db;

    $query = "SELECT r.rolename FROM role r join user u on u.role_id = r.role_id WHERE uname = :uname";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['rolename'];
}
function db_get_userUsername($id){
    global $db;

    $query = "SELECT uname FROM user WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['uname'];
}

function db_user_login($user, $pass){
    global $db;

    $salt = db_get_userSalt($user);
    $pass = hash_pbkdf2('sha3-256', $pass, $salt, 3);
    $query = "SELECT EXISTS(SELECT id from user WHERE uname = :uname AND password = :pw) AS checkLogin";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":uname", $user);
    $stmt->bindParam(":pw", $pass);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result['checkLogin'] == 1) return true;
    return false;
}
function cookie_get_username(){
	return base64_decode($_COOKIE['user']);
}

function db_check_uname_exists($user){
    global $db;
    
    $query = "SELECT COUNT(*) AS countUsers FROM user WHERE uname = :user";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":user", $user);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['countUsers'];
}
?>
