<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Telephone Directory',
    'description' => 'Telephone Directory',
    'category' => 'plugin',
    'author' => 'Stefan Froemken, Markus Kugler',
    'author_email' => 'projects@jweiland.net',
    'author_company' => 'jweiland.net',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '1',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '1.1.1',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-8.7.99',
            'maps2' => '4.2.0-4.99.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];
