<?php
// Keep this! Can be useful in the future
define("DOCROOT", substr(substr($_SERVER["SCRIPT_FILENAME"], strlen($_SERVER["DOCUMENT_ROOT"])), 0, strlen(substr($_SERVER["SCRIPT_FILENAME"], strlen($_SERVER["DOCUMENT_ROOT"]))) - strlen(basename($_SERVER["SCRIPT_FILENAME"])) - 1));

// API
require_once("api/src/v1/v1.php");

// Website functions
require_once("functions/nc-common.php");
require_once("functions/nc-template.php");

//set_include_path(get_include_path().PATH_SEPARATOR."../../");
//require_once("scripts/email/google.php");

// Default timezone for date() and time()
date_default_timezone_set("Europe/London");
?>