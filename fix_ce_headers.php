#!/usr/bin/env php
<?php

$cmdOptions = getopt("r::");
$replaceFlag = isset($cmdOptions["r"]);

require_once("./config.php");
function pf($file) {global $CE_FOLDER; return str_replace($CE_FOLDER, "", $file); }
$currentYear = date("Y");
$header = str_replace("\r\n", "\n", trim(file_get_contents($CE_HEADER)));


exec('find '.$CE_FOLDER.' -name "*.js"', $files);
foreach ($files as $file) {
	if (strpos($file, "jasperserver-war/src/") === false) {
		continue;
	}
	if (checkToSkip($file, $CE_3PartyItems)) {
		continue;
	}
	$content = str_replace("\r\n", "\n", file_get_contents($file));

	if (strpos($content, $header) !== false) {

		$content = file_get_contents($file);
		preg_match_all("/Copyright\s*\(C\)\s*(\d{4})\s*-\s*(\d{4})\s*Jaspersoft/msi", $content, $matches);
		if (count($matches) !== 3) {
			echo "No years in header: ".$file."\n";
		} else {
			if ($matches[1][0] !== "2005" || $matches[2][0] !== $currentYear) {
				echo "Wrong years in header: ".$file." (".$matches[1][0]." - ".$matches[2][0].")\n";
				if ($replaceFlag) {
					echo "Replacing headers in file: ".$file."...\n";
					$content = preg_replace("/Copyright\s*\(C\)\s*(\d{4})\s*-\s*(\d{4})\s*Jaspersoft/msi", "Copyright (C) 2005 - ".$currentYear." Jaspersoft", $content);
					file_put_contents($file, $content);
				}
			}
		}
	} else {
		echo "Missing header: " . pf($file) . "\n";
	}
}
