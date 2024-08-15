<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Configuration;

use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * Class with all properties of Extensionmanager Configuration
 */
class ExtConf implements SingletonInterface
{
    protected string $emailContact = '';

    protected string $emailFromAddress = '';

    protected string $emailFromName = '';

    protected int $additionalFunctionsParentCategoryUid = 0;

    public function __construct(readonly ExtensionConfiguration $extensionConfiguration)
    {
        $extConf = [];

        try {
            $extConf = (array)$extensionConfiguration->get('telephonedirectory');
        } catch (ExtensionConfigurationExtensionNotConfiguredException | ExtensionConfigurationPathDoesNotExistException $exception) {
        }

        if ($extConf === []) {
            return;
        }

        // call setter method foreach configuration entry
        foreach ($extConf as $key => $value) {
            $methodName = 'set' . ucfirst($key);
            if (method_exists($this, $methodName)) {
                $this->$methodName($value);
            }
        }
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

    public function setEmailContact(string $emailContact): void
    {
        $this->emailContact = $emailContact;
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

    public function setEmailFromAddress(string $emailFromAddress): void
    {
        $this->emailFromAddress = $emailFromAddress;
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

    public function setEmailFromName(string $emailFromName): void
    {
        $this->emailFromName = $emailFromName;
    }

    public function getAdditionalFunctionsParentCategoryUid(): int
    {
        return $this->additionalFunctionsParentCategoryUid;
    }

    public function setAdditionalFunctionsParentCategoryUid(string $additionalFunctionsParentCategoryUid): void
    {
        if (MathUtility::canBeInterpretedAsInteger($additionalFunctionsParentCategoryUid)) {
            $this->additionalFunctionsParentCategoryUid = (int)$additionalFunctionsParentCategoryUid;
        }
    }
}
