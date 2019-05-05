<?php
require_once 'db_mysql.php';

function parent_display_project(){
	
	/*processing pre-defined actions */
	if(isset($_POST['delete'])){
		if(verify_user_profile($_POST['delete'])){
			delete_project($_POST['delete']);
		}
	}
	if(isset($_GET['project'])){
		display_gantt();
	}else if(isset($_GET['edit'])){
		if(!verify_user_profile($_GET['edit'])){ /* if user doesnt own the project and not admin */
			echo '<script>window.location.replace("index.php");</script>';
		}else{
			display_edit_project($_GET['edit']);
		}
		
	}else if(isset($_GET['delete'])){
		if(!verify_user_profile($_GET['delete'])){ /* if user doesnt own the project and not admin */
			echo '<script>window.location.replace("index.php");</script>';
		}else{
			display_project_delete_page();
		}
		
	}else{
		display_user_projects(); 
	}
	
}
function display_edit_project($id){
	if(isset($_POST['project_name'])){
		update_project_name($id, $_POST['project_name']);
	}
	echo '<div class="col-md-6 d-flex align-items-stretch grid-margin" style="margin:auto; margin-bottom: 40px;">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
					  <h3 class="card-title" style="font-size:24px;">Change name:</h3>
						<form method="POST" action="./index.php?edit='.$id.'">
                        <div class="form-group">
                          <label for="project_name">Project name</label>
                          <input name="project_name" type="text" class="form-control" id="project_name" required="" value ='.get_project_name($id).'>
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Update</button>
                      </form>
                      <h3 class="card-title" style="font-size:24px; margin-top:30px;">Add users:</h3>
					   <label for="magic_cover_up" style="font-size: 13px;">Select names and add them to your project</label>
						<div class="adjust"></div>
							<section id="magic_cover_up">
								<input class="magicsearch" id="basic" placeholder="search names...">
							</section>
							<button type="button" class="btn btn-success mr-2" style="min-width:100px; margin-top:40px;" onClick="addUsers()">Add</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
	echo "<script>
        $(function() {
            var dataSource = [
                ".get_data_users($id)."
            ];
            $('#basic').magicsearch({
                dataSource: dataSource,
                fields: ['firstName', 'lastName'],
                id: 'id',
                format: '%firstName% %lastName%',
                multiple: true,
                multiField: 'lastName',
                multiStyle: {
                    space: 5,
                    width: 80
                }
            });
            $('#set-btn').click(function() {
                $('#basic').trigger('set', { id: '3,4' });
            });
        });
    </script>";
	
	echo "<script>
	function addUsers(){
		var elements = document.getElementsByClassName('multi-items');
		for(let i=0; i < elements[0].children.length; i++){
			let element = elements[0].children[i];
			$.ajax({
				type: 'POST',
				url: 'add_OnBoard.php',
				data: { project_id: ".$_GET['edit'].", user_id: element.dataset.id },
				success: function(response) {
					$('#result').html(response);
				}
			});
		}
	}
	</script>";
	
}
function update_project_name($id, $name){
	global $db;
	$str = "update project set project_name = '{$name}' where project_id = {$id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
}
function get_project_name($id){
	global $db;
	$str = "SELECT * from project where project_id  = ". $id;
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
		
	}else{
		while ($row = $stmt->fetch()) {
			return $row['project_name'];
		}
	}
}


function get_data_users($id){
	global $db;
	$str = "SELECT * from user where id not in (select user_id from on_board where project_id = ". $id . ")";
    $stmt = $db->prepare($str);
    $stmt->execute();
	$result="";
	if($stmt->rowCount() === 0){
		
	}else{
		while ($row = $stmt->fetch()) {
			$result=$result."{id: ".$row['id'].", firstName: '".$row['fname']."', lastName: '".$row['lname']."'},";
		}
	}
	return $result;
}
function delete_project($id){
	global $db;
	/*deletes from links */
	$stmt = $db->prepare("DELETE FROM link WHERE project_id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	
	/* deletes from tasks */
	
	$stmt = $db->prepare("DELETE FROM task WHERE project_id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	
	/*deletes from on_board */
	
	$stmt = $db->prepare("DELETE FROM on_board WHERE project_id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	
	
	/*deletes all projects */
	
	$stmt = $db->prepare("DELETE FROM project WHERE project_id = :id");
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	
	
}




/* checks if user is manager -> if he is a manager checks if he owns the project or if user is admin than it's oke*/
function verify_user_profile($project_id){
	$user_id = db_get_userId(get_user_cookie_project());
	if(check_if_user_owner($user_id, $project_id) or check_if_user_admin()){
		return true;
	}else{
		return false;
	}
}
function check_if_user_owner($user_id, $project_id){
	global $db;
    $query = "SELECT EXISTS(SELECT * from project WHERE project_id = {$project_id} AND user_id={$user_id}) AS checkExists";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result['checkExists'] == 1) return true;
    return false;
}

function get_user_cookie_project(){
	return base64_decode($_COOKIE['user']);
}


/* project db */
function add_project($project_name, $project_end){
	global $db;
	$project_start = (new DateTime("now"))->format('Y-m-d H:i:s');
	$project_end = $project_end. ' 00:00:00';
	$user_id = db_get_userId(get_user_cookie_project());
	$projects = array(array('user_id' => $user_id,
                        'project_name' => $project_name,
						'start' =>$project_start,
						'end' => $project_end)
                );

    $insert = "INSERT INTO project(user_id, project_name, start, end) VALUES (:user_id, :project_name, :project_start, :project_end)";
    $stmt = $db->prepare($insert);

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':project_name', $project_name);
	$stmt->bindParam(':project_start', $project_start);
	$stmt->bindParam(':project_end', $project_end);
    foreach ($projects as $m) {
      $user_id = $m['user_id'];
      $project_name = $m['project_name'];
	  $project_start = $m['start'];
	  $project_end = $m['end'];
      $stmt->execute();
    }
	
	/*zdej ga more pa se dodt notr v on_board */
	
	$project_id=get_project_id_onCreate($project_start);
	insert_user_into_project($user_id, $project_id);
	
	/*message where to view your messages*/
	project_created_message();
}
function get_project_id_onCreate($date){
	global $db;
	$query = "SELECT project_id FROM project WHERE start = :date";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":date", $date);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['project_id'];
}

function insert_user_into_project($user_id, $project_id){
	global $db;
	$add_user = array(array('user_id' => $user_id, 'project_id' => $project_id));
	$insert = "INSERT INTO on_board(user_id, project_id) VALUES (:user_id, :project_id)";
	$stmt = $db->prepare($insert);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':project_id', $project_id);
	foreach ($add_user as $m) {
      $user_id = $m['user_id'];
	  $project_id = $m['project_id'];
	  $stmt->execute();
	}
	
}


function project_created_message(){
	echo '<div class="col-lg-12 mx-auto">
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="mdi mdi-close"></i>
					</button>
					<span><b> Project created - </b> View your projects <a href="index.php">here</a>.</span>
				</div>
		</div>';
}
/* PROJECT INDEX - DISPLAY USER PROJECTS: //not gonna work like this*/
function display_user_projects(){
    global $db;
	$user_id=db_get_userId(cookie_get_username());
	$str = "SELECT p.project_id, p.project_name, p.user_id FROM project p join on_board o on o.project_id = p.project_id where o.user_id={$user_id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
		has_no_projects();
	}else{
	/* build the table class below: */
		echo '<div class="table-responsive-vertical shadow-z-1">
			  <table id="table" class="table table-hover table-mc-light-blue">
				<thead>
					<tr>
						<th>Project name</th>
						<th>Open</th>
						<th>Manager</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			$progress=round(get_progress_bar($row['project_id'])*100);
			echo '<tr>
				  <td data-title="Name" style="vertical-align:middle;">'.$row['project_name'].'</td>
				  <td data-title="Open"><a href="index.php?project='.$row['project_id'].'"><button type="button" class="btn btn-primary btn-fw" style="min-width:100px; background-color:#5983e8"><i class="mdi mdi-folder-open"></i>Open</button></a></td>
				  <td data-title="Manager" style="vertical-align:middle;">'.db_get_userUsername($row['user_id']).'</td>
				  <td data-title="Status" style="vertical-align:middle;">
					<div class="progress md-progress" style="height: 20px"><div class="progress-bar" role="progressbar" style="width: '.$progress.'%; height: 20px; background-color:#00ce68 ;" aria-valuenow="'.$progress.'" aria-valuemin="0" aria-valuemax="100">'.$progress.'%</div></div>
				  </td>
				  <td data-title="Action">';
				  if(check_if_user_admin_or_mod()){
					  echo '<a href="index.php?edit='.$row['project_id'].'" style="text-decoration:none;"><button type="button" class="btn btn-secondary btn-fw" style="min-width:100px;"><i class="mdi mdi-pencil"></i>Edit</button>
							<a href="index.php?delete='.$row['project_id'].'" style="text-decoration:none;"><button type="button" class="btn btn-danger btn-fw" style="min-width:100px;"><i class="mdi mdi-delete"></i>Delete</button>';
				  }else{
					  echo '<a href="index.php?edit='.$row['project_id'].'" style="text-decoration:none;"><button type="button" class="btn btn-secondary btn-fw" style="min-width:100px;" disabled><i class="mdi mdi-pencil"></i>Edit</button>
							<a href="index.php?delete='.$row['project_id'].'" style="text-decoration:none;"><button type="button" class="btn btn-danger btn-fw" style="min-width:100px;" disabled><i class="mdi mdi-delete"></i>Delete</button>';
				  }
				  echo '
				  </td>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
}
function display_user_projects_admin(){
    global $db;
	$str = "SELECT DISTINCT p.project_id, p.project_name, p.user_id FROM project p join on_board o on o.project_id = p.project_id";
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
		has_no_projects();
	}else{
	/* build the table class below: */
		echo '<div class="table-responsive-vertical shadow-z-1">
			  <table id="table" class="table table-hover table-mc-light-blue">
				<thead>
					<tr>
						<th>Project name</th>
						<th>Open</th>
						<th>Manager</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			$progress=round(get_progress_bar($row['project_id'])*100);
			echo '<tr>
				  <td data-title="Name" style="vertical-align:middle;">'.$row['project_name'].'</td>
				  <td data-title="Open"><a href="../project/index.php?project='.$row['project_id'].'"><button type="button" class="btn btn-primary btn-fw" style="min-width:100px; background-color:#5983e8"><i class="mdi mdi-folder-open"></i>Open</button></a></td>
				  <td data-title="Manager" style="vertical-align:middle;">'.db_get_userUsername($row['project_id']).'</td>
				  <td data-title="Status" style="vertical-align:middle;">
					<div class="progress md-progress" style="height: 20px"><div class="progress-bar" role="progressbar" style="width: '.$progress.'%; height: 20px; background-color:#00ce68 ;" aria-valuenow="'.$progress.'" aria-valuemin="0" aria-valuemax="100">'.$progress.'%</div></div>
				  </td>
				  <td data-title="Action">
					<a href="../project/index.php?edit='.$row['project_id'].'" style="text-decoration:none;"><button type="button" class="btn btn-secondary btn-fw" style="min-width:100px;"><i class="mdi mdi-pencil"></i>Edit</button>
					<a href="../project/index.php?delete='.$row['project_id'].'" style="text-decoration:none;"><button type="button" class="btn btn-danger btn-fw" style="min-width:100px;"><i class="mdi mdi-delete"></i>Delete</button>
				  </td>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
}
function get_progress_bar($id){
	global $db;
	$query = "SELECT (select sum(complete) from task where project_id = {$id} group by project_id) / (count(*)*100) as progress from task where project_id = {$id} group by project_id";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['progress'];
	
}
function has_no_projects(){
	echo '<div class="col-md-6 d-flex align-items-stretch grid-margin" style="margin:auto;">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title" style="font-size:24px;text-align:center;">You have no active projects</h3>
                   </div>
                 </div>
               </div>
            </div>
         </div>';
}

/* GANTT: */
function display_gantt(){
echo '<div class="hideSkipLink">
        </div>
        <div class="main">
            <div class="space"></div>
            <div id="dp"></div>
			<script type="text/javascript">
                var dp = new DayPilot.Gantt("dp");
                dp.startDate = new DayPilot.Date("2019-03-01");
                dp.days = 93;

                dp.linkBottomMargin = 5;

                dp.rowCreateHandling = "Enabled";

                dp.columns = [
                    { title: "Name", property: "text", width: 100},
                    { title: "Duration", width: 100}
                ];

                dp.onBeforeRowHeaderRender = function(args) {
                    args.row.columns[1].html = new DayPilot.Duration(args.task.end().getTime() - args.task.start().getTime()).toString("d") + " days";
                    args.row.areas = [
                        {
                            right: 3,
                            top: 3,
                            width: 16,
                            height: 16,
                            style: "cursor: pointer; box-sizing: border-box; background: white; border: 1px solid #ccc; background-repeat: no-repeat; background-position: center center; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAABASURBVChTYxg4wAjE0kC8AoiFQAJYwFcgjocwGRiMgPgdEP9HwyBFDkCMAtAVY1UEAzDFeBXBAEgxQUWUAgYGAEurD5Y3/iOAAAAAAElFTkSuQmCC);",
                            action: "ContextMenu",
                            menu: taskMenu,
                            v: "Hover"
                        }
                    ];
                };

                dp.contextMenuLink = new DayPilot.Menu([
                    {
                        text: "Delete",
                        onclick: function() {
                            var link = this.source;
                            $.post("backend_link_delete.php", {
                                id: link.id()
                            },
                            function(data) {
                                loadLinks();
                            });
                        }
                    }
                ]);

                dp.onRowCreate = function(args) {
                    $.post("backend_create.php?id='.$_GET['project'].'", {
                        name: args.text,
                        start: dp.startDate.toString(),
                        end: dp.startDate.addDays(1).toString()
                    },
                    function(data) {
                        loadTasks();
                    });
                };

                dp.onTaskMove = function(args) {
                    $.post("backend_move.php", {
                        id: args.task.id(),
                        start: args.newStart.toString(),
                        end: args.newEnd.toString()
                    },
                    function(data) {
                    });
                };

                dp.onTaskResize = function(args) {
                    $.post("backend_move.php", {
                        id: args.task.id(),
                        start: args.newStart.toString(),
                        end: args.newEnd.toString()
                    },
                    function(data) {
                    });
                };


                dp.onRowMove = function(args) {
                    $.post("backend_row_move.php", {
                        source: args.source.id,
                        target: args.target.id,
                        position: args.position
                    },
                    function(data) {
                    });
                };

                dp.onLinkCreate = function(args) {
                    $.post("backend_link_create.php?id='.$_GET['project'].'", {
                        from: args.from,
                        to: args.to,
                        type: args.type
                    },
                    function(data) {
                        loadLinks();
                    });
                };

                dp.onTaskClick = function(args) {
                    var modal = new DayPilot.Modal();
                    modal.closed = function() {
                        loadTasks();
                    };
                    modal.showUrl("edit.php?id=" + args.task.id());
                };

                dp.init();

                loadTasks();
                loadLinks();

                function loadTasks() {
                    $.post("backend_tasks.php?id='.$_GET['project'].'", function(data) {
                        dp.tasks.list = data;
                        dp.update();
                    });
                }

                function loadLinks() {
                    $.post("backend_links.php", function(data) {
                        dp.links.list = data;
                        dp.update();
                    });
                }

                var taskMenu = new DayPilot.Menu({
                    items: [
                        {
                            text: "Delete",
                            onclick: function() {
                                var task = this.source;
                                $.post("backend_task_delete.php", {
                                    id: task.id()
                                },
                                function(data) {
                                    loadTasks();
                                });
                            }
                        }
                    ]
                });

            </script>
        </div>';
	
	
}
function display_project_delete_page(){
	display_delete_card();
	get_project_by_id($_GET['delete']);
	
}
function get_project_by_id($id){
    global $db;
	$str = "SELECT DISTINCT p.project_id, p.project_name, p.user_id FROM project p join on_board o on o.project_id = p.project_id where p.project_id = {$id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
	if($stmt->rowCount() === 0){
		invalid_id();
	}else{
	/* build the table class below: */
		echo '<div class="table-responsive-vertical shadow-z-1">
			  <table id="table" class="table table-hover table-mc-light-blue">
				<thead>
					<tr>
						<th>Project name</th>
						<th>Open</th>
						<th>Manager</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			$progress=round(get_progress_bar($row['project_id'])*100);
			echo '<tr>
				  <td data-title="Name" style="vertical-align:middle;">'.$row['project_name'].'</td>
				  <td data-title="Open"><a href="index.php?project='.$row['project_id'].'"><button type="button" class="btn btn-primary btn-fw" style="min-width:100px; background-color:#5983e8"><i class="mdi mdi-folder-open"></i>Open</button></a></td>
				  <td data-title="Manager" style="vertical-align:middle;">'.db_get_userUsername($row['project_id']).'</td>
				  <td data-title="Status" style="vertical-align:middle;">
					<div class="progress md-progress" style="height: 20px"><div class="progress-bar" role="progressbar" style="width: '.$progress.'%; height: 20px; background-color:#00ce68 ;" aria-valuenow="'.$progress.'" aria-valuemin="0" aria-valuemax="100">'.$progress.'%</div></div>
				  </td>
				  <td data-title="Action">
				  <form method="POST" action="index.php">
					<button type="submit" name="delete" class="btn btn-danger btn-fw" style="min-width:100px;" value="'.$row['project_id'].'"><i class="mdi mdi-delete"></i>Yes</button>
					<a href="index.php" style="text-decoration:none;"><button type="button" class="btn btn-success btn-fw" style="min-width:100px;">No</button>
				  </form>
				  </td>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
}
function display_delete_card(){
	echo '<div class="col-md-6 d-flex align-items-stretch grid-margin" style="margin:auto; margin-bottom: 40px;">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title" style="font-size:24px;">Warning:</h3>
					  <p>By deleting this project you are also deleting all the links and tasks.</p>
					  <p>Are you sure you want to continue?</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
}
function invalid_id(){
	echo '<div class="col-md-6 d-flex align-items-stretch grid-margin" style="margin:auto; margin-bottom: 40px;">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="card-title" style="font-size:24px;">Error: Invalid ID</h3>
					  <p>Please check that you own the project or contact your administrator for support.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
}


?>