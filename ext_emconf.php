<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Telephone Directory',
    'description' => 'Telephone Directory',
    'category' => 'plugin',
    'author' => 'Stefan Froemken, Markus Kugler',
    'author_email' => 'projects@jweiland.net',
    'author_company' => 'jweiland.net',
    'state' => 'stable',
    'clearCacheOnLoad' => 0,
    'version' => '3.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-10.4.99',
            'maps2' => '8.0.0-8.9.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ]
];
