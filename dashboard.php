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
				$activeMenu = "dashboard";
				include("includes/sidebar.php"); 
			?>

		    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

		      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		        <h1 class="h2">Dashboard</h1>
		      </div>

		      <div>
		      	<img alt="complete graph" src="graph.php?type=complete" style="width: 100%;"/>
		      </div>

		    </main>
		  </div>
		</div>
	
	</body>
</html>