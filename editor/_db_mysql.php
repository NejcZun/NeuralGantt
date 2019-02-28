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

$db->exec("CREATE DATABASE IF NOT EXISTS `$database`");
$db->exec("use `$database`");

function tableExists($dbh, $id)
{
    $results = $dbh->query("SHOW TABLES LIKE '$id'");
    if(!$results) {
        return false;
    }
    if($results->rowCount() > 0) {
        return true;
    }
    return false;
}

$exists = tableExists($db, "task");

if (!$exists) {
    //create the database
    $db->exec("CREATE TABLE task (
    id               INTEGER  PRIMARY KEY  AUTO_INCREMENT,
    name             TEXT,
    start            DATETIME,
    end            DATETIME,
    parent_id        INTEGER,
    milestone        BOOLEAN  DEFAULT '0' NOT NULL,
    ordinal          INTEGER,
    ordinal_priority DATETIME,
    complete         INTEGER  DEFAULT '0' NOT NULL
    );");

    $db->exec("CREATE TABLE link (
    id      INTEGER       PRIMARY KEY AUTO_INCREMENT,
    from_id INTEGER       NOT NULL,
    to_id   INTEGER       NOT NULL,
    type    VARCHAR (100) NOT NULL
    );");

    $messages = array(
                    array('name' => 'Task 1',
                        'start' => '2017-01-05T00:00:00',
                        'end' => '2017-01-10T10:00:00')
                );

    $insert = "INSERT INTO task (name, start, end) VALUES (:name, :start, :end)";
    $stmt = $db->prepare($insert);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':start', $start);
    $stmt->bindParam(':end', $end);

    foreach ($messages as $m) {
      $name = $m['name'];
      $start = $m['start'];
      $end = $m['end'];
      $stmt->execute();
    }
}

date_default_timezone_set("UTC");

function db_get_max_ordinal($parent) {
    global $db;
    $str = "SELECT max(ordinal) FROM task WHERE parent_id = :parent";
    if ($parent == null) {
        $str = str_replace("= :parent", "is null", $str);
        $stmt = $db->prepare($str);
    }
    else {
        $stmt = $db->prepare($str);
        $stmt->bindParam(":parent", $parent);
    }
    $stmt->execute();
    return $stmt->fetchColumn(0) ?: 0;
}

function db_get_task($id) {
    global $db;

    $str = "SELECT * FROM task WHERE id = :id";
    $stmt = $db->prepare($str);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->fetch();
}

function db_update_task_parent($id, $parent, $ordinal) {
    global $db;

    $now = (new DateTime("now"))->format('Y-m-d H:i:s');

    $str = "UPDATE task SET parent_id = :parent, ordinal = :ordinal, ordinal_priority = :priority WHERE id = :id";
    $stmt = $db->prepare($str);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":parent", $parent);
    $stmt->bindParam(":ordinal", $ordinal);
    $stmt->bindParam(":priority", $now);
    $stmt->execute();
}

function db_compact_ordinals($parent) {
    $children = db_get_tasks($parent);
    $size = count($children);
    for ($i = 0; $i < $size; $i++) {
        $row = $children[$i];
        db_update_task_ordinal($row["id"], $i);
    }
}

function db_update_task_ordinal($id, $ordinal) {
    global $db;

    $now = (new DateTime("now"))->format('Y-m-d H:i:s');

    $str = "UPDATE task SET ordinal = :ordinal, ordinal_priority = :priority WHERE id = :id";
    $stmt = $db->prepare($str);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":ordinal", $ordinal);
    $stmt->bindParam(":priority", $now);
    $stmt->execute();
}

function db_update_task($id, $start, $end) {
    global $db;

    $str = "UPDATE task SET start = :start, end = :end WHERE id = :id";
    $stmt = $db->prepare($str);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":start", $start);
    $stmt->bindParam(":end", $end);
    $stmt->execute();
}

function db_update_task_full($id, $start, $end, $name, $complete, $milestone) {
    global $db;

    $str = "UPDATE task SET start = :start, end = :end, name = :name, complete = :complete, milestone = :milestone WHERE id = :id";
    $stmt = $db->prepare($str);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":start", $start);
    $stmt->bindParam(":end", $end);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":complete", $complete);
    $stmt->bindParam(":milestone", $milestone);
    $stmt->execute();
}

function db_get_tasks($parent) {
    global $db;

    $str = 'SELECT * FROM task WHERE parent_id = :parent ORDER BY ordinal, ordinal_priority desc';
    if ($parent == null) {
        $str = str_replace("= :parent", "is null", $str);
        $stmt = $db->prepare($str);
    }
    else {
        $stmt = $db->prepare($str);
        $stmt->bindParam(':parent', $parent);
    }

    $stmt->execute();
    return $stmt->fetchAll();
}

?>
