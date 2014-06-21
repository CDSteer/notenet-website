<?php
// Requisits
require_once("lib/common.php");

// Execute cron
$cron = isset($_GET["cron"]) ? $_GET["cron"] : NULL;
if(!is_null($cron)) {
	require_once("lib/cron/".$cron.".php");
	exit();
}

// GET page 
$page = isset($_GET["page"]) ? (trim($_GET["page"]) != "" ? $_GET["page"] : "index") : "index";
$file = "views/".$page;

unset($_GET["page"]);

// Check for "index"
if(is_dir($file)) { $file .= "/index"; }
$file .= ".php";

if(file_exists($file)) {
	// Load page
	include($file);
} else {
	// 404
	printf("Not found");
}
?>