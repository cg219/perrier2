<?
	$paged = get_query_var("paged") ? get_query_var("paged") : 1;
	$blogs = kreate_get_blogs();
	$amount = 10;

	$query = kreate_get_hotspot_list();
	// print_r($query);
	$i = ($paged-1) * $amount;
	$limit = $i + 10;

	if($queryCities){
		$hotspotTaxes = array();

		foreach($queryCities as $qc){
			$hotspotTaxes[] = $qc;
		}
	}
	else if( $tax ){
		print_r(array("tax" => $tax));
		$hotspotTaxes = array(
			$tax->name
		);
	}
	else if($taxes){
		$hotspotTaxes = array();

		foreach($taxes as $singleTax){
			$hotspotTaxes[] = $singleTax->name;
		}
	}

	if( $hotspotTaxes ) :
		$temp = array();
		foreach($query as $hs):
			if(in_array($hs->city->name, $hotspotTaxes)):
				$temp[] = $hs;
			endif;
		endforeach;
		$query = $temp;
	endif;

	usort($query, function($a, $b){
        if( $a->post_title == $b->post_title ) return 0;

        return ($a->post_title < $b->post_title) ? -1 : 1;
    });

	for( $i; $i < $limit; $i++ ):
		global $blog_id;
		$post = $query[$i];
		$cities = $post->city->name;

		if($post->blog_id != $blog_id) :
			switch_to_blog($post->blog_id);
			$blog_switched = true;
		endif;

		if( $hotspotTaxes ) :
			if( in_array($cities, $hotspotTaxes) ) :
				include( locate_template("content-hotspot.php"));
			endif;
		else :
			include( locate_template("content-hotspot.php"));
		endif;
		if( $blog_switched ) :
			restore_current_blog();
			$blog_switched = false;
		endif;
	endfor;
?>
<? if($query[$limit + 1]): ?>
<div class="nextPostLink"><a href="<? echo get_post_type_archive_link("hotspot"); ?>page/<? echo $paged + 1; ?>"></a></div>
<? endif; ?>