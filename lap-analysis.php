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
				$activeMenu = "lap";
				include("includes/sidebar.php"); 
			?>

		    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

		      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		        <h1 class="h2">Lap Analysis</h1>
		      </div>

		      <div>
				  <?php
					$command = escapeshellcmd('python py/lap_analysis.py');
					$output = shell_exec($command);
					echo $output;				  
				  ?>
		      </div>

		    </main>
		  </div>
		</div>
	
	</body>
</html>