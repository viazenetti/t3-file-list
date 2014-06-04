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
class IndexFilesController {

	/**
	 * @var 	array		$extConf: settings from the extension manager
	 * @todo Define visibility
	 */
	public $extConf = array();

	/**
	 * action list
	 *
	 * @return void
	 */
	public function indexFiles() {
		$this->extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['vz_downloads']);

		$scheduler = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('\\TYPO3\\CMS\\Scheduler\\Scheduler');

		$task = $scheduler->fetchTask($this->extConf['taskId']);
		$result = $scheduler->executeTask($task);

	}

}