<?php
require_once("lib/common.php");

function _p($x, $v = "") {
	return isset($_GET[$x]) ? $_GET[$x] : (isset($_POST[$x]) ? $_POST[$x] : $v);
}

$target = _p("target", $_SERVER["HTTP_REFERER"]);
$do = _p("do", _p("_do"));

switch ($do) {
	case "login":
		// Login
		$login = $service->login($_POST["emailAddress"], $_POST["password"]);

		if(!$login->ok) {
			nc_post_error("login", $login->code);
		}

		break;

	case "logout":
		// Logout
		if($service->isLoggedIn())
			$service->logout();
		$target = DOCROOT;
		break;

	case "signup":
		// Sign up
		extract($_POST);

		if($emailAddress != $confirmEmailAddress) {
			nc_post_error("signup", Code::EMAIL_MISMATCH);
		}
		if($password != $confirmPassword) {
			nc_post_error("signup", Code::PASSWORD_MISMATCH);
		}

		// Create user
		$try = User::create($emailAddress, $username, $password);
		if($try == -1) {
			nc_post_error("signup", Code::EMAIL_IN_USE);
		} else if($try == -2) {
			nc_post_error("signup", Code::USERNAME_IN_USE);
		}

		$userService->alloc($emailAddress, $password, $remember == "1");
		break;

	case "user_delete":
		if($user->checkPassword($_POST["password"])) {
			// Delete the user and logout
			$user->delete($user->getID());
			$service->logout();

			// Set target
			$target = DOCROOT;
		} else {
			// Post an error
			nc_post_error("settings", Code::INVALID_PASSWORD);
		}

		break;

	case "cube_create":
		if($service->isLoggedIn()) {
			// Create new cube
			$params = array(
				"id"   => sha1(time()),
				"name" => $_POST["name"],
				"device_id" => $_POST["deviceId"],
				"private_access_token" => $_POST["accessToken"],
				"public_access_token"  => User_Service::generateAccessToken(),
				"user" => $user->getID()
				);

			if(strlen($_POST["accessToken"]) != 40) {
				nc_post_error("dashboard", Code::INVALID_ACCESS_TOKEN);
			}
			if(strlen($_POST["deviceId"]) != 24) {
				nc_post_error("dashboard", Code::INVALID_DEVICE_ID);
			} else {
				// Create cube
				if(!Cube::create($params))
					nc_post_error("dashboard", Code::DEVICE_ALREADY_REGISTERED);
				else
					nc_post_error("dashboard", Code::DEVICE_REGISTER_SUCCESS);
			}
			break;
		}

	case "cube_delete":
		$cube = new Cube($_POST["deleteCubeId"]);

		if(!$cube->exists()) {
			nc_post_error("dashboard", Code::NO_SUCH_DEVICE);
		} else {
			$cube->delete($cube->getID());
			nc_post_error("dashboard", Code::DEVICE_REMOVE_SUCCESS);
		}
		break;

	case "cube_setLocation":
		$cube = new Cube($_POST["cube"]);
		if($cube->exists()) {
			$cube->setLocation($_POST["location"]);
		}

		break;

	case "city_match":
		$city = _p("city");
		$results = array();
		$count = 0;

		if(strlen($city) >= 4) {
			$results = (array)DB::query("SELECT * FROM City WHERE LCASE(Name) = %s AND Name IS NOT NULL LIMIT 10", strtolower($city));
			$count = DB::count();

			if($count == 0) {
				$secondCount = 10 - $count;

				$results = array_merge($results, (array)DB::query("SELECT * FROM City WHERE LCASE(Name) LIKE %s AND Name IS NOT NULL LIMIT ".($secondCount), strtolower($city)."%"));

				$thirdCount = $count + DB::count();

				if($thirdCount == 0) {
					$results = array_merge($results, (array)DB::query("SELECT * FROM City WHERE LCASE(Name) LIKE %s AND Name IS NOT NULL LIMIT ".(10 - $thirdCount), "%".strtolower($city)."%"));
				}
			}
		}

		print(json_encode($results));
		die;
		break;

	case "city_count":
		$result = DB::queryFirstRow("SELECT COUNT(*) AS Count FROM City");
		print(json_encode(array("count" => intval($result["Count"]))));
		die;
		break;

	case "city_all":
		print(file_get_contents("lib/city.json"));
		die;
		break;

	// -------------
	// Settings form
	// -------------
	case "user_setEmailAddress":
		if(!$service->isLoggedIn()) {
			nc_goto(DOCROOT);
		}

		if($_POST["emailAddress"] != $_POST["confirmEmailAddress"]) {
			nc_post_error("settings", Code::EMAIL_MISMATCH);
		}

		$user->setEmailAddress($_POST["emailAddress"]);

		nc_post_error("settings", Code::SUCCESS);

	case "user_setPassword":
		if(!$service->isLoggedIn()) {
			nc_goto(DOCROOT);
		}

		if($_POST["password"] != $_POST["confirmPassword"]) {
			nc_post_error("settings", Code::PASSWORD_MISMATCH);
		}

		$salt = User_Service::generateSalt();
		$user->setPassword($_POST["password"], $salt);

		nc_post_error("settings", Code::SUCCESS);
	
	default: break;
}

sleep(1);
nc_goto($target);
?>