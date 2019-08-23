<?php 
// header("Content-type: image/png");
$type = $_GET["type"];
if($type == "reward"){
// header('Location: py/reward.py'); 
	$graph = exec('python py/reward.py');
	$filename = "image.png";
}
else if($type == "entropy"){
// header('Location: py/reward.py'); 
	$graph = exec('python py/entropy.py');
	$filename = "entropy.png";
}
else if($type == "complete"){
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