<div id="nav">
	<ul id="menu">
		<li><a href="<?php echo site_url(array(
				"c" => "admin", "m" => "log_viewer", "server" => "rr", "type" => "1"
			)); ?>">Resonant
				Rise 1</a></li>
		<li><a href="<?php echo site_url(array(
				"c" => "admin", "m" => "log_viewer", "server" => "rr", "type" => "2"
			)); ?>">Resonant
				Rise 2</a></li>
		<li><a href="<?php echo site_url(array(
				"c" => "admin", "m" => "log_viewer", "server" => "ftb", "type" => "unleashed"
			)); ?>">FTB Unleashed</a></li>
	</ul>
</div>
<div id="main_log">
	<p>
		<?php echo $log; ?>
	</p>
</div>