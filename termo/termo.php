<html>

	<link href='../css/style.css' rel='stylesheet' type='text/css' />

	<script type='text/javascript' src='../Flotr2/flotr2.min.js'></script>
	<script type='text/javascript' src='../Flotr2/flotr2_box_plot.js'></script>
<body>
	<?php include("../include/header.php")?>
	<div id=grafico>
	<h2>Raspberry Pi - Monitoraggio temperatura</h2>
	<p>Dati aggiornati alle ore <?=date("H:i:s")?> del <?=date("d/m/Y")?></p>
	<br>
	<div id='chart' style='height: 400px ; width: 80%'/>


	<script language=javascript>

	var data = [], datarelay = [], dataest = [], options;

	<?php
	//if (!$_REQUEST['start'] && !$_REQUEST['end']) {
	$start=-300;
	$end=-1;
	//} else {
	//	$start=$_REQUEST['start'];
	//	$end=$_REQUEST['end'];
	//}
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

	for ($x=0;$x<=(abs($start)-1);$x++) {

		echo "data.push([" . $timestamp[$x] .", ". $termo[$x] . "]);\n";
		echo "datarelay.push([" . $timestamp[$x] .", ". ($rele[$x] * 10) . "]);\n";
		echo "dataest.push([" . $timestamp[$x] .", ". $temp_esterna[$x] . "]);\n";

}


//data = [{data:d1, label: "Temp Interna"}, {data:d2,label:"Riscaldamento"},{data:d6, label: "Temperatura impostata"},{data:d7, label: "Simulazione termostato"}];
//data = [{data:d1,label:"Temperatura"},{data:d3, label: "Temperatura impostata"},{data:d4, label: "Simulazione termostato"}];
//data = [{data:d1, label: "Temp. esterna"}, {data:d2,label:"Riscaldamento"},{data:d3,label:"Temperatura primo piano"},{data:d4, label: "Temperatura 2"},{data:d5, label: "Temperatura 3"},{data:d6, label: "Temperatura impostata"}];

//echo "data";
?>

options = {
    grid: {
        //minorVerticalLines: true,
	//horizontalLines: true,
	//minorHorizontalLines: true,

    },
    //mouse: {track: true, relative: true},
    mouse: {
        track: true,
        //trackAll : true,
        relative: true,
        trackFormatter: function(point) {
            var xval = new Date(Number(point.x) * 1000);
            // should look into momentjs library (http://momentjs.com/) for some date functions
            return xval.getHours().toString() + ":" + xval.getMinutes() + ", " + point.y.toString();
        }
    },
    xaxis: {
        title: "Ora",
        mode: 'time',
        timeFormat: "%H:%M",
        timeUnit: 'second',
        timeMode:'locale',
        labelsAngle: 45,
        showLabels: true,
        showMinorLabels: true,
	minorTickFreq: 1000
    },
    yaxis: {min: 0, max:25,title: "Temperatura", minorTickFreq: 100},
    spreadsheet: {
    	show:true},
	HtmlText: false,
        colors: ['#0000ff', '#ff0000' , '#ffa500'],

    },

//alert(dataest.toString());
container = document.getElementById("chart")
graph = Flotr.draw(
	container,  // Container element
	 [{data : data, label : "Temp"}, {data: datarelay, lines : { fill : true }, label : "Relè"}, {data: dataest, lines : { fill : true }, label: "Temp Est"}],
	options     // Configuration options
);



</script>


</div>
<br></br>

<h2>Temp: <?php echo $termo[(abs($start))-1] ?>°C</h2>

</body>
</html>
