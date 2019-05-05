<?php
include_once 'db_mysql.php';

function get_user_username(){
	return base64_decode($_COOKIE['user']);
}
function check_if_user_admin_or_mod(){
	if(db_get_userRoleName(get_user_username()) == 'admin' or db_get_userRoleName(get_user_username()) == 'manager')return true;
	else return false;
}
function check_if_user_admin(){
	if(db_get_userRoleName(get_user_username()) == 'admin')return true;
	else return false;
}
function check_if_user_mod(){
	if(db_get_userRoleName(get_user_username()) == 'manager')return true;
	else return false;
}
/* LEFT USER NAV */
function display_user_navigation_home(){
	echo '<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="media/pictures/user.png" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">'.db_get_firstName(get_user_username()). ' '. db_get_lastName(get_user_username()).'</p>
                  <div>
                    <small class="designation text-muted">'.db_get_userRoleName(get_user_username()).'</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>';
              if(check_if_user_admin_or_mod()){
				  echo '<a href="project/create.php" style="width:100%; text-decoration:none;"><button class="btn btn-success btn-block">New Project
                <i class="mdi mdi-plus"></i>
              </button></a>';
			  }
            echo '</div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-home" style="color:#979797"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="project/index.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-folder-open" style="color:#979797"></i>
              <span class="menu-title">My Projects</span>
            </a>
          </li>';
		 if(check_if_user_admin()){
			echo '<li class="nav-item">
            <a class="nav-link" href="admin/index.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-account-network" style="color:#e65251"></i>
              <span class="menu-title">Admin</span>
            </a>
          </li>';
		 }			 
        echo'</ul>
      </nav>';
}
function display_user_navigation_project(){
	echo '<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="../media/pictures/user.png" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name" style="color:rgb(61, 61, 61);">'.db_get_firstName(get_user_username()). ' '. db_get_lastName(get_user_username()).'</p>
                  <div>
                    <small class="designation text-muted">'.db_get_userRoleName(get_user_username()).'</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>';
              if(check_if_user_admin_or_mod()){
				  echo '<a href="create.php" style="width:100%; text-decoration:none;"><button class="btn btn-success btn-block">New Project
                <i class="mdi mdi-plus"></i>
              </button></a>';
			  }
            echo '</div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../home.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-home" style="color:#979797"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="index.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-folder-open" style="color:#979797"></i>
              <span class="menu-title">My Projects</span>
            </a>
          </li>';
		  if(check_if_user_admin()){
			echo '<li class="nav-item">
            <a class="nav-link" href="../admin/index.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-account-network" style="color:#e65251"></i>
              <span class="menu-title">Admin</span>
            </a>
          </li>';
		 }	
    echo '</ul>
      </nav>';
}
function display_user_navigation_neural(){
	echo '<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="../media/pictures/user.png" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name" style="color:rgb(61, 61, 61);">'.db_get_firstName(get_user_username()). ' '. db_get_lastName(get_user_username()).'</p>
                  <div>
                    <small class="designation text-muted">'.db_get_userRoleName(get_user_username()).'</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>';
              if(check_if_user_admin_or_mod()){
				  echo '<a href="create.php" style="width:100%; text-decoration:none;"><button class="btn btn-success btn-block">New Project
                <i class="mdi mdi-plus"></i>
              </button></a>';
			  }
            echo '</div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../home.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-home" style="color:#979797"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="index.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-folder-open" style="color:#979797"></i>
              <span class="menu-title">My Projects</span>
            </a>
          </li>';
		  if(check_if_user_admin()){
			echo '<li class="nav-item">
            <a class="nav-link" href="../admin/index.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-account-network" style="color:#e65251"></i>
              <span class="menu-title">Admin</span>
            </a>
          </li>';
		 }	
    echo '</ul>
      </nav>';
}
function display_user_navigation_admin(){
	echo '<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="../media/pictures/user.png" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name" style="color:rgb(61, 61, 61);">'.db_get_firstName(get_user_username()). ' '. db_get_lastName(get_user_username()).'</p>
                  <div>
                    <small class="designation text-muted">'.db_get_userRoleName(get_user_username()).'</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>';
              if(check_if_user_admin_or_mod()){
				  echo '<a href="../project/create.php" style="width:100%; text-decoration:none;"><button class="btn btn-success btn-block">New Project
                <i class="mdi mdi-plus"></i>
              </button></a>';
			  }
            echo '</div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../home.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-home" style="color:#979797"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="../project/index.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-folder-open" style="color:#979797"></i>
              <span class="menu-title">My Projects</span>
            </a>
          </li>';
	  if(check_if_user_admin()){
	echo '<li class="nav-item">
			<a class="nav-link" href="index.php" style="color:#4a4a4a">
			<i class="menu-icon mdi mdi-account-network" style="color:#e65251"></i>
			<span class="menu-title">Admin</span>
			</a>
		  </li>';
		}	
        echo '</ul>
      </nav>';
}
/* RIGHT USER NAV DROPDOWN */
function display_user_navbar_home(){
	$user = get_user_username();
	echo '<ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-file-document-box"></i>
              <span class="count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 0 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                  <!-- x3 was here -->
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              <span class="count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 0 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-email-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, '. $user .'</span>
              <img class="img-xs rounded-circle" src="media/pictures/user.png" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-settings mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a class="dropdown-item mt-2" href="profile.php?user='.$_COOKIE['user'].'">
                Manage Account
              </a>
              <a class="dropdown-item" href="">
                Change Password
              </a>
              <a class="dropdown-item" href="">
                Check Inbox
              </a>
              <a class="dropdown-item" href="logout.php">
                Sign Out
              </a>
            </div>
          </li>
        </ul>';
}
function display_user_navbar_project(){
	$user = get_user_username();
	echo '<ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-file-document-box"></i>
              <span class="count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 0 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                  <!-- x3 was here -->
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              <span class="count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 0 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-email-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, '. $user .'</span>
              <img class="img-xs rounded-circle" src="../media/pictures/user.png" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-settings mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a class="dropdown-item mt-2" href="../profile.php?user='.$_COOKIE['user'].'">
                Manage Account
              </a>
              <a class="dropdown-item" href="">
                Change Password
              </a>
              <a class="dropdown-item" href="">
                Check Inbox
              </a>
              <a class="dropdown-item" href="../logout.php">
                Sign Out
              </a>
            </div>
          </li>
        </ul>';
}
function display_user_navbar_neural(){
	$user = get_user_username();
	echo '<ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-file-document-box"></i>
              <span class="count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 0 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                  <!-- x3 was here -->
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              <span class="count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 0 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-email-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, '. $user .'</span>
              <img class="img-xs rounded-circle" src="../media/pictures/user.png" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-settings mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a class="dropdown-item mt-2" href="../profile.php?user='.$_COOKIE['user'].'">
                Manage Account
              </a>
              <a class="dropdown-item" href="">
                Change Password
              </a>
              <a class="dropdown-item" href="">
                Check Inbox
              </a>
              <a class="dropdown-item" href="../logout.php">
                Sign Out
              </a>
            </div>
          </li>
        </ul>';
}
function display_user_navbar_admin(){
	$user = get_user_username();
	echo '<ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-file-document-box"></i>
              <span class="count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 0 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                  <!-- x3 was here -->
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              <span class="count">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 0 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-email-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, '. $user .'</span>
              <img class="img-xs rounded-circle" src="../media/pictures/user.png" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-settings mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a class="dropdown-item mt-2" href="../profile.php?user='.$_COOKIE['user'].'">
                Manage Account
              </a>
              <a class="dropdown-item" href="">
                Change Password
              </a>
              <a class="dropdown-item" href="">
                Check Inbox
              </a>
              <a class="dropdown-item" href="../logout.php">
                Sign Out
              </a>
            </div>
          </li>
        </ul>';
}
// removed will be later used
function display_last_four_home($user_id){
	global $db;
	$str = "SELECT p.project_id, p.project_name from project p join on_board o on o.project_id = p.project_id where o.user_id = {$user_id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
	echo '<div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">';
	while ($row = $stmt->fetch()) {
		echo '<li class="nav-item">
                  <a class="nav-link color-fix-nav" href="project/index.php?project='.$row['project_id'].'">'.$row['project_name'].'</a>
                </li>';
	}
	echo '</ul></div>';
}
function display_last_four_project($user_id){
	global $db;
	$str = "SELECT p.project_id, p.project_name from project p join on_board o on o.project_id = p.project_id where o.user_id = {$user_id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
	echo '<div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">';
	while ($row = $stmt->fetch()) {
		echo '<li class="nav-item">
                  <a class="nav-link color-fix-nav" href="index.php?project='.$row['project_id'].'">'.$row['project_name'].'</a>
                </li>';
	}
	echo '</ul></div>';
}
function display_last_four_admin($user_id){
	global $db;
	$str = "SELECT p.project_id, p.project_name from project p join on_board o on o.project_id = p.project_id where o.user_id = {$user_id}";
    $stmt = $db->prepare($str);
    $stmt->execute();
	echo '<div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">';
	while ($row = $stmt->fetch()) {
		echo '<li class="nav-item">
                  <a class="nav-link color-fix-nav" href="../project/index.php?project='.$row['project_id'].'">'.$row['project_name'].'</a>
                </li>';
	}
	echo '</ul></div>';
}

/* display addition to project ul bar top left - blue */
function display_admin_mod_list_item_projects(){
	if(check_if_user_admin_or_mod()){
		echo '<li class="nav-item">
				<a href="create.php" class="nav-link">
				  <i class="mdi mdi-folder-plus"></i>New Project</a>
			  </li>';
	}
}
function display_admin_mod_list_item_projects_active(){
	if(check_if_user_admin_or_mod()){
		echo '<li class="nav-item active">
				<a href="create.php" class="nav-link">
				  <i class="mdi mdi-folder-plus"></i>New Project</a>
			  </li>';
	}
}
function display_admin_mod_list_item_admin_active(){
	if(check_if_user_admin_or_mod()){
		echo '<li class="nav-item active">
				<a href="index.php" class="nav-link">
              <i class="mdi mdi-account-network"></i>Admin</a>
			  </li>';
	}
}
function display_admin_mod_list_item_admin(){
	if(check_if_user_admin_or_mod()){
		echo '<li class="nav-item">
				<a href="index.php" class="nav-link">
              <i class="mdi mdi-account-network"></i>Admin</a>
			  </li>';
	}
}
?>