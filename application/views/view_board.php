<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>TPS Data</title>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<script type="text/javascript"
	src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/tick_board.js"></script>
</head>
<body>
	<ul>
		<li class="menuLink" display="single"><a href="#">Single Entities</a></li>
		<li class="menuLink" display="chunk"><a href="#">Chunks</a></li>
		<li class="menuLink" display="type"><a href="#">Entity Types</a></li>
		<li class="menuLink" display="call"><a href="#">Average Calls</a></li>
	</ul>
	<div>
		<p>
			TPS: <?php echo $tps;?><br />
			Last Updated: <?php echo $last_update;?> <br />
			Players: <?php echo $players;?><br />
			Player Count: <?php echo $playerCount;?>
		</p>
	</div>
	<div class='tableCSS' id='single'>
		<table>
			<tr>
				<td>Single Entity</td>
				<td>Time/Tick</td>
				<td>%</td>
			</tr>
			<?php foreach ($entities as $entity):?>
			<tr>
				<td><?php echo $entity["Single Entity"];?></td>
				<td><?php echo $entity["Time/Tick"];?></td>
				<td><?php echo $entity["%"];?></td>
			</tr>

<?php endforeach;?>
		</table>
	</div>
	<div class='tableCSS' id='chunk'>
		<table>
			<tr>
				<td>Chunk Position</td>
				<td>Time/Tick</td>
				<td>%</td>
			</tr>
			<?php foreach ($chunks as $chunk):?>
			<tr>
				<td><?php echo $chunk["Chunk"];?></td>
				<td><?php echo $chunk["Time/Tick"];?></td>
				<td><?php echo $chunk["%"];?></td>
			</tr>

<?php endforeach;?>
		</table>
	</div>
	<div class='tableCSS' id='type'>
		<table>
			<tr>
				<td>All Entities of Type</td>
				<td>Time/Tick</td>
				<td>%</td>
			</tr>
			<?php foreach ($types as $type):?>

<tr>
				<td><?php echo $type["All Entities of Type"];?></td>
				<td><?php echo $type["Time/Tick"];?></td>
				<td><?php echo $type["%"];?></td>
			</tr>

<?php endforeach;?>
		</table>
	</div>
	<div class='tableCSS' id='call'>
		<table>
			<tr>
				<td>Average Entity of Type</td>
				<td>Time/Tick</td>
				<td>Calls</td>
			</tr>
			<?php foreach ($calls as $call):?>
			<tr>
				<td><?php echo $call["Average Entity of Type"];?></td>
				<td><?php echo $call["Time/tick"];?></td>
				<td><?php echo $call["Calls"];?></td>
			</tr>

<?php endforeach;?>
		</table>
	</div>
</body>
</html>