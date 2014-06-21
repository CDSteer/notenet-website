<?php
set_time_limit(0);
header("Content-Type: text/plain");
require_once("../api/src/v1/v1.php");

const SPLIT = 100;

$count = DB::queryFirstRow("SELECT COUNT(*) AS Count FROM City");
$count = $count["Count"];

$cities = array();

for($i = 0; $i < $count; $i += SPLIT) {
	$result = DB::query("SELECT * FROM City LIMIT ".$i.",".SPLIT);
	print(json_encode($result));
	$cities = array_merge($cities, $result);
}

//print(json_encode($cities));
?>