<?php

$CE_FOLDER = "/home/bazil/w/idea_area/ce";
$PRO_FOLDER = "/home/bazil/w/idea_area/pro";

$CE_3PartyItems = [
	"/jasperserver-war/src/main/webapp/scripts/lib/",
	"/jasperserver-war/src/test/javascript/lib/",
	"/jasperserver-war/src/main/webapp/WEB-INF/esapi/Owasp.CsrfGuard.js",
	"/jasperserver-war/src/main/tools/r.js",
	"/jasperserver-war/src/test/javascript/require-jquery.js",
	"/jasperserver-war/src/test/javascript/tools/coverage-viewer/jquery.js",
	"/jasperserver-war/src/test/javascript/tools/coverage-viewer/jquery.ui.js",
	"/jasperserver-war/src/test/javascript/tools/coverage-viewer/underscore.js"
];

$PRO_3PartyItems = [
	"/jasperserver-war/src/main/webapp/fusion/",
	"/jasperserver-war/src/main/webapp/scripts/lib/",
	"/jasperserver-war/src/main/webapp/scripts/Owasp.CsrfGuard.js"
];

/// Don't change nothing under this line

$CE_HEADER = "./ce_header.txt";
$PRO_HEADER = "./pro_header.txt";

function checkToSkip($str, $itemsToSkip) {
	foreach ($itemsToSkip as $item) {
		if (strpos($str, $item) !== false) {
			return true;
		}
	}
	return false;
}
