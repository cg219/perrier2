<?
	if(isset($_POST["kreate-hotspot-refresh"])):
		kreate_create_hotspot_list();
?>
	<div class="alert alert-dismissable alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Hotspot Cache Updated!</strong>
	</div>
<?
	endif;
?>

<div class="container">
	<h2>Data Cleanse</h2>
	<form action="" role="form" method="post">
		<button type="submit" class="btn btn-primary">Refresh Cached Hotspots</button>
		<input type="hidden" name="kreate-hotspot-refresh" value="true" />
	</form>
</div>