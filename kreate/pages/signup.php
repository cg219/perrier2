<?
	include("../../consts.php");
	include("../../mc/MailChimp.class.php");

	$full_name      = $_POST["full_name"]      	? $_POST["full_name"] : NULL;
	$email_address  = $_POST["email_address"]  	? $_POST["email_address"] : NULL;
	$age            = $_POST["age"]           	? $_POST["age"] : NULL;
	$city           = $_POST["city"]			? $_POST["city"] : NULL;
	$country        = $_POST["country"]     	? $_POST["country"] : NULL;
	$state        	= $_POST["state"]			? $_POST["state"] : NULL;
	$list_global    = $_POST["list_global"]  	? $_POST["list_global"] : NULL;
	$list_mixology  = $_POST["list_mixology"]  	? $_POST["list_mixology"] : NULL;
	$mc 			= new MailChimp(chimp_api);

	if ($full_name != NULL && $email_address != null && $city != null && $state != null && $country != null) :
		$merge_vars = array(
			"FULLNAME"=> $full_name,
			"AGE" => $age,
			"CITY" => $city,
			"STATE" => $state,
			"COUNTRY" => $country
		);

		if($list_global === "on") :

			$global_result = $mc->call("lists/subscribe", array(
				"id" => chimp_global,
				"email" => array(
					"email" => $email_address
				),
				"merge_vars" => $merge_vars
			));
		endif;

		if($list_mixology === "on") :
			$global_result = $mc->call("lists/subscribe", array(
				"id" => chimp_mix,
				"email" => array(
					"email" => $email_address
				),
				"merge_vars" => $merge_vars
			));
		endif;

	endif;
?>