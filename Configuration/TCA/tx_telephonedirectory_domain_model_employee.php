<?php
return array(
    'ctrl' => array(
        'title' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee',
        'label' => 'first_name',
        'label_alt' => 'last_name',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'versioningWS' => 2,
        'versioning_followPages' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'first_name,last_name,name_additions,subject_field,telephone1,telephone2,telephone3,mobile,fax,email,additional_informations,office,building,department,language_skill,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('telephonedirectory') . 'Configuration/TCA/Employee.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('telephonedirectory') . 'Resources/Public/Icons/tx_telephonedirectory_domain_model_employee.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, first_name, last_name, name_additions, company, room_number, function, additional_function, subject_field, telephone1, telephone2, telephone3, mobile, pager, fax, pc_fax, email, additional_informations, image, office, building, department, language_skill',
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
                'foreign_table' => 'tx_telephonedirectory_domain_model_employee',
                'foreign_table_where' => 'AND tx_telephonedirectory_domain_model_employee.pid=###CURRENT_PID### AND tx_telephonedirectory_domain_model_employee.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.title',
            'config' => array(
                'type' => 'radio',
                'items' => array(
                    array(
                        'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.title.0',
                        0
                    ),
                    array(
                        'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.title.1',
                        1
                    ),
                )
            )
        ),
        'first_name' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.first_name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required'
            ),
        ),
        'last_name' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.last_name',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required'
            ),
        ),
        'name_additions' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.name_additions',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'subject_field' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.subject_field',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'company' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.company',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'room_number' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.room_number',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required'
            ),
        ),
        'function' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.function',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'additional_function' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.additional_function',
            'config' => array(
                'type' => 'select',
                'size' => 1,
                'items' => array(
                    array('', ''),
                    array('Leiternbeauftragter', 'Leiternbeauftragter'),
                    array('Datenschutzbeauftragter', 'Datenschutzbeauftragter'),
                    array('DV-Beauftragter', 'DV-Beauftragter'),
                    array('Ersthelfer', 'Ersthelfer'),
                    array('Brandschutzhelfer', 'Brandschutzhelfer'),
                    array('Sicherheitsbeauftragter', 'Sicherheitsbeauftragter'),
                    array('Azubi-Beauftragter', 'Azubi-Beauftragter'),
                    array('Strahlenschutzbeauftragter', 'Strahlenschutzbeauftragter'),
                    array('Gefahrgutbeauftragter', 'Gefahrgutbeauftragter'),
                    array('Explosionsschutzbeauftragter', 'Explosionsschutzbeauftragter'),
                ),
            ),
        ),
        'regular_attendance' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.regular_attendance',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            )
        ),
        'telephone1' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.telephone1',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required'
            ),
        ),
        'telephone2' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.telephone2',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'telephone3' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.telephone3',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'mobile' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.mobile',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'pager' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.pager',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'fax' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.fax',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'pc_fax' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.pc_fax',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'email' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.email',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, email'
            ),
        ),
        'additional_informations' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.additional_informations',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'image' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.image',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'file',
                'uploadfolder' => 'uploads/tx_telephonedirectory',
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
                'show_thumbs' => true,
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 0,
            ),
        ),
        'module_sys_dmail_html' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        'office' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.office',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_telephonedirectory_domain_model_office',
                'foreign_table_where' => 'ORDER BY tx_telephonedirectory_domain_model_office.title',
                'minitems' => 1,
                'maxitems' => 1,
            ),
        ),
        'building' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.building',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_telephonedirectory_domain_model_building',
                'foreign_table_where' => 'ORDER BY tx_telephonedirectory_domain_model_building.title',
                'minitems' => 1,
                'maxitems' => 1,
            ),
        ),
        'department' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.department',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_telephonedirectory_domain_model_department',
                'foreign_table_where' => 'ORDER BY tx_telephonedirectory_domain_model_department.title',
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
        'language_skill' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.language_skill',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tx_telephonedirectory_domain_model_languageskill',
                'foreign_field' => 'employee',
                'maxitems' => 9999,
                'appearance' => array(
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ),
            ),
        ),
    ),
    'types' => array(
        '1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, first_name, last_name, name_additions, company, room_number, function, additional_function, subject_field, telephone1, telephone2, telephone3, mobile, pager, fax, pc_fax, email, additional_informations, regular_attendance, image, office, building, department, language_skill,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
);
