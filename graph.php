<?php 
// header("Content-type: image/png");
$type = $_GET["type"];
// if($type == "reward"){
// header('Location: py/reward.py'); 
	// $graph = exec('python py/reward.py');
// }
// else{

// }

// exec($r);
// sleep(3);
header('Content-Type: image/png');
readfile("reward.png");

// if($output){
	// print $output;
	// foreach($output as $key=>$value){
	//     if($key==1)
	//         print chr(0x0D); //Newline feed after PNG declaration
	//     if($key>0)
	//         print "\n";
	//     print $value;
	// }
// }