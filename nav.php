<div class="navbar-header">
	<a id="topNavLogo" href="/" class="navbar-brand"><img src="<? echo theme_uri; ?>/assets/images/logo.png" alt=""></a>
</div>
<ul id="topNav" class="nav navbar-nav">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">THE SOURCE OF NIGHTLIFE &amp; CULTURE <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li><a href="#">Houwdy</a></li>
			<li><a href="#">Houwdy</a></li>
			<li><a href="#">Houwdy</a></li>
			<li><a href="#">Houwdy</a></li>
		</ul>
	</li>
	<li class="divider"></li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">NOW TRENDING <span class="caret"></span></a>
		<ul class="dropdown-menu" >
			<li><a href="#">Houwdy</a></li>
			<li><a href="#">Houwdy</a></li>
			<li><a href="#">Houwdy</a></li>
		</ul>
	</li>
	<li class="divider"></li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">SIGN UP FOR THE NEWSLETTER <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li><a href="#">Houwdy</a></li>
			<li><a href="#">Houwdy</a></li>
			<li><a href="#">Houwdy</a></li>
			<li><a href="#">Houwdy</a></li>
			<li><a href="#">Houwdy</a></li>
		</ul>
	</li>
	<li class="divider"></li>
	<? $social = get_option("plugin_options")["facebook"]; ?>
	<li><a class="socialicon first" href="<? echo $social; ?>"><img src="<? echo theme_uri; ?>/assets/images/fb.png" alt=""></a></li>
	<? $social = get_option("plugin_options")["twitter"]; ?>
	<li><a class="socialicon" href="<? echo $social; ?>"><img src="<? echo theme_uri; ?>/assets/images/twitter.png" alt=""></a></li>
	<? $social = get_option("plugin_options")["instagram"]; ?>
	<li><a class="socialicon" href="<? echo $social; ?>"><img src="<? echo theme_uri; ?>/assets/images/ig.png" alt=""></a></li>
	<? $social = get_option("plugin_options")["youtube"]; ?>
	<li><a class="socialicon" href="<? echo $social; ?>"><img src="<? echo theme_uri; ?>/assets/images/yt.png" alt=""></a></li>
	<li class="divider"></li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle socialicon search" data-toggle="dropdown"><img src="<? echo theme_uri; ?>/assets/images/search.png" alt=""></a>
		<ul class="dropdown-menu">
			<li><a href="#">Houwdy</a></li>
		</ul>
	</li>
</ul>