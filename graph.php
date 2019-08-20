<?php 
header("Content-type: image/png");
$type = $_GET["type"];
// if($type == "reward"){
	$graph = exec('python py/reward.py', $output);
// }
// else{

// }

if($output){
	print $output;
	// foreach($output as $key=>$value){
	//     if($key==1)
	//         print chr(0x0D); //Newline feed after PNG declaration
	//     if($key>0)
	//         print "\n";
	//     print $value;
	// }
}