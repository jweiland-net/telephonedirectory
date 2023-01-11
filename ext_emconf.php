<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Telephone Directory',
    'description' => 'Telephone Directory',
    'category' => 'plugin',
    'author' => 'Stefan Froemken, Markus Kugler',
    'author_email' => 'projects@jweiland.net',
    'author_company' => 'jweiland.net',
    'state' => 'stable',
    'version' => '4.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.33-11.5.99',
            'maps2' => '8.0.0-8.9.99'
        ],
        'conflicts' => [],
        'suggests' => [
            'checkfaluploads' => ''
        ]
    ]
];
