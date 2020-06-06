<?php 
// header("Content-type: image/png");
$type = $_GET["type"];
if($type == "complete"){
// header('Location: py/reward.py'); 
	$graph = exec('python py/complete.py');
	$filename = "complete.png";
}
else{

}

// exec($r);
// sleep(3);
header('Content-Type: image/png');
readfile($filename);