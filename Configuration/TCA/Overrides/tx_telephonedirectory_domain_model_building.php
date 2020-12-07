<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// Add tx_maps2_uid column to telephone directory table
if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('maps2')) {
    \JWeiland\Maps2\Tca\Maps2Registry::getInstance()->add(
        'telephonedirectory',
        'tx_telephonedirectory_domain_model_building',
        [
            'addressColumns' => ['street', 'house_number', 'zip', 'city'],
            'defaultCountry' => 'Germany',
            'synchronizeColumns' => [
                [
                    'foreignColumnName' => 'title',
                    'poiCollectionColumnName' => 'title'
                ]
            ]
        ]
    );
}
