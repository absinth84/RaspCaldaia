<html>
<head>

    <script src=../lib/jquery.min.js></script>
    <script src=../lib/rangeslider.min.js></script>
    <link href='../lib/rangeslider.css' rel='stylesheet' type='text/css' />
    <link href='../css/style.css' rel='stylesheet' type='text/css' />
</head>



<?php include("../include/header.php")?>

<?php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_NONE);
$t_min_notte = $redis->get('t_min_notte');
$t_max_notte = $redis->get('t_max_notte');
$t_min_giorno = $redis->get('t_min_giorno');
$t_max_giorno = $redis->get('t_max_giorno');
?>
<body style="text-align: center">
    <div align=center style="width: 100%">
        <h2>Regolazione temperature termostato</h2>
        <form name=primo action=imposta_temperature.php>
            <table style="width: 70%; border: 2px solid" >
                <tr>
                    <td rowspan=2 style="text-align:center; vertical-align: middle">
                        <img src=termometro.png>
                    </td>
                    <td>
                        <h3>Temperatura della notte</h3>
                        Impostazioni attuali:
                        <div>min: <?=$t_min_notte?>, max: <?=$t_max_notte?>, media: <?=(($t_min_notte+$t_max_notte)/2)?></div>
                        <input id="one" type="range" min="14" max="23" step=".25" style="text-align:center; vertical-align: middle" name="t_notte" value="<?=(($t_min_notte+$t_max_notte)/2)?>" />
                        <div id="output" style="font-size: 30px; font-weight: bold; color: blue; ">Temperatura notte: <tnotte></tnotte></div>

                    </td></tr>
                    <tr><td>
                        <h3>Temperatura del giorno</h3>
                        <div>min: <?=$t_min_giorno?>, max: <?=$t_max_giorno?>, media: <?=(($t_min_giorno+$t_max_giorno)/2)?></div>
                        <input id="two" type="range" min="14" max="23" step=".25" style="text-align:center; vertical-align: middle" name="t_giorno" value="<?=(($t_min_giorno+$t_max_giorno)/2)?>" />
                        <div id="dos" style="font-size: 30px; font-weight: bold; color: red; ">Temperatura giorno: <tgiorno></tgiorno></div>
                    </td>
                </tr>
                <tr>
                    <td colspan=2 align="center" >
                        <input type=submit value=Imposta class="button-style" align="center" style="height:50px; width:300px" >
                    </td>
                </tr>
            </table>
        </div>
        <br>
    </form>
</body>

<script>
var $element = $('input[name="t_giorno"]');
var $element2 = $('input[name="t_notte"]');
var $tgiorno = $('tgiorno');
var $tnotte = $('tnotte');

function updateOutput(el, val) {
    el.textContent = val;
}

$element
.rangeslider({
    polyfill: false,
    onInit: function() {
        updateOutput($tgiorno[0], this.value);
    }
})
.on('input', function() {
    updateOutput($tgiorno[0], this.value);
});

$element2
.rangeslider({
    polyfill: false,
    onInit: function() {
        updateOutput($tnotte[0], this.value);
    }
})
.on('input', function() {
    updateOutput($tnotte[0], this.value);
});

</script>
