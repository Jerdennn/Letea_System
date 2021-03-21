<?php
require_once '../config.php';
require_once '../session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Le'tea Milk Tea Hub</title>

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/png" href="../images/logo_letea.png">
    <!-- Import lib -->
    <link rel="stylesheet" type="text/css" href="../../public_html/fontawesome-free/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
    <link rel="stylesheet" type="text/css" href="../../public_html/fontawesome-free/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- End import lib -->
    <link rel="stylesheet" type="text/css" href="../../public_html/css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="public_html/css/modal.css">
</head>

<body class="overlay-scrollbar">
	<!-- navbar -->
	<div class="navbar">
		<!-- nav left -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link">
					<i class="fas fa-bars" onclick="collapseSidebar()"></i>
				</a>
			</li>
			<li class="nav-item">
				<img src="../../public_html/img/letea.png" alt="ATPro logo" class="logo logo-light">
				<img src="../../public_html/img/letea.png" alt="ATPro logo" class="logo logo-dark">
			</li>
		</ul>
		<!-- end nav left -->
		<!-- form -->
		<form class="navbar-search">
			<input type="text" name="Search" class="navbar-search-input" placeholder="What you looking for...">
			<i class="fas fa-search"></i>
		</form>
		<!-- end form -->
		<!-- nav right -->
		<ul class="navbar-nav nav-right">
			<li class="nav-item mode">
				<a class="nav-link" href="#" onclick="switchTheme()">
					<i class="fas fa-moon dark-icon"></i>
					<i class="fas fa-sun light-icon"></i>
				</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link">
					<i class="fas fa-bell dropdown-toggle" data-toggle="notification-menu"></i>
					<span class="navbar-badge"><?php 
					$query = "SELECT COUNT(*) AS counts FROM PRODUCT WHERE P_QTY < 15";
					$result = mysqli_query($db,$query);
					$row = mysqli_fetch_array($result);
						echo $row['counts'];
					?></span>
				</a>
				<ul id="notification-menu" class="dropdown-menu notification-menu">
					<div class="dropdown-menu-header">
						<span>
							Notifications
						</span>
					</div>
					<div class="dropdown-menu-content overlay-scrollbar scrollbar-hover">
					<?php $query = "SELECT p_name FROM product WHERE p_qty < 15 LIMIT 5";
						  $result = mysqli_query($db,$query);?>
						<?php while($row = mysqli_fetch_array($result)){ ?>		
						<li class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
							<div>
								<i class="fas fa-clipboard-list"></i>
							</div>
							<?php echo $row['p_name']; ?>
						<?php } ?>
					</div>
					<div class="dropdown-menu-footer">
						<span>
							 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;Products that need to Re-Order 
						</span>
					</div>
				</ul>
			</li>
			<li class="nav-item avt-wrapper">
				<div class="avt dropdown">
					<img src="../../public_html/img/user.png" alt="user.jpg" class="dropdown-toggle" data-toggle="user-menu">
					<ul id="user-menu" class="dropdown-menu">
						<li  class="dropdown-menu-item">
							<a class="dropdown-menu-link" href="../admin_forms/profile.php">
								<div>
									<i class="fas fa-user-edit"></i>
								</div>
								<span>Profile</span>
							</a>
						</li>
						
						
						<li  class="dropdown-menu-item">
							<a href="../logout.php" class="dropdown-menu-link">
								<div>
									<i class="fas fa-sign-out-alt"></i>
								</div>
								<span>Logout</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>
		<!-- end nav right -->
	</div>
	<!-- end navbar -->