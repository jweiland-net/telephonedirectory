<?php
return [
    'ctrl' => [
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
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime'
        ],
        'searchFields' => 'first_name,last_name,name_additions,subject_field,telephone1,telephone2,telephone3,mobile,fax,email,additional_informations,office,building,department,language_skill,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('telephonedirectory') . 'Configuration/TCA/Employee.php',
        'iconfile' => 'EXT:telephonedirectory/Resources/Public/Icons/tx_telephonedirectory_domain_model_employee.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, first_name, last_name, name_additions, company, room_number, function, additional_function, subject_field, telephone1, telephone2, telephone3, mobile, pager, fax, pc_fax, email, additional_informations, image, office, building, department, language_skill'
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
                ]
            ]
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0]
                ],
                'foreign_table' => 'tx_telephonedirectory_domain_model_employee',
                'foreign_table_where' => 'AND tx_telephonedirectory_domain_model_employee.pid=###CURRENT_PID### AND tx_telephonedirectory_domain_model_employee.sys_language_uid IN (-1,0)'
            ]
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check'
            ]
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ]
            ]
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ]
            ]
        ],
        'title' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.title',
            'config' => [
                'type' => 'radio',
                'items' => [
                    [
                        'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.title.0',
                        0
                    ],
                    [
                        'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.title.1',
                        1
                    ]
                ]
            ]
        ],
        'first_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.first_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required'
            ]
        ],
        'last_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.last_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required'
            ]
        ],
        'name_additions' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.name_additions',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'is_catch_all_mail' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.is_catch_all_mail',
            'config' => [
                'type' => 'check'
            ]
        ],
        'subject_field' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.subject_field',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_telephonedirectory_domain_model_subjectfield',
                'minitems' => 0,
                'maxitems' => 1
            ]
        ],
        'company' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.company',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'room_number' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.room_number',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'function' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.function',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'regular_attendance' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.regular_attendance',
            'config' => [
                'type' => 'check'
            ]
        ],
        'telephone1' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.telephone1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required'
            ]
        ],
        'telephone2' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.telephone2',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'telephone3' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.telephone3',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'mobile' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.mobile',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'pager' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.pager',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'fax' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.fax',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'pc_fax' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.pc_fax',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'email' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, email'
            ]
        ],
        'additional_informations' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.additional_informations',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'image' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.image',
            'config' => [
                'type' => 'group',
                'internal_type' => 'file',
                'uploadfolder' => 'uploads/tx_telephonedirectory',
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
                'show_thumbs' => true,
                'size' => 1,
                'maxitems' => 1,
                'minitems' => 0
            ]
        ],
        'module_sys_dmail_html' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'office' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.office',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_telephonedirectory_domain_model_office',
                'foreign_table_where' => 'ORDER BY tx_telephonedirectory_domain_model_office.title',
                'minitems' => 1,
                'maxitems' => 1
            ]
        ],
        'building' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.building',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_telephonedirectory_domain_model_building',
                'foreign_table_where' => 'ORDER BY tx_telephonedirectory_domain_model_building.title',
                'minitems' => 1,
                'maxitems' => 1
            ]
        ],
        'department' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.department',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_telephonedirectory_domain_model_department',
                'foreign_table_where' => 'ORDER BY tx_telephonedirectory_domain_model_department.title',
                'minitems' => 0,
                'maxitems' => 1
            ]
        ],
        'language_skill' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.language_skill',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_telephonedirectory_domain_model_languageskill',
                'foreign_field' => 'employee',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ]
            ]
        ]
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, first_name, last_name, name_additions, is_catch_all_mail, company, room_number, function, additional_function, subject_field, telephone1, telephone2, telephone3, mobile, pager, fax, pc_fax, email, additional_informations, regular_attendance, image, office, building, department, language_skill,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime']
    ],
    'palettes' => [
        '1' => ['showitem' => '']
    ]
];
