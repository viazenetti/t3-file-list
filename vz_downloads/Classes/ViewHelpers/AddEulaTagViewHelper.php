<?php
namespace VZ\VzDownloads\ViewHelpers;

class AddEulaTagViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


	/**
	 * @param string $id
	 * @return string
	 */
	public function render($id = 0) {

		return (Int)$id > 0 ? 'data-eula-id="'.$id.'"' : '';
	}
}
