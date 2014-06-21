<?php
// Prepare user service
$user = NULL;
$userService = new UserService();

// Initialise service
if($userService->preCheck())
	$userService->init();

// Attempt login
$login = $userService->login();
$RC = $login["rc"];
$loginUser = $login["user"];
if($RC == RC::BRUTE_ATTACK) {
	// Too many login attempts
	$brute = true;
	$userService->dump();
} else {
	if(!is_null($loginUser) && $RC == RC::SUCCESS) {
		// Login was sucessful
		$user = new User($loginUser);
		$user->pull();
	}
}
unset($login);
unset($loginUser);
?>