<?php
/**
 * ExcludeRandom - this extension allows pages to be excluded from Special:Random
 *
 * To activate this extension, add the following into your LocalSettings.php file:
 * require_once "$IP/extensions/ExcludeRandom/ExcludeRandom.php";
 *
 * @ingroup Extensions
 * @author Matt Russell
 * @version 2.0.0
 * @link https://www.mediawiki.org/wiki/Extension:ExcludeRandom Documentation
 * @license BSD-3-Clause
 */

if ( function_exists( 'wfLoadExtension' ) ) {
	wfLoadExtension( 'ExcludeRandom' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	$wgMessagesDirs['ExcludeRandom'] = __DIR__ . '/i18n';
	wfWarn(
		'Deprecated PHP entry point used for ExcludeRandom extension. Please use wfLoadExtension instead, ' .
		'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
	);
	return;
} else {
	die( 'This version of the ExcludeRandom extension requires MediaWiki 1.25+' );
}
