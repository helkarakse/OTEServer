<script type="text/javascript" src="./js/log_viewer.js"></script>
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
<div id="main">
	<div class="listCSS">
		<ul id="menu">
			<li class="menuLink" display="crash"><a href="#">Crash Logs</a></li>
			<li class="menuLink" display="server"><a href="#">Server Logs</a></li>
		</ul>
	</div>
	<br/>

	<div class='tableCSS' id='crash'>
		<table>
			<tr>
				<td>File</td>
				<td>Date</td>
				<td></td>
			</tr>
			<?php foreach ($files as $file): ?>
				<tr>
					<td><a href="<?php echo site_url(array(
							"c"        => "admin", "m" => "log_viewer", "server" => $server, "type" => $type,
							"log_type" => $log_type, "log_file" => $file["name"]
						)); ?>"><?php echo $file["name"]; ?></a></td>
					<td>Sample Date</td>
					<td>Pastebin</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div class='tableCSS' id='server'>
		<table>
			<tr>
				<td>File</td>
				<td>Date</td>
				<td>Link</td>
			</tr>
		</table>
	</div>
</div>