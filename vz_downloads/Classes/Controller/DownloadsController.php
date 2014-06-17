<?php
namespace VZ\VzDownloads\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * DownloadsController
 */
class DownloadsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \TYPO3\CMS\Core\Resource\FileRepository
	 */
	protected $fileRepository;

	/**
	 * @var array
	 */
	protected $data;

	/**
	 * @var string
	 */
	protected $table = 'sys_file';

	/**
	 * A list of properties which are to be fetched
	 *
	 * @var array
	 */
	protected $fields = array(
		'uid', 'pid', 'missing', 'type', 'storage', 'identifier', 'identifier_hash', 'extension',
		'mime_type', 'name', 'sha1', 'size', 'creation_date', 'modification_date', 'folder_hash'
	);

	/**
	 *
	 */
	public function initializeAction() {
		parent::initializeAction();
		$this->contentObject = $this->configurationManager->getContentObject();
		$this->fileRepository = $this->objectManager->create('TYPO3\\CMS\\Core\\Resource\\FileRepository');
		$this->data = $this->contentObject->data;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {

		$basePath = $this->getBasePath();
        if($basePath === false) {
			$this->addFlashMessage(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate( 'root_path_missing', 'vz_downloads' ));
			return;
		}

		$directoryPath = $basePath . trim($this->settings['directory'], ' /') . '/';
		if(!is_dir(str_replace('//', '/', PATH_site . $GLOBALS['TYPO3_CONF_VARS']['BE']['fileadminDir'] . $directoryPath))) {
			$this->addFlashMessage(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate( 'directory_error', 'vz_downloads' ));
			return;
		}

		$files = $this->findByFolder($directoryPath);

		$this->view->assign('agreeEula', $this->settings['agree_eula']);
		$this->view->assign('archivePath', $this->settings['archive_path'] !== '' ? $this->getBasePath() . $this->settings['archive_path'] : '');
		$this->view->assign('downloads', $files);
		$this->view->assign('data', $this->data);
	}

	/**
	 *
	 */
	protected function findByFolder($folder){

		$extensionsAr = explode(',', $this->settings['fileExtensions']);
        $extensionsAr = array_map('trim', $extensionsAr);
		$extensions = "'" . implode("','", $extensionsAr) . "'";

		$resultRows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			implode(',', $this->fields),
			$this->table,
			"identifier LIKE " . $GLOBALS['TYPO3_DB']->fullQuoteStr($folder.'%', $this->table) . " AND missing = 0 AND extension IN (" . $extensions . ")",
			'',
			'',
			'',
			'identifier'
		);

		return $resultRows;
	}


	/**
	 *
	 */
	protected function getBasePath() {
		/* @var $rootlineUtil \TYPO3\CMS\Core\Utility\RootlineUtility */
		$rootlineUtil = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Utility\\RootlineUtility', $GLOBALS['TSFE']->id);
		$rootline = $rootlineUtil->get();

		foreach($rootline as $rootlineItem) {
			if($rootlineItem['tx_vzdownloads_basepath'] !== '') {
				return '/' . trim($rootlineItem['tx_vzdownloads_basepath'], ' /') . '/';
			}
		}

		return false;
	}

}