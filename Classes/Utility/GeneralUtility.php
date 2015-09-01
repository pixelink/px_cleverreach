<?php
namespace PIXELINK\PxCleverreach\Utility;
/**
 * Created by PhpStorm.
 * User: luki
 * Date: 09.01.15
 * Time: 15:02
 */
class GeneralUtility {

	/**
	 * Initializes the TSFE for a given page ID and language.
	 *
	 * @param integer The page id to initialize the TSFE for
	 * @param integer System language uid, optional, defaults to 0
	 * @param boolean Use cache to reuse TSFE
	 * @return void
	 */
	public static function initializeTsfe($pageId, $language = 0, $useCache = TRUE) {
		static $tsfeCache = array();

// resetting, a TSFE instance with data from a different page Id could be set already
		unset($GLOBALS['TSFE']);

		$cacheId = $pageId . '|' . $language;

		if (!is_object($GLOBALS['TT'])) {
			$GLOBALS['TT'] = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_TimeTrackNull');
		}

		if (!isset($tsfeCache[$cacheId]) || !$useCache) {
			\TYPO3\CMS\Core\Utility\GeneralUtility::_GETset($language, 'L');

			$GLOBALS['TSFE'] = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tslib_fe', $GLOBALS['TYPO3_CONF_VARS'], $pageId, 0);

// for certain situations we need to trick TSFE into granting us
// access to the page in any case to make getPageAndRootline() work
// see http://forge.typo3.org/issues/42122
			$pageRecord = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('pages', $pageId);
			$groupListBackup = $GLOBALS['TSFE']->gr_list;
			$GLOBALS['TSFE']->gr_list = $pageRecord['fe_group'];

			$GLOBALS['TSFE']->sys_page = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_pageSelect');
			$GLOBALS['TSFE']->getPageAndRootline();

// restore gr_list
			$GLOBALS['TSFE']->gr_list = $groupListBackup;

			$GLOBALS['TSFE']->initTemplate();
			$GLOBALS['TSFE']->forceTemplateParsing = TRUE;
			$GLOBALS['TSFE']->initFEuser();
			$GLOBALS['TSFE']->initUserGroups();
// $GLOBALS['TSFE']->getCompressedTCarray(); // seems to cause conflicts sometimes

			$GLOBALS['TSFE']->no_cache = TRUE;
			$GLOBALS['TSFE']->tmpl->start($GLOBALS['TSFE']->rootLine);
			$GLOBALS['TSFE']->no_cache = FALSE;
			$GLOBALS['TSFE']->getConfigArray();

			$GLOBALS['TSFE']->settingLanguage();
			$GLOBALS['TSFE']->newCObj();
			$GLOBALS['TSFE']->absRefPrefix = ($GLOBALS['TSFE']->config['config']['absRefPrefix'] ? trim($GLOBALS['TSFE']->config['config']['absRefPrefix']) : '');

			if ($useCache) {
				$tsfeCache[$cacheId] = $GLOBALS['TSFE'];
			}
		}

		if ($useCache) {
			$GLOBALS['TSFE'] = $tsfeCache[$cacheId];
		}
	}
}