<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Configuration;

use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\SingletonInterface;

/**
 * Class with all properties of Extensionmanager Configuration
 */
#[Autoconfigure(constructor: 'create')]
readonly class ExtConf implements SingletonInterface
{
    public const EXT_KEY = 'telephonedirectory';

    private const DEFAULT_SETTINGS = [
        'emailContact' => '',
        'emailFromAddress' => '',
        'emailFromName' => '',
        'additionalFunctionsParentCategoryUid' => 0,
        'additionalSecretForHashGeneration' => '',
    ];

    public function __construct(
        private string $emailContact = self::DEFAULT_SETTINGS['emailContact'],
        private string $emailFromAddress = self::DEFAULT_SETTINGS['emailFromAddress'],
        private string $emailFromName = self::DEFAULT_SETTINGS['emailFromName'],
        private int $additionalFunctionsParentCategoryUid = self::DEFAULT_SETTINGS['additionalFunctionsParentCategoryUid'],
        private string $additionalSecretForHashGeneration = self::DEFAULT_SETTINGS['additionalSecretForHashGeneration'],
    ) {}

    public static function create(ExtensionConfiguration $extensionConfiguration): self
    {
        $extensionSettings = self::DEFAULT_SETTINGS;

        try {
            $extensionSettings = array_merge(
                $extensionSettings,
                $extensionConfiguration->get(self::EXT_KEY),
            );
        } catch (ExtensionConfigurationExtensionNotConfiguredException | ExtensionConfigurationPathDoesNotExistException $exception) {
        }

        return new self(
            emailContact: (string)$extensionSettings['emailContact'],
            emailFromAddress: (string)$extensionSettings['emailFromAddress'],
            emailFromName: (string)$extensionSettings['emailFromName'],
            additionalFunctionsParentCategoryUid: (int)$extensionSettings['additionalFunctionsParentCategoryUid'],
            additionalSecretForHashGeneration: (string)$extensionSettings['additionalSecretForHashGeneration'],
        );
    }

    /**
     * @throws \Exception
     */
    public function getEmailContact(): string
    {
        if ($this->emailContact === '') {
            $fallbackEmailContact = $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'];
            if ($fallbackEmailContact === '') {
                throw new \Exception(
                    'You have forgotten to set a sender email address in extension configuration or in install tool',
                    1706178058,
                );
            }

            return $fallbackEmailContact;
        }

        return $this->emailContact;
    }

    /**
     * @throws \Exception
     */
    public function getEmailFromAddress(): string
    {
        if ($this->emailFromAddress === '') {
            $fallbackEmailFromAddress = $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'];
            if ($fallbackEmailFromAddress === '') {
                throw new \Exception(
                    'You have forgotten to set a sender email address in extension configuration or in install tool',
                    1706178074,
                );
            }

            return $fallbackEmailFromAddress;
        }

        return $this->emailFromAddress;
    }

    /**
     * @throws \Exception
     */
    public function getEmailFromName(): string
    {
        if ($this->emailFromName === '') {
            $fallbackEmailFromName = $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromName'];
            if ($fallbackEmailFromName === '') {
                throw new \Exception(
                    'You have forgotten to set a sender name in extension configuration or in install tool',
                    1706178086,
                );
            }

            return $fallbackEmailFromName;
        }

        return $this->emailFromName;
    }

    public function getAdditionalFunctionsParentCategoryUid(): int
    {
        return $this->additionalFunctionsParentCategoryUid;
    }

    public function getAdditionalSecretForHashGeneration(): string
    {
        return $this->additionalSecretForHashGeneration;
    }
}
