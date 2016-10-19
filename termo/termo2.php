<html>

	<link href='../css/style.css' rel='stylesheet' type='text/css' />




	<script language=javascript>

	var data = [], datarelay = [], dataest = [], options;

	<?php
	$start=-10;
	$end=-1;
	$redis = new Redis();
	$redis->connect('127.0.0.1', 6379);
	$redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_NONE);

	//$count = $redis->dbSize();

	$lettura      = $redis->lRange('lettura', $start, $end);
	$timestamp    = $redis->lRange('timestamp', $start, $end);
	$temp_esterna = $redis->lRange('temp_esterna', $start, $end);
	$termo        = $redis->lRange('camera', $start, $end);
	$rele         = $redis->lRange('rele', $start, $end);
	$min	      = $redis->lRange('min', $start, $end);
	$max	      = $redis->lRange('max', $start, $end);



	for ($i=0;$i<=(abs($start)-1);$i++) {
?>
		data.push("{x: <?php echo $timestamp[$i]; ?> , y:  <?php echo $termo[$i]; ?>}")
//		datarelay.push([" . $timestamp[$x] .", ". ($rele[$x] * 10) . "]);\n";
//		dataest.push([" . $timestamp[$x] .", ". $temp_esterna[$x] . "]);\n";
<?php
	}

?>
	window.onload = function () {
		var chart = new CanvasJS.Chart("chartContainer",
		{
			zoomEnabled: true,
			animationEnabled: true,
			title:{
				text: "100,000 Data Points! Zoom-in And Observe Axis Labels"
			},
			axisX :{

			},
			axisY :{

			},
			data: [
			{
				type: "line",
				xValueType: "TimeStamps",
				dataPoints: [
					{ x: 1428728497, y :23.866878382365},
					{ x: 1428728557, y :20.422467549642},
					{ x: 1428728617, y :14.559834416707},
					{ x: 1428728677, y :14.363437143962}
				]
			},
			]
		});
		chart.render();
	}


alert(data)
</script>

<script type="text/javascript" src="../lib/canvasjs.min.js"></script></head>

<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>

</html>
