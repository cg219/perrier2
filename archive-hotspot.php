<? 
	get_template_part("consts");
	get_header();
?>
<body>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container wrap">
			<? get_template_part("nav"); ?>
		</div>
	</div>
	<div class="div wrap" id="wrapper">
		<div class="container" id="main">
			<div class="row" id="hotspot-navbar">
				<h5>Hotspots</h5>
				<div class="dropdown pull-right">
					<a id="hotspot-toggle" href="#" data-toggle="dropdown" class="dropdown-toggle">ALL</a>

					<ul class="dropdown-menu" role="menu">
						<?
							if($cities = $_POST["hotspots"]){
								if($cities != "ALL")
									$queryCities = explode(",", $cities);
									$_POST["hotspots"] = null;
									$_POST["hotspots"] = implode(",", $queryCities);
							}
						?>
						<li role="presentation"><a href="#">ALL</a></li>
						<?
							$cities = get_terms("city");

							foreach($cities as $city) :
						?>
						<li><a href="#"><? echo $city->name; ?></a></li>
						<? endforeach; ?>
					</ul>
				</div>
				<a href="#" class="goButton">GO</a>
				<form method="post" action="" role="form">
					<input type="hidden" name="hotspots" value="">
				</form>
			</div>
			<? include( locate_template("loop-hotspot.php")); ?>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>