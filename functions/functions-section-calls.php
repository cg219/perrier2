<?php
/*
*
* setup to call specific theme items to keep the general build cleaner
*
*/

// event sidebar
function mbl_event_details($pid) { ?>

	<aside class="details">
            <h1>Event Details</h1>
            <p>
              <?php
                if (get_post_meta($pid, '_mbl_address_01', true)) print get_post_meta($pid, '_mbl_address_01', true)."<br>";
                if (get_post_meta($pid, '_mbl_address_02', true)) print get_post_meta($pid, '_mbl_address_02', true)."<br>";
                if (get_post_meta($pid, '_mbl_city', true)) print get_post_meta($pid, '_mbl_city', true)."<br>";
                if (get_post_meta($pid, '_mbl_state', true)) print get_post_meta($pid, '_mbl_state', true)."<br>";
                if (get_post_meta($pid, '_mbl_zip', true)) print get_post_meta($pid, '_mbl_zip', true)."<br>";

              $event_date = get_post_meta($pid, '_mbl_event_date', true);
              $event_time = get_post_meta($pid, '_mbl_event_time', true);

                if (!empty($event_date)) :
                    // event date conversions
                    $event_dstamp = !empty($event_date) ? strtotime($event_date) : false;
                    $event_dshow  = $event_dstamp !== false ? date('m.d.y', $event_dstamp) : '';
                    // event time conversions
                    $event_tstamp = !empty($event_time) ? strtotime($event_time) : false;
                    $event_tshow  = $event_tstamp !== false ? ' at '. date('g:i A', $event_tstamp) : '';
                    // display date and time
                    echo $event_dshow.$event_tshow.'<br />';
/*
                    $eventDate = strtotime(get_post_meta($pid, '_mbl_event_date', true));
                    $eventTime = strtotime(get_post_meta($pid, '_mbl_event_time', true));
                    print date('m.d.y', $eventDate).' at '.print date('g:i A', $eventTime).'<br>';
*/
                endif;
              ?>
              <a href="<?php print get_post_meta($pid, '_mbl_url', true);  ?>"><?php print get_post_meta($pid, '_mbl_url_label', true);  ?></a></p>
              <section class="events sidebarCalendar">
                <nav class="right">
                  <div id="calendar">
                    <?php mbl_calendar(); ?>
                  </div>
                </nav>
              </section>
          </aside>

<?php }


// hotspot sidebar
function mbl_hotspot_details($pid) { ?>

          <aside class="details">
            <h1>Hotspot Details</h1>
              <?php
                if (get_post_meta($pid, '_mbl_address_01', true)) print get_post_meta($pid, '_mbl_address_01', true)."<br>";
                if (get_post_meta($pid, '_mbl_address_02', true)) print get_post_meta($pid, '_mbl_address_02', true)."<br>";
                if (get_post_meta($pid, '_mbl_city', true)) print get_post_meta($pid, '_mbl_city', true)."<br>";
                if (get_post_meta($pid, '_mbl_state', true)) print get_post_meta($pid, '_mbl_state', true)."<br>";
                if (get_post_meta($pid, '_mbl_zip', true)) print get_post_meta($pid, '_mbl_zip', true)."<br>";
              ?>
              <a href="<?php print get_post_meta($pid, '_mbl_url', true);  ?>"><?php print get_post_meta($pid, '_mbl_url_label', true);  ?></a></p>
            <p class="view"><a href="<?php print $path ?>hotspots">See all Hot Spots</a></p>
          </aside>

<?php }

// mixology sidebar
function mbl_mixology_details($pid) {

	if (get_post_meta($pid, '_mbl_ingredients', true)) {
		?>
		<aside class="details">
            <h1>Ingredients</h1>
            <ul class="ingredients">

        	    <?php
                $ingredients = get_post_meta($pid, '_mbl_ingredients', true);
                foreach (explode("\n", $ingredients) as $item) { ?>
                    <li><?php print $item; ?></li>
                <?php } ?>
            </ul>
		</aside>
	<?php } else if (!empty($mix_meta) && 'post' == get_post_type($pid)) { ?>
		<aside class="details">
            <h1>Ingredients</h1>
            <ul class="ingredients">

                <?php
                $ingredients = get_post_meta($pid, '_mbl_ingredients', true);
				foreach (explode("\n", $ingredients) as $item) { ?>
					<li><?php print $item; ?></li>
				<?php } ?>
			</ul>
		</aside>

	<?php }

}
