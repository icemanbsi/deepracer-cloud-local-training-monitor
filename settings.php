<html>
	<head>
		<title>DeepRacer - Local Training Monitor</title>
		<?php include("includes/header.php"); ?>
	</head>
	<body>
		<?php include("includes/navbar.php"); ?>

		<div class="container-fluid">
		  <div class="row">
			<?php include("includes/sidebar.php"); ?>		    

		    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

		      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		        <h1 class="h2">Settings</h1>
		      </div>

		      <div>
		      	<form>
				  <div class="form-group">
				    <label for="txtEpisodes">Number of Episodes Between Training</label>
				    <input type="text" class="form-control" id="txtEpisodes"/>
				  </div>
				  <div class="form-group">
				    <label for="txtRobomakerPath">Robomaker Log Path</label>
				    <input type="text" class="form-control" id="txtRobomakerPath"/>
				  </div>
				  <div class="form-group">
				    <label for="txtSagemakerPath">Sagemaker Log Path</label>
				    <input type="text" class="form-control" id="txtSagemakerPath"/>
				  </div>
				  <button type="submit" class="btn btn-primary">Submit</button>
				</form>
		      </div>

		    </main>
		  </div>
		</div>
	
	</body>
</html>