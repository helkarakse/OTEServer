<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>TPS Data</title>
</head>
<body>
	<?php
	echo $this->gcharts->LineChart ( 'TPS' )->outputInto ( 'stock_div' );
	echo $this->gcharts->div ( 600, 300 );
	
	if ($this->gcharts->hasErrors ()) {
		echo $this->gcharts->getErrors ();
	}
	?>
</body>
</html>