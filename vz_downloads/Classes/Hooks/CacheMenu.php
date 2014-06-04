<?php
namespace VZ\VzDownloads\Hooks;

class CacheMenu  implements \TYPO3\CMS\Backend\Toolbar\ClearCacheActionsHookInterface {
	public function manipulateCacheActions(&$a_cacheActions, &$a_optionValues) {
		$s_title = 'Reindex files';
		$s_imagePath = $GLOBALS['TYPO3_LOADED_EXT']['vz_downloads']['siteRelPath'];
		if(strpos($s_imagePath,'typo3conf') !== false) $s_imagePath = '../'.$s_imagePath;

		$a_cacheActions[] = array(
			'id'    => 'vz_downloads',
			'title' => $s_title,
			'href' => 'ajax.php?ajaxID=tx_vzdownloads::indexFiles',
			'icon'  => '<img src="'.$s_imagePath.'ext_icon.gif" title="'.$s_title.'" alt="'.$s_title.'" />',
		);
		$a_optionValues[] = 'indexFilesCache';
	}
}