<?php
set_time_limit(10);

function __nc_scan_folder($dir = "") {
	$files = array();

	if($dir == "") $dir = dirname(__FILE__);

	$dir = realpath($dir);

	foreach (scandir($dir) as $filename) {
		if($filename == "." || $filename == "..") continue;

		$path = sprintf("%s/%s", $dir, $filename);
		if (is_file($path)) {
			$files[] = $path;
		} else if(is_dir($path)) {
			$files = array_merge($files, __nc_scan_folder($path));
		}
	}

	return $files;
}

function nc_library($library, $p = 1) {
	$pre_path = str_repeat("../", intval($p));
	if($p > 1) $pre_path .= "lib/";

	$path = realpath($pre_path."libraries/".$library);
	set_include_path(get_include_path().PATH_SEPARATOR.$path);

	$files = __nc_scan_folder($pre_path."libraries/".$library);
	foreach($files as $file) {
		$f = realpath($file);
		$info = pathinfo($f);
		if($info["extension"] == "php") {
			require_once(realpath($f));
		}
	}
}

function nc_goto($url) {
	header("Location: $url");
	die();
}

function nc_post($url, $data) {
	foreach($data as $k=>$v) $inputs .= sprintf("<input type=\"hidden\" name=\"%s\" value=\"%s\">", $k, $v);
	printf("<form id=\"form\" method=\"post\" action=\"%s\">%s</form><script>document.getElementById('form').submit();</script>", nc_href($url, FALSE), $inputs);
	die();
}

function nc_post_error($url, $rc) {
	nc_post($url, array("rc" => $rc));
}

function nc_error() {
	// Split errors
	return isset($_POST["rc"]) ? $_POST["rc"] : NULL;
}
?>