<html>
	<head>
		<title>DeepRacer - Local Training Monitor</title>
		<?php include("includes/header.php"); ?>
		<link rel="stylesheet" href="assets/codemirror/lib/codemirror.css">
		<link rel="stylesheet" href="assets/codemirror/addon/fold/foldgutter.css">
		<link rel="stylesheet" href="assets/codemirror/addon/dialog/dialog.css">
		<link rel="stylesheet" href="assets/codemirror/theme/monokai.css">

		<script src="assets/codemirror/lib/codemirror.js"></script>
		<script src="assets/codemirror/addon/search/searchcursor.js"></script>
		<script src="assets/codemirror/addon/search/search.js"></script>
		<script src="assets/codemirror/addon/dialog/dialog.js"></script>
		<script src="assets/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="assets/codemirror/addon/edit/closebrackets.js"></script>
		<script src="assets/codemirror/addon/comment/comment.js"></script>
		<script src="assets/codemirror/addon/wrap/hardwrap.js"></script>
		<script src="assets/codemirror/addon/fold/foldcode.js"></script>
		<script src="assets/codemirror/addon/fold/brace-fold.js"></script>
		<script src="assets/codemirror/mode/python/python.js"></script>
		<script src="assets/codemirror/keymap/sublime.js"></script>
		<style>
		.CodeMirror {border-top: 1px solid #eee; border-bottom: 1px solid #eee; line-height: 1.3; height: 500px; font-size: 14px;}
		.CodeMirror-linenumbers { padding: 0 8px; }
		</style>

	</head>
	<body>
		<?php include("includes/navbar.php"); ?>

		<div class="container-fluid">
		  <div class="row">
			<?php 
				$activeMenu = "training";
				include("includes/sidebar.php"); 
			?>

		    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

		      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		        <h1 class="h2">Training</h1>
		      </div>

			  <div class="alert alert-primary" role="alert">
				<div class="row">
					<div class="col-sm-12">
						Training Status running for x hours / minutes
					</div>
					<div class="col-sm-12">
						button stop training
					</div>
				</div>
			  </div>
			  
			  <div class="accordion" id="accordionExample">
				<div class="card">
					<div class="card-header" id="headingOne">
					<h2 class="mb-0">
						<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Reward Function
						</button>
					</h2>
					</div>

					<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">
						<article></article>
					</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingTwo">
					<h2 class="mb-0">
						<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						Collapsible Group Item #2
						</button>
					</h2>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
					<div class="card-body">
						Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
					</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingThree">
					<h2 class="mb-0">
						<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						Collapsible Group Item #3
						</button>
					</h2>
					</div>
					<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
					<div class="card-body">
						Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
					</div>
					</div>
				</div>
				</div>


		    </main>
		  </div>
		</div>
	
	<script>
		var editor = CodeMirror(document.body.getElementsByTagName("article")[0], {
			value: '',
			lineNumbers: true,
			mode: "python",
			keyMap: "sublime",
			autoCloseBrackets: true,
			matchBrackets: true,
			showCursorWhenSelecting: true,
			theme: "monokai",
			tabSize: 2
		});
	</script>
	</body>
</html>