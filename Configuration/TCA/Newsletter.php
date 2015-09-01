<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_pxcleverreach_domain_model_newsletter'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_pxcleverreach_domain_model_newsletter']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, subject, sender_name, sender_email, group_id, group_name',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, subject, sender_name, sender_email, group_id, group_name, email_id, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_pxcleverreach_domain_model_newsletter',
				'foreign_table_where' => 'AND tx_pxcleverreach_domain_model_newsletter.pid=###CURRENT_PID### AND tx_pxcleverreach_domain_model_newsletter.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:px_cleverreach/Resources/Private/Language/locallang_db.xlf:tx_pxcleverreach_domain_model_newsletter.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'subject' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:px_cleverreach/Resources/Private/Language/locallang_db.xlf:tx_pxcleverreach_domain_model_newsletter.subject',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'sender_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:px_cleverreach/Resources/Private/Language/locallang_db.xlf:tx_pxcleverreach_domain_model_newsletter.sender_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'sender_email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:px_cleverreach/Resources/Private/Language/locallang_db.xlf:tx_pxcleverreach_domain_model_newsletter.sender_email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'group_id' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:px_cleverreach/Resources/Private/Language/locallang_db.xlf:tx_pxcleverreach_domain_model_newsletter.group_id',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'group_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:px_cleverreach/Resources/Private/Language/locallang_db.xlf:tx_pxcleverreach_domain_model_newsletter.group_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email_id' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:px_cleverreach/Resources/Private/Language/locallang_db.xlf:tx_pxcleverreach_domain_model_newsletter.email_id',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
				'readOnly' =>1,
			),
		),

	),
);
