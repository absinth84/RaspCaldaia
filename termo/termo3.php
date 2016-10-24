<html>

<link href='../css/main.css' rel='stylesheet' type='text/css' />

<script type="text/javascript" src="../lib/Chart.bundle.js"></script>

<?php include("../include/header3.php")?>
<
</header>

<canvas id="myChart" hight="200", width="300"></canvas>



<script language=javascript>

<?php
$start=-300;
$end=-1;
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_NONE);

//$count = $redis->dbSize();

$lettura      = $redis->lRange('lettura', $start, $end);
$timestamp    = $redis->lRange('timestamp', $start, $end);
$tempext 	  = $redis->lRange('temp_esterna', $start, $end);
$termo        = $redis->lRange('camera', $start, $end);
$relay         = $redis->lRange('rele', $start, $end);
$min	      = $redis->lRange('min', $start, $end);
$max	      = $redis->lRange('max', $start, $end);


for ($i=0;$i<=(abs($start)-1);$i++) {
	$data_temp[$i][x] =  $timestamp[$i];
	$data_temp[$i][y] =  $termo[$i];

	$data_tempext[$i][x] =  $timestamp[$i];
	$data_tempext[$i][y] =  $tempext[$i];

	$data_relay[$i][x] =  $timestamp[$i];
	$data_relay[$i][y] =  $relay[$i] * 10;

}


?>

var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
	type: 'line',
	data: {
		datasets: [{
			label: 'Temp internal',
			fill: false,
			borderColor: "rgba(75,192,192,1)",
			borderCapStyle: 'butt',
			pointBorderColor: "rgba(75,192,192,1)",
			pointBackgroundColor: "#fff",
			pointBorderWidth: 1,
			pointHoverRadius: 5,
			pointHoverBackgroundColor: "rgba(75,192,192,1)",
			pointHoverBorderColor: "rgba(220,220,220,1)",
			pointHoverBorderWidth: 2,
			pointRadius: 1,
			pointHitRadius: 10,
			data: <?php echo json_encode($data_temp);?>
		},
		{
			label: 'Temp external',
			fill: true,
			backgroundColor: "rgba(38,45,255,0.3)",
			borderColor: "blue",
			borderCapStyle: 'butt',
			pointBorderColor: "blue",
			pointBackgroundColor: "#fff",
			pointBorderWidth: 1,
			pointHoverRadius: 5,
			pointHoverBackgroundColor: "rgba(75,192,192,1)",
			pointHoverBorderColor: "rgba(220,220,220,1)",
			pointHoverBorderWidth: 2,
			pointRadius: 1,
			pointHitRadius: 10,
			data: <?php echo json_encode($data_tempext);?>
			},
			{
				label: 'Relay',
				fill: true,
				backgroundColor: "rgba(255,10,10,0.6)",
				borderColor: "red",
				borderCapStyle: 'butt',
				pointBorderColor: "red",
				pointBackgroundColor: "#fff",
				pointBorderWidth: 1,
				pointHoverRadius: 5,
				pointHoverBackgroundColor: "rgba(75,192,192,1)",
				pointHoverBorderColor: "rgba(220,220,220,1)",
				pointHoverBorderWidth: 2,
				pointRadius: 1,
				pointHitRadius: 10,
				data: <?php echo json_encode($data_relay);?>
		}],

	},
	options: {
		responsive: true,
		title:{
			display:true,
			text:"Temperatur"
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
				position: "right",
				scaleLabel: {
					display: true,
					labelString: 'Temp'
				}
			}]
		}
	}
});


</script>


<body>
</body>


</html>
