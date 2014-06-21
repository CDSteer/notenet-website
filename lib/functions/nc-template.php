<?php
// Controllers
function nc_controller($name) { global $service; global $user; include("controllers/".$name.".php"); }
function nc_include($name) { global $service; global $user; include("includes/".$name.".php"); }
function nc_head() { nc_controller("head"); }
function nc_navbar() { nc_controller("navbar"); }
function nc_footer() { nc_controller("footer"); }
function nc_foot() { nc_controller("foot"); }
function nc_stylesheet($css, $min = TRUE) { printf("<link rel=\"stylesheet\" href=\"%s/css/%s%s.css\">\n", DOCROOT, $css, $min ? ".min" : ""); }
function nc_script($js, $min = TRUE) { printf("<script src=\"%s/js/%s%s.js\"></script>\n", DOCROOT, $js, $min ? ".min" : ""); }

function nc_page() {
	// Get current page link
	global $page;

	if(func_num_args() == 0)
		return $page;
	else
		return ($page == func_get_arg(0)) || (func_get_arg(0) == "" && $page == "index");
}

function nc_href($url, $print = TRUE) {
	// Generate a safe href
	$href = sprintf("%s/%s", DOCROOT, $url);

	// Print or return it?
	if($print)
		print($href);
	else
		return $href;
}

function nc_li_active($url, $text) {
	printf("<li%s><a href=\"%s\">%s</a></li>\n",
		nc_page($url) ? " class=\"active\"" : "", // Should it be marked as "active"?
		nc_href($url, FALSE), // <a href> link
		$text // Text displayed
		);
}
?>