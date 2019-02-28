<?php
require_once '_db_mysql.php';

$max = 100000;

$source = db_get_task($_POST["source"]);
$target = db_get_task($_POST["target"]);

$source_parent_id = $source ? $source["parent_id"] : null;
$target_parent_id = $target ? $target["parent_id"] : null;

$target_ordinal = $target["ordinal"];

switch ($_POST["position"]) {
    case "before":
        db_update_task_parent($source["id"], $target_parent_id, $target_ordinal);
        break;
    case "after":
        db_update_task_parent($source["id"], $target_parent_id, $target_ordinal + 1);
        break;
    case "child":
        echo "child:source/".$source["id"]."/target/".$target["id"];
        db_update_task_parent($source["id"], $target["id"], $max);
        $target_parent_id = $target["id"];
        break;
    case "forbidden":
        break;
}

db_compact_ordinals($source_parent_id);

if ($source_parent_id != $target_parent_id) {
    db_compact_ordinals($target_parent_id);
}

class Result {}

$response = new Result();
$response->result = 'OK';

header('Content-Type: application/json');
echo json_encode($response);

?>
