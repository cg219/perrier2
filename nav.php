<div class="navbar-header">
	<a id="topNavLogo" href="/" class="navbar-brand"><img src="<? echo theme_uri; ?>/assets/images/logo.png" alt=""></a>
</div>
<ul id="topNav" class="nav navbar-nav">
	<li class="dropdown">
		<a id="nightlifeLink" href="#" class="dropdown-toggle" data-toggle="dropdown">The Source Of Nightlife &amp; Culture <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li>
				<div class="row" id="aboutDropdown">
					<div class="col-lg-2">
						<img class="pull-left" src="<? echo theme_uri; ?>/assets/images/bottle.png" alt="">
					</div>
					<div class="col-lg-10">
						<h5>About Socete Perrier</h5>
						<p>Société Perrier is the global enthusiast's source for engaging content and great events. Curating the best in nightlife, art, music, fashion, travel, mixology and cocktail culture, Société Perrier is the trusted arbiter of what's hot around the world. When you see the Société Perrier seal, you know you are in the right place.</p>
						<ul class="nav" id="aboutLinks">
							<li><a href="#">RSS</a></li>
							<li><a href="<? echo get_page_link(get_page_by_title("About")->ID) ?>">About Us</a></li>
							<li><a href="#">Staff</a></li>
							<li><a href="<? echo get_page_link(get_page_by_title("Countact Us")->ID) ?>">Contact</a></li>
							<li><a href="<? echo get_page_link(get_page_by_title("Privacy Policy")->ID) ?>">Privacy</a></li>
							<li><a href="<? echo get_page_link(get_page_by_title("Terms of Use")->ID) ?>">Terms of Use</a></li>
							<li><a href="http://perrier.com">Perrier.com</a></li>
						</ul>
						<p id="copy">&copy; 2013 Mirrorball Group LLC — All rights reserved<br/>The website Société Perrier is run and controlled by Mirrorball. Perrier is a registered trademark of Nestlé Waters France; Mirrorball is authorized to use the trademark on this website.</p>
					</div>
				</div>
			</li>
		</ul>
	</li>
	<li class="divider"></li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">NOW TRENDING <span class="caret"></span></a>
		<ul id="trending" class="dropdown-menu" >
			<?
				$top_links = get_trending_global();

				foreach($top_links as $link) :
					$title = strstr($link, "articles/", false);
					$title = substr($title, strlen("articles/"));
					$title = explode("-", $title);
					$title = ucwords(implode(" ", $title));
					$title = substr($title, 0, strlen($title) - 1);
					// print_r($title);
			?>
			<li><a href="<? echo $link; ?>"><? echo $title; ?></a></li>
			<? endforeach; ?>
		</ul>
	</li>
	<li class="divider"></li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">SIGN UP FOR THE NEWSLETTER <span class="caret"></span></a>
		<ul class="dropdown-menu pull-right" id="newsLetter">
			<li>
				<form action="" class="form-inline" role="form" id="newsletterForm">
					<div class="row">
						<div class="col-lg-5">
							<input type="text" class="form-control" placeholder="Name* *" name="full_name">
						</div>
						<div class="col-lg-2">
							<input type="text" class="form-control" placeholder="Age *" name="age">
						</div>
						<div class="col-lg-5">
							<input type="text" class="form-control" placeholder="Email *" name="email_address">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<input type="text" class="form-control" placeholder="City *" name="city">
						</div>
						<div class="col-lg-6">
							<input type="text" class="form-control" placeholder="State/Province/Region" name="state">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6" id="country">
							<select type="text" class="form-control" placeholder="Country *" name="country">
								<option value="1">1</option>
								<option value="1">1</option>
								<option value="1">1</option>
								<option value="1">1</option>
								<option value="1">1</option>
								<option value="1">1</option>
								<option value="1">1</option>
								<option value="1">1</option>
								<option value="1">1</option>
								<option value="1">1</option>
							</select>
						</div>
						<div class="col-lg-6">
							<div class="checkbox">
								<label for="">
								<input type="checkbox">
									Global Newsletter
								</label>
							</div>
							<div class="checkbox">
								<label for="">
								<input type="checkbox">
									Mixology by Perrier
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<button class="btn btn-primary">SUBMIT</button>
					</div>
				</form>
			</li>
		</ul>
	</li>
	<li class="divider"></li>
	<? //$options = get_option("plugin_options"); ?>
	<?// $social = $options["facebook"]; ?>
	<? $social = "#"; ?>
	<li><a class="socialicon first" href="<? echo $social; ?>"><img src="<? echo theme_uri; ?>/assets/images/fb.png" alt=""></a></li>
	<? //$social = $options["twitter"]; ?>
	<li><a class="socialicon" href="<? echo $social; ?>"><img src="<? echo theme_uri; ?>/assets/images/twitter.png" alt=""></a></li>
	<? //$social = $options["instagram"]; ?>
	<li><a class="socialicon" href="<? echo $social; ?>"><img src="<? echo theme_uri; ?>/assets/images/ig.png" alt=""></a></li>
	<? //$social = $options["youtube"]; ?>
	<li><a class="socialicon" href="<? echo $social; ?>"><img src="<? echo theme_uri; ?>/assets/images/yt.png" alt=""></a></li>
	<li class="divider"></li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle socialicon search" data-toggle="dropdown"><img src="<? echo theme_uri; ?>/assets/images/search.png" alt=""></a>
		<ul class="dropdown-menu pull-right">
			<li>
				<form id="searchForm" action="" role="form">
					<input type="search" class="form-control input-sm" placeholder="Search" name="s" value="<? echo get_search_query(); ?>">
				</form>
				<? //Multisite_Global_Search::ms_global_search_perrier_form("search.php", null, null); ?>
			</li>
		</ul>
	</li>
</ul>