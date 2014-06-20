<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Downloadlist',
	'Download List'
);

//\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
//	$_EXTKEY,
//	'Euladata',
//	'Euladata'
//);

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



$additionalPageColumns = array(
	'tx_vzdownloads_euladata' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:vz_downloads/Resources/Private/Language/locallang_db.xlf:sys_file_metadata.tx_vzdownloads_euladata',
		'config' => array(
			'type' => 'select',
			'items' => array(
				array(' --- Bitte wählen --- ',0)
			),
			'foreign_table' => 'tx_vzdownloads_domain_model_eula',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'default' => '0',
		),
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_metadata', $additionalPageColumns);
unset($additionalPageColumns);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_file_metadata', 'tx_vzdownloads_euladata', '1', 'after:alternative');




\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_vzdownloads_domain_model_eula', 'EXT:vz_downloads/Resources/Private/Language/locallang_csh_tx_vzdownloads_domain_model_eula.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_vzdownloads_domain_model_eula');
$GLOBALS['TCA']['tx_vzdownloads_domain_model_eula'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:vz_downloads/Resources/Private/Language/locallang_db.xlf:tx_vzdownloads_domain_model_eula',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,header,body,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Eula.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_vzdownloads_domain_model_eula.gif'
	),
);




