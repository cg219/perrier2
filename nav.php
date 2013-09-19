<div id="siteheader" class="navbar navbar-inverse navbar-fixed-top">
	<div class="container wrap">
		<div class="navbar-header">
			<a id="topNavLogo" href="/" class="navbar-brand"><img src="<? echo theme_uri; ?>/assets/images/logo.png" alt=""></a>
		</div>
		<ul id="topNav" class="nav navbar-nav">
			<li class="dropdown">
				<a target="_blank" id="nightlifeLink" href="#" class="dropdown-toggle" data-toggle="dropdown">The Source for Nightlife &amp; Culture <span class="caret"></span></a>
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
									<li><a target="_blank" href="<? echo get_bloginfo("rss2_url"); ?>">RSS</a></li>
									<li><a target="_blank" href="<? echo get_page_link(get_page_by_title("About")->ID) ?>">About Us</a></li>
									<li><a target="_blank" href="<? echo get_page_link(get_page_by_title("Contact Us")->ID) ?>">Contact</a></li>
									<li><a target="_blank" href="<? echo get_page_link(get_page_by_title("Privacy Policy")->ID) ?>">Privacy</a></li>
									<li><a target="_blank" href="<? echo get_page_link(get_page_by_title("Terms of Use")->ID) ?>">Terms of Use</a></li>
									<li><a target="_blank" href="http://perrier.com">Perrier.com</a></li>
								</ul>
								<p id="copy">&copy; 2013 Mirrorball Group LLC — All rights reserved<br/>The website Société Perrier is run and controlled by Mirrorball. Perrier is a registered trademark of Nestlé Waters France; Mirrorball is authorized to use the trademark on this website.</p>
							</div>
						</div>
					</li>
				</ul>
			</li>
			<li class="divider"></li>
			<li class="dropdown">
				<a target="_blank" href="#" class="dropdown-toggle" data-toggle="dropdown">NOW TRENDING <span class="caret"></span></a>
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
					<li><a target="_blank" href="<? echo $link; ?>"><? echo $title; ?></a></li>
					<? endforeach; ?>
				</ul>
			</li>
			<li class="divider"></li>
			<li class="dropdown">
				<a target="_blank" href="#" class="dropdown-toggle" data-toggle="dropdown">SIGN UP FOR THE NEWSLETTER <span class="caret"></span></a>
				<ul class="dropdown-menu pull-right" id="newsLetter">
					<li>
						<form action="<? echo theme_uri; ?>/kreate/pages/signup.php" class="form-inline" role="form" id="newsletterForm">
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
										<option value="CA">Canada</option>
							      			<option value="MX">Mexico</option>
							                <option value="GB">United Kingdom</option>
							   	     		<option value="US">United States</option>
							                <option value="RU">Russian Federation</option>
							                <option value="">-</option>
							                <option value="AF">Afghanistan</option>
							                <option value="AL">Albania</option>
							                <option value="DZ">Algeria</option>
							                <option value="AS">American Samoa</option>
							                <option value="AD">Andorra</option>
							                <option value="AO">Angola</option>
							                <option value="AI">Anguilla</option>
							                <option value="AQ">Antarctica</option>
							                <option value="AG">Antigua and Barbuda</option>
							                <option value="AR">Argentina</option>
							                <option value="AM">Armenia</option>
							                <option value="AW">Aruba</option>
							                <option value="AU">Australia</option>
							                <option value="AT">Austria</option>
							                <option value="AZ">Azerbaidjan</option>
							                <option value="BS">Bahamas</option>
							                <option value="BH">Bahrain</option>
							                <option value="BD">Bangladesh</option>
							                <option value="BB">Barbados</option>
							                <option value="BY">Belarus</option>
							                <option value="BE">Belgium</option>
							                <option value="BZ">Belize</option>
							                <option value="BJ">Benin</option>
							                <option value="BM">Bermuda</option>
							                <option value="BT">Bhutan</option>
							                <option value="BO">Bolivia</option>
							                <option value="BA">Bosnia-Herzegovina</option>
							                <option value="BW">Botswana</option>
							                <option value="BV">Bouvet Island</option>
							                <option value="BR">Brazil</option>
							                <option value="IO">British Indian Ocean Territory</option>
							                <option value="BN">Brunei Darussalam</option>
							                <option value="BG">Bulgaria</option>
							                <option value="BF">Burkina Faso</option>
							                <option value="BI">Burundi</option>
							                <option value="KH">Cambodia</option>
							                <option value="CM">Cameroon</option>
							                <option value="CV">Cape Verde</option>
							                <option value="KY">Cayman Islands</option>
							                <option value="CF">Central African Republic</option>
							                <option value="TD">Chad</option>
							                <option value="CL">Chile</option>
							                <option value="CN">China</option>
							                <option value="CX">Christmas Island</option>
							                <option value="CC">Cocos (Keeling) Islands</option>
							                <option value="CO">Colombia</option>
							                <option value="KM">Comoros</option>
							                <option value="CG">Congo</option>
							                <option value="CK">Cook Islands</option>
							                <option value="CR">Costa Rica</option>
							                <option value="HR">Croatia</option>
							                <option value="CU">Cuba</option>
							                <option value="CY">Cyprus</option>
							                <option value="CZ">Czech Republic</option>
							                <option value="DK">Denmark</option>
							                <option value="DJ">Djibouti</option>
							                <option value="DM">Dominica</option>
							                <option value="DO">Dominican Republic</option>
							                <option value="TP">East Timor</option>
							                <option value="EC">Ecuador</option>
							                <option value="EG">Egypt</option>
							                <option value="SV">El Salvador</option>
							                <option value="GQ">Equatorial Guinea</option>
							                <option value="ER">Eritrea</option>
							                <option value="EE">Estonia</option>
							                <option value="ET">Ethiopia</option>
							                <option value="FK">Falkland Islands</option>
							                <option value="FO">Faroe Islands</option>
						                	<option value="FJ">Fiji</option>
						                	<option value="FI">Finland</option>
							                <option value="CS">Former Czechoslovakia</option>
							                <option value="SU">Former USSR</option>
							                <option value="FR">France</option>
							                <option value="FX">France (European Territory)</option>
							                <option value="GF">French Guyana</option>
							                <option value="TF">French Southern Territories</option>
							                <option value="GA">Gabon</option>
							                <option value="GM">Gambia</option>
							                <option value="GE">Georgia</option>
							                <option value="DE">Germany</option>
							                <option value="GH">Ghana</option>
							                <option value="GI">Gibraltar</option>
							                <option value="GB">Great Britain</option>
							                <option value="GR">Greece</option>
							                <option value="GL">Greenland</option>
							                <option value="GD">Grenada</option>
							                <option value="GP">Guadeloupe (French)</option>
							                <option value="GU">Guam (USA)</option>
							                <option value="GT">Guatemala</option>
							                <option value="GN">Guinea</option>
							                <option value="GW">Guinea Bissau</option>
							                <option value="GY">Guyana</option>
							                <option value="HT">Haiti</option>
							                <option value="HM">Heard and McDonald Islands</option>
							                <option value="HN">Honduras</option>
							                <option value="HK">Hong Kong</option>
							                <option value="HU">Hungary</option>
							                <option value="IS">Iceland</option>
							                <option value="IN">India</option>
							                <option value="ID">Indonesia</option>
							                <option value="INT">International</option>
							                <option value="IR">Iran</option>
							                <option value="IQ">Iraq</option>
							                <option value="IE">Ireland</option>
							                <option value="IL">Israel</option>
							                <option value="IT">Italy</option>
							                <option value="CI">Ivory Coast (Cote D&#39;Ivoire)</option>
							                <option value="JM">Jamaica</option>
							                <option value="JP">Japan</option>
							                <option value="JO">Jordan</option>
							                <option value="KZ">Kazakhstan</option>
							                <option value="KE">Kenya</option>
							                <option value="KI">Kiribati</option>
							                <option value="KW">Kuwait</option>
							                <option value="KG">Kyrgyzstan</option>
							                <option value="LA">Laos</option>
							                <option value="LV">Latvia</option>
							                <option value="LB">Lebanon</option>
							                <option value="LS">Lesotho</option>
							                <option value="LR">Liberia</option>
							                <option value="LY">Libya</option>
							                <option value="LI">Liechtenstein</option>
							                <option value="LT">Lithuania</option>
							                <option value="LU">Luxembourg</option>
							                <option value="MO">Macau</option>
							                <option value="MK">Macedonia</option>
							                <option value="MG">Madagascar</option>
							                <option value="MW">Malawi</option>
							                <option value="MY">Malaysia</option>
							                <option value="MV">Maldives</option>
							                <option value="ML">Mali</option>
							                <option value="MT">Malta</option>
							                <option value="MH">Marshall Islands</option>
							                <option value="MQ">Martinique (French)</option>
							                <option value="MR">Mauritania</option>
							                <option value="MU">Mauritius</option>
							                <option value="YT">Mayotte</option>
							                <option value="FM">Micronesia</option>
							                <option value="MD">Moldavia</option>
							                <option value="MC">Monaco</option>
						                	<option value="MN">Mongolia</option>
						                	<option value="MS">Montserrat</option>
							                <option value="MA">Morocco</option>
							                <option value="MZ">Mozambique</option>
							                <option value="MM">Myanmar</option>
							                <option value="NA">Namibia</option>
							                <option value="NR">Nauru</option>
							                <option value="NP">Nepal</option>
							                <option value="NL">Netherlands</option>
							                <option value="AN">Netherlands Antilles</option>
							                <option value="NT">Neutral Zone</option>
							                <option value="NC">New Caledonia (French)</option>
							                <option value="NZ">New Zealand</option>
							                <option value="NI">Nicaragua</option>
							                <option value="NE">Niger</option>
							                <option value="NG">Nigeria</option>
							                <option value="NU">Niue</option>
							                <option value="NF">Norfolk Island</option>
							                <option value="KP">North Korea</option>
							                <option value="MP">Northern Mariana Islands</option>
							                <option value="NO">Norway</option>
							                <option value="OM">Oman</option>
							                <option value="PK">Pakistan</option>
							                <option value="PW">Palau</option>
							                <option value="PA">Panama</option>
							                <option value="PG">Papua New Guinea</option>
							                <option value="PY">Paraguay</option>
							                <option value="PE">Peru</option>
							                <option value="PH">Philippines</option>
							                <option value="PN">Pitcairn Island</option>
							                <option value="PL">Poland</option>
							                <option value="PF">Polynesia (French)</option>
							                <option value="PT">Portugal</option>
							                <option value="PR">Puerto Rico</option>
							                <option value="QA">Qatar</option>
							                <option value="RE">Reunion (French)</option>
							                <option value="RO">Romania</option>
							                <option value="RW">Rwanda</option>
							                <option value="GS">S. Georgia & S. Sandwich Isls.</option>
							                <option value="SH">Saint Helena</option>
							                <option value="KN">Saint Kitts & Nevis Anguilla</option>
							                <option value="LC">Saint Lucia</option>
							                <option value="PM">Saint Pierre and Miquelon</option>
							                <option value="ST">Saint Tome (Sao Tome) and Principe</option>
							                <option value="VC">Saint Vincent & Grenadines</option>
							                <option value="WS">Samoa</option>
							                <option value="SM">San Marino</option>
							                <option value="SA">Saudi Arabia</option>
							                <option value="SN">Senegal</option>
							                <option value="SC">Seychelles</option>
							                <option value="SL">Sierra Leone</option>
							                <option value="SG">Singapore</option>
							                <option value="SK">Slovak Republic</option>
							                <option value="SI">Slovenia</option>
							                <option value="SB">Solomon Islands</option>
							                <option value="SO">Somalia</option>
							                <option value="ZA">South Africa</option>
							                <option value="KR">South Korea</option>
							                <option value="ES">Spain</option>
							                <option value="LK">Sri Lanka</option>
							                <option value="SD">Sudan</option>
							                <option value="SR">Suriname</option>
							                <option value="SJ">Svalbard and Jan Mayen Islands</option>
							                <option value="SZ">Swaziland</option>
							                <option value="SE">Sweden</option>
							                <option value="CH">Switzerland</option>
							                <option value="SY">Syria</option>
							                <option value="TJ">Tadjikistan</option>
							                <option value="TW">Taiwan</option>
							                <option value="TZ">Tanzania</option>
							                <option value="TH">Thailand</option>
							                <option value="TG">Togo</option>
							                <option value="TK">Tokelau</option>
							                <option value="TO">Tonga</option>
							                <option value="TT">Trinidad and Tobago</option>
							                <option value="TN">Tunisia</option>
							                <option value="TR">Turkey</option>
							                <option value="TM">Turkmenistan</option>
							                <option value="TC">Turks and Caicos Islands</option>
							                <option value="TV">Tuvalu</option>
							                <option value="UG">Uganda</option>
						                	<option value="UA">Ukraine</option>
							                <option value="AE">United Arab Emirates</option>
							                <option value="UY">Uruguay</option>
							                <option value="MIL">USA Military</option>
							                <option value="UM">USA Minor Outlying Islands</option>
							                <option value="UZ">Uzbekistan</option>
							                <option value="VU">Vanuatu</option>
							                <option value="VA">Vatican City State</option>
							                <option value="VE">Venezuela</option>
							                <option value="VN">Vietnam</option>
							                <option value="VG">Virgin Islands (British)</option>
							                <option value="VI">Virgin Islands (USA)</option>
							                <option value="WF">Wallis and Futuna Islands</option>
							                <option value="EH">Western Sahara</option>
							                <option value="YE">Yemen</option>
							                <option value="YU">Yugoslavia</option>
							                <option value="ZR">Zaire</option>
							                <option value="ZM">Zambia</option>
							                <option value="ZW">Zimbabwe</option>
									</select>
								</div>
								<div class="col-lg-6">
									<div class="checkbox">
										<label for="">
										<input type="checkbox" name="list_global" checked>
											Global Newsletter
										</label>
									</div>
									<div class="checkbox">
										<label for="">
										<input type="checkbox" name="list_mixology">
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
			<? 
				$options = get_option("plugin_options");
				$fb = $options["facebook"];
				$tweet = $options["twitter"];
				$ig = $options["instagram"];
				$yt = $options["youtube"];

				$fbclass = $fb ? "" : "disabled";
				$twclass = $tweet ? "" : "disabled";
				$igclass = $ig ? "" : "disabled";
				$ytclass = $yt ? "" : "disabled";
			?>
			<li><a target="_blank" class="socialicon first <? echo $fbclass; ?>" href="<? echo $fb; ?>"><img src="<? echo theme_uri; ?>/assets/images/fb.png" alt=""></a></li>
			<li><a target="_blank" class="socialicon <? echo $twclass; ?>" href="<? echo $tweet; ?>"><img src="<? echo theme_uri; ?>/assets/images/twitter.png" alt=""></a></li>
			<li><a target="_blank" class="socialicon <? echo $igclass; ?>" href="<? echo $ig; ?>"><img src="<? echo theme_uri; ?>/assets/images/ig.png" alt=""></a></li>
			<li><a target="_blank" class="socialicon <? echo $ytclass; ?>" href="<? echo $yt; ?>"><img src="<? echo theme_uri; ?>/assets/images/yt.png" alt=""></a></li>
			<li class="divider"></li>
			<li class="dropdown">
				<a target="_blank" href="#" class="dropdown-toggle socialicon search" data-toggle="dropdown"><img src="<? echo theme_uri; ?>/assets/images/search.png" alt=""></a>
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
	</div>
</div>