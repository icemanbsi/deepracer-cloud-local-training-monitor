<?php
$configFile = 'config.txt';
$handle = fopen($configFile, 'r') or die('Cannot open file:  '.$configFile);
$data_string = fread($handle,filesize($configFile));
$data_json = json_decode($data_string, true);	
fclose($handle);
?>
<html>
	<head>
		<title>DeepRacer - Local Training Monitor</title>
		<?php include("includes/header.php"); ?>
	</head>
	<body>
		<?php include("includes/navbar.php"); ?>

		<div class="container-fluid">
		  <div class="row">
			<?php 
				$activeMenu = "settings";
				include("includes/sidebar.php"); 
			?>

		    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

		      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		        <h1 class="h2">Settings</h1>
		      </div>

		      <div>
		      	<form action="write-settings.php" method="POST">
		      	  <h3>Training Settings</h3>
				  <div class="form-group">
				    <label for="txtEpisodes">Number of Episodes Between Training</label>
				    <input type="text" class="form-control" id="txtEpisodes" name="num_episodes_between_training" value="<?php echo $data_json["num_episodes_between_training"]; ?>"/>
				  </div>
				  <!-- <div class="form-group"> -->
				    <!-- <label for="txtTrack">Track</label> -->
				    <!-- <input type="text" class="form-control" id="txtTrack"/> -->
				  <!-- </div> -->
				  <h3>Log Settings</h3>
				  <div class="form-group">
				    <label for="txtRobomakerPath">Robomaker Log Path</label>
				    <input type="text" class="form-control" id="txtRobomakerPath" name="robomaker_log_path" value="<?php echo $data_json["robomaker_log_path"]; ?>"/>
				  </div>
				  <div class="form-group">
				    <label for="txtSagemakerPath">Sagemaker Log Path</label>
				    <input type="text" class="form-control" id="txtSagemakerPath" name="sagemaker_log_path" value="<?php echo $data_json["sagemaker_log_path"]; ?>"/>
				  </div>
				  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
				</form>
		      </div>

		    </main>
		  </div>
		</div>
	
	</body>
</html>