<?php 
// header("Content-type: image/png");
$type = $_GET["type"];
// if($type == "reward"){
// header('Location: py/reward.py'); 
	$graph = exec('python py/reward.py');
// }
// else{

// }

// exec($r);
// sleep(3);
header('Content-Type: image/png');
readfile("image.png");