<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'PIXELINK.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'newsletter',	// Submodule key
		'',						// Position
		array(
			'Newsletter' => 'list, show, create, new',
			
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_newsletter.xlf',
		)
	);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'CleverReach Newsmailer');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pxcleverreach_domain_model_newsletter', 'EXT:px_cleverreach/Resources/Private/Language/locallang_csh_tx_pxcleverreach_domain_model_newsletter.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pxcleverreach_domain_model_newsletter');
$GLOBALS['TCA']['tx_pxcleverreach_domain_model_newsletter'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:px_cleverreach/Resources/Private/Language/locallang_db.xlf:tx_pxcleverreach_domain_model_newsletter',
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
		'searchFields' => 'title,subject,sender_name,sender_email,group_id,page_id,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Newsletter.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_pxcleverreach_domain_model_newsletter.gif'
	),
);
