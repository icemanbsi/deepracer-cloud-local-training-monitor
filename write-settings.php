<?php 
$configFile = 'config.txt';
$handle = fopen($configFile, 'w') or die('Cannot open file:  '.$configFile);

$data_json["num_episodes_between_training"] = intval($_POST["num_episodes_between_training"]);
$data_json["robomaker_log_path"] = $_POST["robomaker_log_path"]);
$data_json["sagemaker_log_path"] = $_POST["sagemaker_log_path"];
$data_string = json_encode($data_json);
fwrite($handle, $data_string);
fclose($handle);

header("location: settings.php");