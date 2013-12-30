<div id="main">
	<?php foreach ($data as $key => $value): ?>
		<h2><?php echo $key; ?></h2>
		<p>
			TPS: <?php echo $value["tps"]; ?><br/>
			Player Count: <?php echo $value["count"]; ?>
		</p>
	<?php endforeach; ?>
</div>