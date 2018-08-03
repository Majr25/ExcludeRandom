<?php
class ExcludeRandomHooks {
	public static function onSpecialRandomGetRandomTitle( &$rand, &$isRedir, &$namespaces, &$extra, &$title ) {
		$config = \ConfigFactory::getDefaultInstance()->makeConfig('main');
		$wgExcludeRandomPages = $config->get('ExcludeRandomPages');
		if ( !is_array( $wgExcludeRandomPages ) || empty( $wgExcludeRandomPages ) ) {
			return true;
		}

		$db = wfGetDB( DB_REPLICA );
		foreach ( $wgExcludeRandomPages as $cond ) {
			$pattern = $db->strencode( $cond );
			$pattern = str_replace(
				[ '_', '%', ' ', '*' ],
				[ '\_', '\%', '\_', '%' ],
				$pattern
			);
			$extra[] = "`page_title` NOT LIKE '$pattern'";
		}

		return true;
	}
}
