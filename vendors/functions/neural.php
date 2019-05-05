<?php
require_once 'db_mysql.php';

function display_neural_network($project){
        echo '<div class="col-md-12 d-flex align-items-stretch grid-margin" style="margin:auto; margin-bottom: 40px;">
        <div class="row flex-grow">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div id="mynetwork"></div>
                <script type="text/javascript">
                    let phpNodes ='. json_encode(db_get_neuralNodes($project)) .';
                    let phpEdges ='. json_encode(db_get_neuralEdges($project)) .';
                    var container = document.getElementById("mynetwork");

                    var data = {
                        nodes: phpNodes,
                        edges: phpEdges
                    };

                    var options = {
                        nodes: {
                            shape: "dot",
                            size: 20,
                            borderWidth: 2,
                            font: {
                                size: 14
                            }
                        },
                        edges: {
                            width: 2
                        },
                        groups: {
                            1: {color:{border: "#e00d12", background:"#fb7e81", highlight: {border: "#fd5a77", background: "#ffc0cb"}}, borderWidth:2},
                            2: {color:{border: "#6865fc", background:"#6e6efd", highlight: {border: "#2b7ce9", background: "#97c2fc"}}, borderWidth:2},
                            3: {color:{border: "#64cb2a", background:"#7be141", highlight: {border: "#4ad63a", background: "#c2fabc"}}, borderWidth:2}
                        }
                    }

                    // initialize your network!
                    var network = new vis.Network(container, data, options);
                </script>
              </div>
            </div>
          </div>
        </div>
      </div>';
    }

function display_user_neurals(){
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
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			echo '<tr>
				  <td data-title="Name" style="vertical-align:middle;">'.$row['project_name'].'</td>
				  <td data-title="Open"><a href="neural.php?project='.$row['project_id'].'"><button type="button" class="btn btn-primary btn-fw" style="min-width:100px; background-color:#5983e8"><i class="mdi mdi-folder-open"></i>Open</button></a></td>
				  <td data-title="Manager" style="vertical-align:middle;">'.db_get_userUsername($row['user_id']).'</td>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
}

function display_admin_neurals(){
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
					</tr>
				</thead>
				<tbody>';
		
		while ($row = $stmt->fetch()) {
			echo '<tr>
				  <td data-title="Name" style="vertical-align:middle;">'.$row['project_name'].'</td>
				  <td data-title="Open"><a href="../project/neural.php?project='.$row['project_id'].'"><button type="button" class="btn btn-primary btn-fw" style="min-width:100px; background-color:#5983e8"><i class="mdi mdi-folder-open"></i>Open</button></a></td>
				  <td data-title="Manager" style="vertical-align:middle;">'.db_get_userUsername($row['project_id']).'</td>
				</tr>';
		}
		  echo '</tbody>
			</table>
		</div>';
	}
}
?>