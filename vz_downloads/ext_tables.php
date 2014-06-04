<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Downloadlist',
	'Download List'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Downloads');


$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_downloadlist']='layout,select_key,pages';

$extensionName = TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_' . strtolower('Downloadlist');

$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY.'/Configuration/Flexforms/flexform_downloadlist.xml');

// ----------------------------------------------------------------------------
// EXTENDING TABLE 'pages'
// ----------------------------------------------------------------------------

$additionalPageColumns = array(
	'tx_vzdownloads_basepath' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:vz_downloads/Resources/Private/Language/locallang_db.xlf:pages.tx_vzdownloads_basepath',
		'config' => array(
			'type' => 'input',
			'size' => 30,
			'eval' => 'trim',
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $additionalPageColumns);
unset($additionalPageColumns);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'tx_vzdownloads_basepath', '1', 'after:media');



