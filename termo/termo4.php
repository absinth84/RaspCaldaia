<html>

	<link href='../css/style.css' rel='stylesheet' type='text/css' />


	<script type="text/javascript" src="../lib/Chart.bundle.js"></script>
	<script src="https://d3js.org/d3.v4.min.js"></script>

	<script src="../lib/rickshaw.js"></script>
	<canvas id="myChart" width="400" height="400"></canvas>
	<div id="chart"></div>

	<script language=javascript>

	var  datarelay = [], dataest = [], options;

	var data = new Array();
	var inttemp = new Array;

	data = "[";

	<?php
	$start=-5;
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
//		data[0] = "x: " + <?php echo $timestamp[$i]; ?> ;
//		data[1] = "y: " + <?php echo $termo[$i]; ?>;

//		inttemp.push(data)

		data += "{x: " + <?php echo $temp_esterna[$i]; ?> + ", y:" +  <?php echo $termo[$i]; ?> + "},";

//		data.push("{<?php echo $timestamp[$i]; ?> , <?php echo $termo[$i]; ?>}");
//		datarelay.push([" . $timestamp[$x] .", ". ($rele[$x] * 10) . "]);\n";
//		dataest.push([" . $timestamp[$x] .", ". $temp_esterna[$x] . "]);\n";
<?php
	}

?>

data += "]";
alert(data);

var serie = [{ x: 19, y: 65 },{ x: 27, y: 59 },{ x: 28, y: 69 },{ x: 40, y: 81 },{ x: 48, y: 56 }];






var data = [ { x: 1910, y: 92228531 }, { x: 1920, y: 106021568 }, { x: 1930, y: 123202660 }, { x: 1940, y: 132165129 }, { x: 1950, y: 151325798 }, { x: 1960, y: 179323175 }, { x: 1970, y: 203211926 }, { x: 1980, y: 226545805 }, { x: 1990, y: 248709873 }, { x: 2000, y: 281421906 }, { x: 2010, y: 308745538 } ];
var graph = new Rickshaw.Graph( {
	element: document.querySelector("#chart"),
	width: 580,
	height: 250,
	series: [ {
		color: 'steelblue',
		data: data
	} ]
} );
graph.render();
</script>

</html>
