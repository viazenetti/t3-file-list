<?php
namespace VZ\VzDownloads\ViewHelpers;

class AddEulaTagViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


	/**
	 * @param string $id
     * @param boolean $getAllIds
     * @param boolean $resetIds
	 * @return string
	 */
	public function render($id = NULL, $getAllIds = false, $resetIds = false) {

        if (!isset($GLOBALS['T3_VAR']['EXT']['tx_vzdownloads']['eulaIds'])) {
            $GLOBALS['T3_VAR']['EXT']['tx_vzdownloads']['eulaIds'] = array();
        }

        if ((int)$id > 0) {
            $ids = intval($id);
            $GLOBALS['T3_VAR']['EXT']['tx_vzdownloads']['eulaIds'][] = $ids;
        }

        if ($getAllIds) {
            $ids = implode(',', array_unique($GLOBALS['T3_VAR']['EXT']['tx_vzdownloads']['eulaIds'], SORT_NUMERIC));
        }

        if ($resetIds) {
            unset($GLOBALS['T3_VAR']['EXT']['tx_vzdownloads']['eulaIds']);
        }

        if (isset($ids)) {
            return ' data-eula-id="' . $ids . '"';
        }

        return '';
	}
}
