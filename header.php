<?php
ob_start();
include 'lib/oms.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/lib/session.php';
Session::init();
$name = Session::get("name");
$msg = Session::get("loginmsg");
$id = Session::get("id");
$admin = Session::get("admin");

Session::sessionCheck();

$oms = new oms();

$taskLimit = $oms->view_task_limit();
$pendingTask = $oms->count_pending_task($id);
$ongoingTask = $oms->count_ongoing_task($id);
$allTask = $oms->count_all_task();

//Count Inbox Item  
$viewInbox = $oms->view_inbox($id);
$countInbox = $oms->count_inbox($id);


//Logout
if(isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}

//Check Out
if(isset($_GET['action']) && $_GET['action'] == "ckeckout") {
    $empCheckout = $oms->ckeckout_time($id);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<title>TaskBoard - UniProjects</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link href="css/light.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="dashboard.php">
          <span class="align-middle"><img height="60px" src="img/icons/logo2.png"/> UniProjects</span>
        </a>

				<ul class="sidebar-nav" id="sidemenu">
					<li class="sidebar-header">
						Menu
					</li>


					<li class="sidebar-item <?php if(basename($_SERVER['PHP_SELF'])=="dashboard.php") echo "active"; ?>">
						<a class="sidebar-link" aria-expanded="false" href="dashboard.php">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
					</li>

					<li class="sidebar-item <?php if(basename($_SERVER['PHP_SELF'])=="task-list.php" || basename($_SERVER['PHP_SELF'])=="task.php" || basename($_SERVER['PHP_SELF'])=="my-task.php"  ) echo "active"; ?>">
                    <a href="#task"  data-bs-toggle="collapse" class="sidebar-link <?php if(basename($_SERVER['PHP_SELF'])!=="task-list.php" && basename($_SERVER['PHP_SELF'])!=="task.php" && basename($_SERVER['PHP_SELF']) !=="my-task.php" ) echo "collapsed"; ?>">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Task</span>
                        </a>
                        <ul id="task" class="sidebar-dropdown list-unstyled <?php if(basename($_SERVER['PHP_SELF'])!=="task-list.php" && basename($_SERVER['PHP_SELF'])!=="task.php" && basename($_SERVER['PHP_SELF'])!=="my-task.php" ) echo "collapse"; ?>" data-bs-parent="#sidebar">
							<li class="sidebar-item <?php if(basename($_SERVER['PHP_SELF'])=="my-task.php") echo "active"; ?>"><a class="sidebar-link" href="my-task.php">My Task</a></li>
							<li class="sidebar-item <?php if(basename($_SERVER['PHP_SELF'])=="task-list.php") echo "active"; ?>"><a class="sidebar-link" href="task-list.php">All Task</a></li>
							<li class="sidebar-item <?php if(basename($_SERVER['PHP_SELF'])=="task.php") echo "active"; ?>"><a class="sidebar-link" href="task.php">Add Task</a></li>
						</ul>
					</li>

					<li class="sidebar-item <?php if(basename($_SERVER['PHP_SELF'])=="message.php" || basename($_SERVER['PHP_SELF'])=="sent.php" || basename($_SERVER['PHP_SELF'])=="compose.php"  ) echo "active"; ?>">
						<a href="#messages"  data-bs-toggle="collapse" class="sidebar-link <?php if(basename($_SERVER['PHP_SELF'])!=="message.php" && basename($_SERVER['PHP_SELF'])!=="sent.php" && basename($_SERVER['PHP_SELF'])!=="compose.php"  ) echo "collapsed"; ?> ">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Messages</span>
                        </a>
                        <ul id="messages" class="sidebar-dropdown list-unstyled <?php if(basename($_SERVER['PHP_SELF'])!=="message.php" && basename($_SERVER['PHP_SELF'])!=="sent.php" && basename($_SERVER['PHP_SELF'])!=="compose.php"  ) echo "collapse"; ?> " data-bs-parent="#sidebar">
							<li class="sidebar-item <?php if(basename($_SERVER['PHP_SELF'])=="message.php") echo "active"; ?>"><a class="sidebar-link" href="message.php">Inbox</a></li>
							<li class="sidebar-item <?php if(basename($_SERVER['PHP_SELF'])=="sent.php") echo "active"; ?>"><a class="sidebar-link" href="sent.php">Sent</a></li>
							<li class="sidebar-item <?php if(basename($_SERVER['PHP_SELF'])=="compose.php") echo "active"; ?>"><a class="sidebar-link" href="compose.php">Compose New </a></li>
						</ul>
					</li>
					<?php if($admin ==1){ ?>
					<li class="sidebar-item <?php if(basename($_SERVER['PHP_SELF'])=="view-employee.php" || basename($_SERVER['PHP_SELF'])=="add-employee.php" ) echo "active"; ?>">
						<a href="#employee" data-bs-toggle="collapse" class="sidebar-link m <?php if(basename($_SERVER['PHP_SELF'])!=="view-employee.php" && basename($_SERVER['PHP_SELF'])!=="add-employee.php" ) echo "collapsed"; ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> <span class="align-middle">Employee</span>
						</a>
						<ul id="employee" class="sidebar-dropdown list-unstyled <?php if(basename($_SERVER['PHP_SELF'])!=="view-employee.php" && basename($_SERVER['PHP_SELF'])!=="add-employee.php" ) echo "collapse"; ?> " data-bs-parent="#sidebar">
							<li class="sidebar-item <?php if(basename($_SERVER['PHP_SELF'])=="view-employee.php") echo "active"; ?>"><a class="sidebar-link" href="view-employee.php">All Employee</a></li>
							<li class="sidebar-item <?php if(basename($_SERVER['PHP_SELF'])=="add-employee.php") echo "active"; ?>"><a class="sidebar-link " href="add-employee.php">Add New Employee</a></li>
							<!-- <li class="sidebar-item"><a class="sidebar-link" href="pages-reset-password.html">Edit Employee Information</a></li> -->
						</ul>
					</li>
						<?php } ?>
					<li class="sidebar-header">
						Tools & Components
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="setting.php">
              <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
            </a>
					</li>

					

					

					
					

				
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="layers"></i>
									<span class="indicator">
                                        <?php
                                            if(isset($pendingTask))
                                                echo $pendingTask;
                                        ?>
                                    </span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
                                <?php
                                            if(isset($pendingTask))
                                                echo $pendingTask;
                                            else echo 0;
                                ?> New Task
								</div>
								<div class="list-group">
                                <?php
                                    if($taskLimit){
                                        foreach ($taskLimit as $value) {
                                ?>
									<a href="view-task.php?view-id=<?php echo $value['id']; ?>" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-primary" data-feather="check"></i>
											</div>
											<div class="col-10">
												<div class="text-dark"><?php echo $value['task_name']; ?></div>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $value['completion']; ?>%" aria-valuenow="<?php echo $value['completion']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                              
												
											</div>
										</div>
									</a>
                                    <?php
                                        }
                                    }
                                    ?>
								</div>
								<div class="dropdown-menu-footer">
									<a href="my-task.php" class="text-muted">Show all tasks</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="message-square"></i>
                                    <span class="indicator">
                                    <?php
                                        if(isset($countInbox)){ echo $countInbox; } 
                                    ?>
                                    </span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
                                    <?php
                                        if(isset($countInbox)){ echo $countInbox; }
                                        else{echo 0;} 
                                    ?> New Messages
									</div>
								</div>
								<div class="list-group">
                                <?php
                                    if($viewInbox){
                                        foreach ($viewInbox as $viewValue) {
                                ?>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark"><?php echo $viewValue['name']; ?></div>
												<div class="text-muted small mt-1"><?php echo $viewValue['subject']; ?></div>
												<div class="text-muted small mt-1"><?php echo date('h-i-s A', strtotime($viewValue['date_times'])); ?></div>
											</div>
										</div>
									</a>
                                    <?php
                                        }
                                    }
                                    ?>
								</div>
								<div class="dropdown-menu-footer">
									<a href="message.php" class="text-muted">Show all messages</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark"><?php if(isset($name)) echo $name; ?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="pages-settings.html"><i class="align-middle me-1" data-feather="settings"></i> Settings</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="?action=logout">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>


