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
    'version' => '6.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
            'maps2' => '12.0.0-12.9.99',
            'checkfaluploads' => '5.0.0-5.9.99',
            'glossary2' => '7.0.0-0.0.0',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
