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
					<?
						if($cities = $_POST["hotspots"]){
							if($cities != "ALL")
								$queryCities = explode(",", $cities);
								$selectName = count($queryCities) > 1 ? "MULTIPLE" : $cities;
								$_POST["hotspots"] = null;
								$_POST["hotspots"] = implode(",", $queryCities);
					?>
					<a id="hotspot-toggle" href="#" data-toggle="dropdown" class="dropdown-toggle"><? echo $selectName; ?></a>
					<?
						}
						else if(get_query_var("city")){
							$tax = get_term_by("slug", get_query_var("city"), "city");
					?>
					<a id="hotspot-toggle" href="#" data-toggle="dropdown" class="dropdown-toggle"><? echo $tax->name; ?></a>
					<?
						}
						else{
							$taxes = kreate_get_cities();
							if(count($taxes) > 1) :
					?>
					<a id="hotspot-toggle" href="#" data-toggle="dropdown" class="dropdown-toggle">MULTIPLE</a>
					<?
							else:
					?>
					<a id="hotspot-toggle" href="#" data-toggle="dropdown" class="dropdown-toggle"><? echo $taxes[0]->name; ?></a>
					<?
							endif;
						}
					?>

					<ul class="dropdown-menu" role="menu">
						<li role="presentation"><a href="#">ALL</a></li>
						<?
							$allcities = kreate_get_all_cities();
							foreach($allcities as $cities) :
								foreach($cities as $city) :
						?>
						<li><a href="#"><? echo $city->name; ?></a></li>
							<? endforeach; ?>
						<? endforeach; ?>
					</ul>
				</div>
				<a href="#" class="goButton">GO</a>
				<form method="post" action="" role="form">
					<input type="hidden" name="hotspots" value="">
				</form>
			</div>
			<? include( locate_template("loop-hotspot.php")); ?>
			
			<div class="loader row"><img src="<? echo theme_uri; ?>/assets/images/loader.gif" alt=""></div>
		</div>
		<? get_sidebar(); ?>
	</div>
	<? get_footer(); ?>