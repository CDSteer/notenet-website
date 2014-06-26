<?php
header("Content-Type: text/plain");
$cubes = Cube::all();

foreach ($cubes as $cube) {
	$user = $cube->getUser();
	printf("%s owned by %s\n", $cube->getName(), $user->getUsername());
}
?>