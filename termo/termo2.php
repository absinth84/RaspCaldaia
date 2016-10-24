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


var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
type: 'bar',
data: {
	labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
	datasets: [{
		label: '# of Votes',
		data: [12, 19, 3, 5, 2, 3],
		backgroundColor: [
			'rgba(255, 99, 132, 0.2)',
			'rgba(54, 162, 235, 0.2)',
			'rgba(255, 206, 86, 0.2)',
			'rgba(75, 192, 192, 0.2)',
			'rgba(153, 102, 255, 0.2)',
			'rgba(255, 159, 64, 0.2)'
		],
		borderColor: [
			'rgba(255,99,132,1)',
			'rgba(54, 162, 235, 1)',
			'rgba(255, 206, 86, 1)',
			'rgba(75, 192, 192, 1)',
			'rgba(153, 102, 255, 1)',
			'rgba(255, 159, 64, 1)'
		],
		borderWidth: 1
	}]
},
options: {
	scales: {
		yAxes: [{
			ticks: {
				beginAtZero:true
			}
		}]
	}
}
});
</script>

alert(data)
</script>

<script type="text/javascript" src="../lib/Chart.js"></script></head>

<body>
<canvas id="myChart" width="400" height="400"></canvas></body>

</html>
