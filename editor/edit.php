<?php
require_once '_db_mysql.php';

$stmt = $db->prepare('SELECT * FROM task where id = :id');
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

$data = $stmt->fetch();

if (!$data) {
    die("Not found");
}

$stmt = $db->prepare('SELECT count(*) FROM task where parent_id = :id');
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$isparent = $stmt->fetchColumn(0);

?>
﻿<!DOCTYPE html>
<html>
<head>
    <title></title>
    
    <!-- demo stylesheet -->
    <link type="text/css" rel="stylesheet" href="media/layout.css" />    

    <!-- helper libraries -->
    <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>

    <!-- daypilot libraries -->
    <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
	
</head>
<body style="margin:20px">
    
<form action="backend_task_update.php" id="f" method="post">

<div class="space">
    <div>Name:</div>
    <div>
        <input id="name" name="name" value="<?php echo htmlspecialchars($data["name"]) ?>"/>
    </div>
</div>
    
<div class="section-milestone">
    <div class="space" class="">
        <div>Milestone:</div>
        <div>
            <input id="milestone" name="milestone" type="checkbox" <?php if ($data["milestone"]) { echo 'checked'; } ?> />
            <label for="milestone">Milestone</label>
        </div>    
    </div>
</div>

<div class="space">
    <div>Start:</div>
    <div>
        <input id="start" name="start"/> <a href="#" onclick="startPicker.show(); return false;">Change</a>
    </div>
</div>
    
<div class="section-taskonly">

    <div class="space">
        <div>End:</div>
        <div>
            <input id="end" name="end"/> <a href="#" onclick="endPicker.show(); return false;">Change</a>
        </div>
    </div>

    <div class="space">
        <div>Complete:</div>
        <div>
            <select id="complete" name="complete">
                <?php 
                for($i = 0; $i <= 100; $i+=10) {
                    $selected = "";
                    if ($data["complete"] == $i) {
                        $selected = " selected";
                    }
                    echo "<option value='".$i."'".$selected.">".$i."%</option>";
                }
            ?>
            </select>
        </div>
    </div>
</div>

<div class="space">
    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>"/>
    <input type="submit" value="OK" />
    <a href="#" id="cancel">Cancel</a>
</div>
    
</form>
    
<script>
    $(document).ready(function() {        
        $("#cancel").click(function() {
            parent.DayPilot.ModalStatic.close();
            return false;
        });
        
        $("#milestone").change(function() {
            var checked = $(this).is(":checked");
            if (checked) {
                $(".section-taskonly").hide();
            }
            else {
                $(".section-taskonly").show();
                parent.DayPilot.ModalStatic.stretch();
            }
        });
        
        $("#f").submit(function(ev) {
            var f = $("#f");
            var action = this.getAttribute("action");
            $("#start").val(startPicker.date.toString("yyyy-MM-dd"));
            $("#end").val(endPicker.date.toString("yyyy-MM-dd"));
            $.post(action, f.serialize(),
            function(result) {
                parent.DayPilot.ModalStatic.close(eval(result));
            });
            return false;
        });
        
        $("#name").focus();
        $("#milestone").change();
        
        var isparent = <?php echo $isparent ?>;
        if (isparent) { 
            $(".section-milestone").hide();
        }
        
    });
    
    var startPicker =  new DayPilot.DatePicker({
        target: 'start', 
        pattern: 'M/d/yyyy',
        date: "<?php echo $data['start'] ?>",
        onShow: function() {
            parent.DayPilot.ModalStatic.stretch();
        }
    });
    
    var endPicker =  new DayPilot.DatePicker({
        target: 'end', 
        pattern: 'M/d/yyyy',
        date: "<?php echo $data['end'] ?>",
        onShow: function() {
            parent.DayPilot.ModalStatic.stretch();
        }
    });
</script>
</body>
</html>

