<?php
namespace VZ\VzDownloads\ViewHelpers;

class AddEulaTagViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


	/**
	 * @param string $id
     * @param array $downloads
	 * @return string
	 */
	public function render($id = NULL, $downloads = NULL) {

		if ((Int)$id > 0) {
            return ' data-eula-id="' . intval($id) . '"';
        }
        elseif (is_array($downloads)) {
            $ids = array();
            foreach ($downloads as $download) {
                if ($download['tx_vzdownloads_euladata'] > 0) {
                    $ids[] = $download['tx_vzdownloads_euladata'];
                }
            }
            if (count($ids) > 0) {
                return ' data-eula-id="' . implode(',', $ids) . '"';
            }
        }
	}
}
