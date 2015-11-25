<?php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_NONE);
?>
<html>
<head><
    <script src=../lib/html5slider.js>
    </script>
    <link href='../css/style.css' rel='stylesheet' type='text/css' />
</head>
<?php include("../include/header.php")?>
<div align="center" style="width: 100%">
<h2>Programmazione settimanale</h2>
<form name=uno action=salva_prog.php method=post>
<table border=2 cellpadding=0 cellspacing=0 width=100%>
<tr><td></td>
<?php
$giorni=array("vuoto","lun","mar","mer","gio","ven","sab","dom");
for ($ora=0 ; $ora<=23 ; $ora++) {

    echo '<th width="4%">' .$ora. ' </th>';
  } ?>
</tr>
<?php
for ($giorno=1 ; $giorno<=7 ; $giorno++) {
    $prog_giorno= $redis->lRange($giorni[$giorno], -24, -1);
    //print_r($prog_giorno);
    ?>
    <tr>
        <td width="4%"><?=$giorni[$giorno]?></td>
        <?php
        for ($ora=0 ; $ora<=23 ; $ora++) {
            ?>
            <td class=compatta>
                <select name="<?=$giorno?>_<?=$ora?>">
                    <option style="background-color: #0000FF; color: white;" <?php if ($prog_giorno[$ora]=='N') echo "selected"?>>N</option>
                    <option style="background-color: red; color: white;" <?php if ($prog_giorno[$ora]=='G') echo "selected"?>>G</option>
                    <option style="background-color: #CCCCCC; color: black;" <?php if ($prog_giorno[$ora]=='S') echo "selected"?>>S</option>
                </select>
            </td>
            <?php
        }
        ?>
    </tr>
    <?php
}
?>
<tr><td colspan=25>
    <input type=submit value="Salva programmazione">
    <br>
    <a href=../>Torna alla home page</a>
</td></tr>
</table>
</form>
</div>
</body>
</html>
