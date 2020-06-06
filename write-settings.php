<?php 
$configFile = 'config.txt';
echo "opening file <br/>";
$handle = fopen($configFile, 'w') or die('Cannot open file:  '.$configFile);
echo "file opened <br/>";
$data_json["num_episodes_between_training"] = intval($_POST["num_episodes_between_training"]);
$data_json["num_epoch"] = intval($_POST["num_epoch"]);

$data_json["robomaker_log_path"] = $_POST["robomaker_log_path"];
$data_json["sagemaker_log_path"] = $_POST["sagemaker_log_path"];

$data_json["track"] = $_POST["track"];

$data_string = json_encode($data_json);
echo "writing file <br/>";
fwrite($handle, $data_string);
echo "writing success <br/>";
fclose($handle);
echo "file saved <br/>";

header("location: settings.php");