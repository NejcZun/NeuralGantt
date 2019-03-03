<?php
require_once 'db_mysql.php';

function parent_display_project(){
	if(isset($_GET['project'])){
		display_gantt();
	}else{
		display_user_projects(); 
	}
	
}




function get_user_id_project(){
	return base64_decode($_COOKIE['user']);
}
function add_project($project_name, $project_end){
	global $db;
	$project_start = (new DateTime("now"))->format('Y-m-d H:i:s');
	$project_end = $project_end. ' 00:00:00';
	$user_id = db_get_userId(get_user_id_project());
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
				  <td data-title="Manager" style="vertical-align:middle;">'.db_get_userUsername($row['project_id']).'</td>
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
                        dp.message("Updated");
                    });
                };

                dp.onTaskResize = function(args) {
                    $.post("backend_move.php", {
                        id: args.task.id(),
                        start: args.newStart.toString(),
                        end: args.newEnd.toString()
                    },
                    function(data) {
                        dp.message("Updated");
                    });
                };


                dp.onRowMove = function(args) {
                    $.post("backend_row_move.php", {
                        source: args.source.id,
                        target: args.target.id,
                        position: args.position
                    },
                    function(data) {
                        dp.message("Updated");
                    });
                };

                dp.onLinkCreate = function(args) {
                    $.post("backend_link_create.php", {
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
                    $.post("backend_tasks.php", function(data) {
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



?>