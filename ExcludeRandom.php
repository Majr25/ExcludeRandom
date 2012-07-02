<?php
/**
 * ExcludeRandom - this extension allows pages to be excluded from Special:Random
 *
 * To activate this extension, add the following into your LocalSettings.php file:
 * require_once( '$IP/extensions/ExcludeRandom/ExcludeRandom.php' );
 *
 * @ingroup Extensions
 * @author Matt Russell
 * @version 0.1
 * @link https://www.mediawiki.org/wiki/Extension:ExcludeRandom Documentation
 * @license BSD
 */

if ( !defined( 'MEDIAWIKI' ) ) {
        echo "This is an extension to the MediaWiki package and cannot be run standalone.\n";
        die( -1 );
}

$wgExcludeRandomPages = null;

$wgHooks['SpecialRandomGetRandomTitle'][] = 'wfExcludeRandomInit';

/* Define extensions info */
$wgExtensionCredits['other'][] = array(
		'path' => __FILE__,
		'name' => 'ExcludeRandom',
		'author' =>'[http://matt-russell.com Matt Russell]',
		'url' => 'https://www.mediawiki.org/wiki/Extension:ExcludeRandom',
		'descriptionmsg' => 'excluderandom-desc',
		'version'  => 0.1,
		);

/* Define internationalisation file */
$dir = dirname( __FILE__ ) . '/';
$wgExtensionMessagesFiles['ExcludeRandom'] = $dir . 'ExcludeRandom.i18n.php';

function wfExcludeRandomInit( &$rand, &$isRedir, &$namespaces, &$extra, &$title ) {
	GLOBAL $wgExcludeRandomPages, $dbr;
	if ( !$wgExcludeRandomPages ) {
		return true;
	}
	
	foreach ( $wgExcludeRandomPages AS $cond ) {
		$escape = str_replace( array( ' ', '\\', '%', '_', '*', '\'' ), array( '_', '\\\\', '\%', '\_', '%', '\\\'' ), $cond );
		$extra[] = "`page_title` NOT LIKE '$escape'";
	}
	
	return true;
}
