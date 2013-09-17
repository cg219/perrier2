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
			$interests = array();

			foreach($terms as $term){
				$obj = new stdClass();
				$obj->type = "term";
				$obj->value = $term;
				$interests[$term->name] = $obj;
			}

			foreach($types as $type){
				$obj = new stdClass();
				$obj->type = "type";
				$obj->value = get_post_type_object($type);
				$interests[$obj->value->labels->name] = $obj;
			}

			$final = array();
			$final[] = $interests["Art"];
			$final[] = $interests["Music"];
			$final[] = $interests["Fashion"];
			$final[] = $interests["Nightlife"];
			$final[] = $interests["Cocktail Culture"];
			$final[] = $interests["Travel"];
			$final[] = $interests["Hotspots"];
			$final[] = $interests["Mixology"];
			$final[] = $interests["Luminary"];
			$final[] = $interests["Audio"];
			$final[] = $interests["Videos"];

			// print_r($final);

			foreach($final as $interest) :
				if($interest->type == "term") :
		?>
			<li><a href="<? echo get_term_link($interest->value); ?>" role="menuitem" tabindex="-1"><? echo $interest->value->name; ?></a></li>
		<?
				else:
		?>
			<li><a href="<? echo get_post_type_archive_link($interest->value); ?>" role="menuitem" tabindex="-1"><? echo $interest->value->labels->name; ?></a></li>
		<? 
				endif;
			endforeach;
		?>
		</ul>
	</div>
</div>