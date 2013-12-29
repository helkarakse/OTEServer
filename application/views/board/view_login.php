<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>TickProfiler Admin Portal></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="css/board.css">
	<link rel="stylesheet" type="text/css" href="css/horizontal-menu.css">
	<link rel="stylesheet" type="text/css" href="css/vertical-menu.css">
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<div class="formCenter">
	<?php echo form_open('c=board&m=index'); ?>
	<?php echo form_fieldset('Login'); ?>

	<div class="textfield">
		<?php echo form_label('Username', 'user_name'); ?>
		<?php echo form_input('user_name'); ?>
	</div>

	<div class="textfield">
		<?php echo form_label('Password', 'user_pass'); ?>
		<?php echo form_password('user_pass'); ?>
	</div>

	<div class="buttons">
		<?php echo form_submit('login', 'Login'); ?>
	</div>

	<?php echo form_fieldset_close(); ?>
	<?php echo form_close(); ?>
</div>
</body>
</html>
