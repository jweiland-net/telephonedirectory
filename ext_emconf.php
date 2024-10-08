<?php

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'Telephone Directory',
    'description' => 'Telephone Directory',
    'category' => 'plugin',
    'author' => 'Stefan Froemken, Hoja Mustaffa Abdul Latheef',
    'author_email' => 'projects@jweiland.net',
    'author_company' => 'jweiland.net',
    'state' => 'stable',
    'version' => '5.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
            'maps2' => '11.0.0-11.9.99',
            'checkfaluploads' => '4.0.0-4.9.99',
            'glossary2' => '6.0.0-0.0.0',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
