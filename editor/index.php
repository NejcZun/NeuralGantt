<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UV Projektna Naloga | Editor</title>
  <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="shortcut icon" href="../images/favicon.png" />
  <!-- editor --> 
  <link rel="stylesheet" href="../media/layout.css">
  <script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
  <script src="../js/gantt.min.js" type="text/javascript"></script>
  <style>
	.gantt_default_corner  > div:nth-child(4) {
	    background: rgb(243, 243, 243)!important;
		color: rgb(243, 243, 243)!important;
		content: 'Burek'!important;
	}
	.profile-name{
		font-family: "Poppins", sans-serif;
	}
</style>
</head>
<body>
  <?php
  //require '_db_mysql.php';
  ?>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background: #5983e8;">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php">
          <img src="../media/pictures/logo-mini.svg" alt="logo" style="height: 40px;width: 40px;;"/><h2 style="color:rgb(74, 74, 74); padding-top:10px;">UV Projektna</h2>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.php">
		<img src="../media/pictures/logo-mini.svg" alt="logo" style="height: 40px;width: 100%;"/>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <li class="nav-item">
            <a href="../index.php" class="nav-link">Home
            </a>
          </li>
          <li class="nav-item active">
            <a href="index.php" class="nav-link">
              <i class="mdi mdi-folder"></i>Project</a>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
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
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">Random
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
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">Random
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="../media/pictures/user.png" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark">Random
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
              <span class="profile-text">Hello, User!</span>
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
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a class="dropdown-item mt-2" href="">
                Manage Accounts
              </a>
              <a class="dropdown-item" href="">
                Change Password
              </a>
              <a class="dropdown-item" href="">
                Check Inbox
              </a>
              <a class="dropdown-item" href="">
                Sign Out
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
	<!-- sliding dash -->
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="../media/pictures/user.png" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">User Name and Surname</p>
                  <div>
                    <small class="designation text-muted">Title</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              <button class="btn btn-success btn-block">New Project
                <i class="mdi mdi-plus"></i>
              </button>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-television" style="color:#979797"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="index.php" style="color:#4a4a4a">
              <i class="menu-icon mdi mdi-folder-open" style="color:#979797"></i>
              <span class="menu-title">My Projects</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-folder"></i>
              <span class="menu-title">Last 5 Projects</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="editor">Project 1</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="editor">Project 2</a>
                </li>
				<li class="nav-item">
                  <a class="nav-link" href="editor">Project 3</a>
                </li>
				<li class="nav-item">
                  <a class="nav-link" href="editor">Project 4</a>
                </li>
				<li class="nav-item">
                  <a class="nav-link" href="editor">Project 5</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-folder-multiple text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">My Projects</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>Click here to view your projects
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-multiple text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">Manage users</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>Click here to manage users on your projects
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">Neural Networks</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>Click here to view neural networks
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-settings text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">Settings</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Click here to view your settings
                  </p>
                </div>
              </div>
            </div>
          </div>
		  <div class="shadow"></div>
        <div class="hideSkipLink">
        </div>
        <div class="main">

            <div class="space"></div>

            <div id="dp"></div>

            <script type="text/javascript">
                var dp = new DayPilot.Gantt("dp");
                dp.startDate = new DayPilot.Date("2019-01-01");
                dp.days = 93;

                dp.linkBottomMargin = 5;

                dp.rowCreateHandling = 'Enabled';

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
                    $.post("backend_create.php", {
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

        </div>
        <div class="clear">
        </div>
		  
		  
        </div>
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019
              <a href="https://www.fri.uni-lj.si/sl" target="_blank" style="color:#5983e8;">FRI Ljubljana</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Avtorja: Nejc Žun, Grega Černak
            </span>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <script src="../vendors/js/vendor.bundle.addons.js"></script>
  <script src="../js/off-canvas.js"></script>
  <script src="../js/misc.js"></script>
  <script src="../js/dashboard.js"></script>
</body>

</html>