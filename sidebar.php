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
				$currentID = $items[$i]->ID;
				$isTopLevel = $items[$i]->menu_item_parent == 0 ? true : false;
				$isLastItem = $items[$i + 1] ? false : true;
				$currentTopLevel = $i == 0 ? $currentID : $currentTopLevel;
				
				if($isTopLevel && !$isLastItem) :
					$currentTopLevel = $currentID;
					if($items[$i +1]->menu_item_parent == $currentTopLevel) :
		?>
			<li class="dropdown" role="menuitem" tabindex="-1">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><? echo $items[$i]->title?></a><span class="right-caret"></span>
				<ul class="dropdown-menu rightMenu pull-right">
		<? 	
					else :
		?>
			<li role="menuitem"><a href="#"><? echo $items[$i]->title?></a></li>
		<?
					endif;
				elseif(!$isTopLevel) :
					if($items[$i +1]->menu_item_parent == $currentTopLevel) :
		?>
			<li role="menuitem"><a href="#"><? echo $items[$i]->title?></a></li>
		<?
					else:
		?>
			<li role="menuitem"><a href="#"><? echo $items[$i]->title?></a></li></ul>
		<?
					endif;
				endif;
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