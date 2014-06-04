<?php
namespace VZ\VzDownloads\ViewHelpers;

class PrepareFilenameViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


	/**
	 * @param string $filename
	 * @param string $removeUnderscore
	 * @return string
	 */
	public function render($filename, $removeUnderscore = Null) {
		$filenameAr = explode('.', $filename);
		array_pop($filenameAr);
		$filename = implode('.', $filenameAr);

		if($removeUnderscore === '1') {
			$filename = str_replace('_', ' ', $filename);
		}
		return $filename;
	}
}
