<script type="text/javascript" src="./js/tick_board.js"></script>
<div id="nav">
	<ul id="menu">
		<li><a href="<?php echo site_url(array("c" => "admin", "m" => "board", "server" => "rr", "type" => "1")); ?>">Resonant
				Rise 1</a></li>
		<li><a href="<?php echo site_url(array("c" => "admin", "m" => "board", "server" => "rr", "type" => "2")); ?>">Resonant
				Rise 2</a></li>
		<li><a href="<?php echo site_url(array(
				"c" => "admin", "m" => "board", "server" => "ftb", "type" => "unleashed"
			)); ?>">FTB Unleashed</a></li>
	</ul>
</div>
<div id="main">
	<div class="listCSS">
		<ul id="menu">
			<li class="menuLink" display="single"><a href="#">Single Entities</a></li>
			<li class="menuLink" display="chunk"><a href="#">Chunks</a></li>
			<li class="menuLink" display="type"><a href="#">Entity Types</a></li>
			<li class="menuLink" display="call"><a href="#">Average Calls</a></li>
		</ul>
	</div>
	<div class="mainText">
		<p>
			TPS: <?php echo $tps; ?><br/>
			Last Updated: <?php echo $last_update; ?> <br/>
			Players: <?php echo $players; ?><br/>
			Player Count: <?php echo $playerCount; ?>
		</p>
	</div>

	<div class='tableCSS' id='single'>
		<table>
			<tr>
				<td>Single Entity</td>
				<td>Position (X, Y, Z)</td>
				<td>Time/Tick</td>
				<td>%</td>
				<td>Dynmap</td>
			</tr>
			<?php foreach ($entities as $entity): ?>
				<tr>
					<td><?php echo $entity["name"]; ?></td>
					<td><?php echo $entity["position"]; ?></td>
					<td><?php echo $entity["Time/Tick"]; ?></td>
					<td class="<?php if ($entity["%"] >= 5) {
						echo "red";
					} elseif ($entity["%"] >= 3 && $entity["%"] < 5) {
						echo "yellow";
					} else {
						echo "green";
					} ?>"><?php echo $entity["%"]; ?></td>
					<td>
						<?php if (! empty($entity["dynmap_url"])) { ?><a href="<?php echo $entity["dynmap_url"]; ?>"
						                                                 target="_blank">Link</a><?php } ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div class='tableCSS' id='chunk'>
		<table>
			<tr>
				<td>Chunk Coordinates</td>
				<td>Position (X, Z)</td>
				<td>Time/Tick</td>
				<td>%</td>
				<td>Dynmap</td>
			</tr>
			<?php foreach ($chunks as $chunk): ?>
				<tr>
					<td><?php echo $chunk["Chunk"]; ?></td>
					<td><?php echo $chunk["position"]; ?></td>
					<td><?php echo $chunk["Time/Tick"]; ?></td>
					<td class="<?php if ($chunk["%"] >= 5) {
						echo "red";
					} elseif ($chunk["%"] >= 3 && $chunk["%"] < 5) {
						echo "yellow";
					} else {
						echo "green";
					} ?>"><?php echo $chunk["%"]; ?></td>
					<td><?php if (! empty($chunk["dynmap_url"])) { ?><a href="<?php echo $chunk["dynmap_url"]; ?>"
					                                                    target="_blank">Link</a><?php } ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div class='tableCSS' id='type'>
		<table>
			<tr>
				<td>All Entities of Type</td>
				<td>Time/Tick</td>
				<td>%</td>
			</tr>
			<?php foreach ($types as $type): ?>

				<tr>
					<td><?php echo $type["All Entities of Type"]; ?></td>
					<td><?php echo $type["Time/Tick"]; ?></td>
					<td><?php echo $type["%"]; ?></td>
				</tr>

			<?php endforeach; ?>
		</table>
	</div>
	<div class='tableCSS' id='call'>
		<table>
			<tr>
				<td>Average Entity of Type</td>
				<td>Time/Tick</td>
				<td>Calls</td>
			</tr>
			<?php foreach ($calls as $call): ?>
				<tr>
					<td><?php echo $call["Average Entity of Type"]; ?></td>
					<td><?php echo $call["Time/tick"]; ?></td>
					<td><?php echo $call["Calls"]; ?></td>
				</tr>

			<?php endforeach; ?>
		</table>
	</div>
</div>