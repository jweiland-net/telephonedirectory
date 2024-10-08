<?php

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

return [
    'ctrl' => [
        'title' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee',
        'label' => 'first_name',
        'label_alt' => 'last_name',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
        'searchFields' => 'first_name,last_name,name_additions,telephone1,telephone2,telephone3,mobile,fax,email,additional_informations',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('telephonedirectory') . 'Configuration/TCA/Employee.php',
        'iconfile' => 'EXT:telephonedirectory/Resources/Public/Icons/tx_telephonedirectory_domain_model_employee.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, path_segment, title, first_name, last_name, name_additions, is_catch_all_mail, company, room_number, function, additional_function, subject_field, telephone1, telephone2, telephone3, mobile, pager, fax, pc_fax, email, additional_informations, regular_attendance, image, office, building, department, language_skill,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.access;access',
        ],
    ],
    'palettes' => [
        'access' => [
            'showitem' => 'starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'foreign_table' => 'tx_telephonedirectory_domain_model_employee',
                'foreign_table_where' => 'AND tx_telephonedirectory_domain_model_employee.pid=###CURRENT_PID### AND tx_telephonedirectory_domain_model_employee.sys_language_uid IN (-1,0)',
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => true,
                    ],
                ],
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
                'default' => '',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0,
            ],
        ],
        'path_segment' => [
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.path_segment',
            'displayCond' => 'VERSION:IS:false',
            'config' => [
                'type' => 'slug',
                'size' => 50,
                'generatorOptions' => [
                    'fields' => ['first_name', 'last_name', 'uid'],
                    // Do not add pageSlug, as we add pageSlug on our own in RouteEnhancer
                    'prefixParentPageSlug' => false,
                    'fieldSeparator' => '-',
                    'replacements' => [
                        '/' => '-',
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'unique',
                'default' => '',
            ],
        ],
        'pid' => [
            'label' => 'pid',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'crdate' => [
            'label' => 'crdate',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'tstamp' => [
            'label' => 'tstamp',
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel',
            'config' => [
                'type' => 'datetime',
                'size' => 16,
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
            'config' => [
                'type' => 'datetime',
                'size' => 16,
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'title' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.title',
            'config' => [
                'type' => 'radio',
                'items' => [
                    [
                        'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.title.0',
                        'value' => 0,
                    ],
                    [
                        'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.title.1',
                        'value' => 1,
                    ],
                ],
            ],
        ],
        'first_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.first_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required',
            ],
        ],
        'last_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.last_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required',
            ],
        ],
        'name_additions' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.name_additions',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'is_catch_all_mail' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.is_catch_all_mail',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'default' => 0,
            ],
        ],
        'subject_field' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.subject_field',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_telephonedirectory_domain_model_subjectfield',
                'minitems' => 0,
                'maxitems' => 1,
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
            ],
        ],
        'additional_function' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.subject_field',
            'config' => [
                'type' => 'category',
            ],
        ],
        'company' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.company',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
            ],
        ],
        'room_number' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.room_number',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'function' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.function',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'regular_attendance' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.regular_attendance',
            'config' => [
                'type' => 'text',
            ],
        ],
        'telephone1' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.telephone1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required',
            ],
        ],
        'telephone2' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.telephone2',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'telephone3' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.telephone3',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'mobile' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.mobile',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'pager' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.pager',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'fax' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.fax',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'pc_fax' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.pc_fax',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'email' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, email',
            ],
        ],
        'additional_informations' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.additional_informations',
            'config' => [
                'type' => 'text',
            ],
        ],
        'image' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.image',
            'config' => [
                'type' => 'file',
                'minitems' => 0,
                'maxitems' => 1,
                'allowed' => 'common-image-types',
            ],
        ],
        'module_sys_dmail_html' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'office' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.office',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_telephonedirectory_domain_model_office',
                'foreign_table_where' => 'ORDER BY tx_telephonedirectory_domain_model_office.title',
                'minitems' => 1,
                'maxitems' => 1,
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
            ],
        ],
        'building' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.building',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_telephonedirectory_domain_model_building',
                'foreign_table_where' => 'ORDER BY tx_telephonedirectory_domain_model_building.title',
                'minitems' => 1,
                'maxitems' => 1,
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
            ],
        ],
        'department' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_employee.department',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_telephonedirectory_domain_model_department',
                'foreign_table_where' => 'ORDER BY tx_telephonedirectory_domain_model_department.title',
                'minitems' => 0,
                'maxitems' => 1,
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
            ],
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
                    'showAllLocalizationLink' => 1,
                ],
            ],
        ],
    ],
];
