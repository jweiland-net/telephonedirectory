<?php

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

return [
    'ctrl' => [
        'title' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_office',
        'label' => 'title',
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
        'searchFields' => 'title,subject_field,',
        'iconfile' => 'EXT:telephonedirectory/Resources/Public/Icons/tx_telephonedirectory_domain_model_office.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, code, token, departments, subject_fields,
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
                'foreign_table' => 'tx_telephonedirectory_domain_model_office',
                'foreign_table_where' => 'AND tx_telephonedirectory_domain_model_office.pid=###CURRENT_PID### AND tx_telephonedirectory_domain_model_office.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_office.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'code' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_office.code',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'token' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_office.token',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'departments' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_office.department',
            'config' => [
                'type' => 'group',
                'allowed' => 'tx_telephonedirectory_domain_model_department',
                'MM' => 'tx_telephonedirectory_domain_model_office_department_mm',
            ],
        ],
        'subject_fields' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:telephonedirectory/Resources/Private/Language/locallang_db.xlf:tx_telephonedirectory_domain_model_office.subject_field',
            'config' => [
                'type' => 'group',
                'allowed' => 'tx_telephonedirectory_domain_model_subjectfield',
                'MM' => 'tx_telephonedirectory_domain_model_office_subjectfield_mm',
            ],
        ],
    ],
];
