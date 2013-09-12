<div class="container" id="sidebar">
	<div class="widget">
		<h5 class="title">Locations</h5>
		<ul>
		<?
			// $menuArgs = array(
			// 	"menu" => "Locations menu"
			// );

			$menuName = "location-menu";
			$menuLocations = get_nav_menu_locations();
			$menu = wp_get_nav_menu_object( $menuLocations[$menuName] );
			$items = wp_get_nav_menu_items($menu->term_id);

			// wp_nav_menu($menuArgs);
			// print_r($items);
			$creatingSubmenus = false;
			$menuStarted = false;

			for( $i=0; $i < count($items); $i++ ) :
				$currentID = ($items[$i]->menu_item_parent == 0) ? 0 : $items[$i]->ID;

				if( $currentID == 0 && $creatingSubmenus == false ) :
		?>
			<li class="dropdown" role="menuitem" tabindex="-1">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><? echo $items[$i]->title?></a><span class="right-caret"></span>
				<ul class="dropdown-menu rightMenu pull-right">
		<? 	
				elseif( $currentID == 0 && ($creatingSubmenus == true || $menuStarted == true)) :
					$creatingSubmenus = false;
		?>
			</ul></li>
			<li class="dropdown" role="menuitem" tabindex="-1">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><? echo $items[$i]->title?></a><span class="right-caret"></span>
				<ul class="dropdown-menu rightMenu pull-right">
		<?
				else:
				$creatingSubmenus = true;
		?>
			<li><a href="<? echo $items[$i]->url?>" role="menuitem" tabindex="-1"><? echo $items[$i]->title?></a></li>
		<?
				endif;

				if( $i == count($items) - 1) :
		?>
			</ul></li>
		<?
				endif;
			$menuStarted = true;
			endfor;
		?>
		</ul>
	</div>

	<div class="widget">
		<h5 class="title">Interests</h5>
		<ul>
		<?
			$termArgs = array(
				"type" => array("post"),
				"orderby" => "name"
			);

			$typeArgs = array(
				"_builtin" => false
			);

			$terms = get_terms("primary_category", $termArgs);
			$types = get_post_types($typeArgs, "names");

			for( $i = 0; $i < count($terms); $i++) :
		?>
			<li><a href="<? echo get_term_link($terms[$i]); ?>" role="menuitem" tabindex="-1"><? echo $terms[$i]->name; ?></a></li>
		<?
			endfor;
			foreach( $types as $type ) :
				if($type == "staff") continue;
		?>
			<li><a href="<? echo get_post_type_archive_link($type); ?>" role="menuitem" tabindex="-1">
				<? 
					$obj = get_post_type_object($type);
					echo $obj->labels->name;
				?>
			</a></li>
		<? endforeach; ?>
		</ul>
	</div>
</div>