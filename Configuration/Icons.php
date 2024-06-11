<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'ext-telephonedirectory-employees-wizard-icon' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:telephonedirectory/Resources/Public/Icons/plugin_list_employees.svg',
    ],
    'ext-telephonedirectory-individual-employees-wizard-icon' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:telephonedirectory/Resources/Public/Icons/plugin_list_individual_employees.svg',
    ],
    'ext-telephonedirectory-interpreter-wizard-icon' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:telephonedirectory/Resources/Public/Icons/plugin_list_interpreter.svg',
    ],
];
