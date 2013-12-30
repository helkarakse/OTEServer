<script type="text/javascript" src="./js/tick_board.js"></script>
<div id="nav">
	<ul id="menu">
		<li><a href="<?php echo site_url(array("c"     => "admin", "m" => "graph", "server" => "rr", "type" => "1",
		                                       "limit" => 50
			)); ?>">Resonant
				Rise 1</a></li>
		<li><a href="<?php echo site_url(array("c"     => "admin", "m" => "graph", "server" => "rr", "type" => "2",
		                                       "limit" => 50
			)); ?>">Resonant
				Rise 2</a></li>
		<li><a href="<?php echo site_url(array(
				"c" => "admin", "m" => "graph", "server" => "ftb", "type" => "unleashed", "limit" => 50
			)); ?>">FTB Unleashed</a></li>
	</ul>
</div>
<div id="main">
	<?php
		echo $this->gcharts->LineChart('TPS')->outputInto('stock_div');
		echo $this->gcharts->div(600, 300);

		if ($this->gcharts->hasErrors()) {
			echo $this->gcharts->getErrors();
		}
	?>
</div>