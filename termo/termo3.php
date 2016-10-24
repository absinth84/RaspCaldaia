<html>


<script type="text/javascript" src="../lib/Chart.bundle.js"></script>
<canvas id="myChart" width="200" height="200"></canvas>

<script language=javascript>

var  datarelay = [], dataest = [], options;


<?php
$start=-300;
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

$data = array
	(
		array(),
		array()
	);

for ($i=0;$i<=(abs($start)-1);$i++) {

	//		datarelay.push([" . $timestamp[$x] .", ". ($rele[$x] * 10) . "]);\n";
	//		dataest.push([" . $timestamp[$x] .", ". $temp_esterna[$x] . "]);\n";

	//	$data .= '{x: ' . $temp_esterna[$i] . ', y: ' . $termo[$i] . '},';
//	array_push[0]($data, "x: " . $timestamp[$i] . ", y: " . $termo[$i]);

	$data[$i][x] =  $timestamp[$i];
	$data[$i][y] =  $termo[$i];
}

?>


//alert(<?php echo json_encode(array_values($data)); ?>);


$json = <?php echo json_encode($data); ?>;


var serie = [{ x: 19, y: 65 },{ x: 27, y: 59 },{ x: 28, y: 69 },{ x: 40, y: 81 },{ x: 48, y: 56 }];

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
	type: 'line',
	data: {
		datasets: [{
			label: 'Scatter Dataset',
			data: <?php echo json_encode($data); ?>
		}]
	},
	options: {
				responsive: true,
                title:{
                    display:true,
                    text:"Chart.js Time Point Data"
                },
				scales: {
					xAxes: [{
						type: 'time',
						time: {
							format: 'X',
					//		 round: 'day',
						},

						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Date'
						}
					}],
					yAxes: [{
						type: 'linear',
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Temp'
						}
					}]
				}
			}
});


</script>


</head>

<body>
</body>


</html>
