<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'VZ.' . $_EXTKEY,
	'Downloadlist',
	array(
		'Downloads' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Downloads' => 'list',
		
	)
);

$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ($GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] == '' ? '' : ',') . 'tx_vzdownloads_basepath,';

// REGISTER CACHE MENU ENTRY MANIPULATOR
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['additionalBackendItems']['cacheActions'][] = 'EXT:vz_downloads/Classes/Hooks/CacheMenu.php:VZ\\VzDownloads\\Hooks\\CacheMenu';

// REGISTER CLEAR IMAGE CACHE AJAX ACTION
$TYPO3_CONF_VARS['BE']['AJAX']['tx_vzdownloads::indexFiles'] = 'EXT:vz_downloads/Classes/Controller/IndexFilesController.php:VZ\\VzDownloads\\Controller\\IndexFilesController->indexFiles';


