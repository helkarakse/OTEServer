<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Admin Portal</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="stylesheet" type="text/css" href="./css/horizontal-menu.css">
	<link rel="stylesheet" type="text/css" href="./css/vertical-menu.css">
	<script type="text/javascript"
	        src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<div id="wrap">
	<div id="header">
		<strong>OTE Gamers Admin Portal</strong>
	</div>
	<div id="mainWrapper">
		<?php $this->load->view($body); ?>
	</div>
	<div id="sidebar">
		<ul id="vertMenu">
			<li>
				<a href="<?php echo site_url(array("c" => "admin", "m" => "main")); ?>">Home</a>
			</li>
			<li>
				<a href="<?php echo site_url(array("c" => "admin", "m" => "board")); ?>">TPS Board</a>
			</li>
			<li>
				<a href="<?php echo site_url(array("c" => "admin", "m" => "graph")); ?>">TPS Graph</a>
			</li>
			<li>
				<a href="<?php echo site_url(array("c" => "admin", "m" => "logout")); ?>">Logout</a>
			</li>
		</ul>
	</div>
</div>
</body>
</html>
