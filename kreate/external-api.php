<?
	include("../consts.php");

	function newsletterAdd(){
		$Chimp = new MailChimp(chimp_api);

		$full_name      = isset($_POST['full_name'])      ? $_POST['full_name'] : NULL;
		$email_address  = isset($_POST['email_address'])  ? $_POST['email_address'] : NULL;
		$age            = isset($_POST['age'])            ? $_POST['age'] : NULL;
		$city           = isset($_POST['city'])    		  ? $_POST['city'] : NULL;
		$state          = isset($_POST['state'])          ? $_POST['state'] : NULL;
		$country        = isset($_POST['country'])        ? $_POST['country'] : NULL;

		$result = 	$Chimp->call("lists/subscribe", array(
						"id" => chimp_list,
						"email_address" => $email_address,
						"merge_vars" => array('FULLNAME'=> $full_name,
							'AGE' => $age,
							'CITY' => $city,
							'STATE' => $state,
							'COUNTRY' => $country
						)
					));
	}

	switch($GET[call]){
		case "addSubscriber" :
			newsletterAdd();
			break;
	}
?>