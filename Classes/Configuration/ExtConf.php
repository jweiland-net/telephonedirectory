<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Configuration;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class with all properties of Extensionmanager Configuration
 */
class ExtConf implements SingletonInterface
{
    /**
     * @var string
     */
    protected $emailContact = '';

    /**
     * @var string
     */
    protected $emailFromAddress = '';

    /**
     * @var string
     */
    protected $emailFromName = '';

    /**
     * @var int
     */
    protected $additionalFunctionsParentCategoryUid = 0;

    public function __construct()
    {
        // get global configuration
        $extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('telephonedirectory');
        if (is_array($extConf) && count($extConf)) {
            // call setter method foreach configuration entry
            foreach ($extConf as $key => $value) {
                $methodName = 'set' . ucfirst($key);
                if (method_exists($this, $methodName)) {
                    $this->$methodName($value);
                }
            }
        }
    }

    public function getEmailContact(): string
    {
        if (empty($this->emailContact)) {
            $senderMail = $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'];
            if (empty($senderMail)) {
                throw new \Exception('You have forgotten to set a sender email address in extension configuration or in install tool');
            }

            return $senderMail;
        }
        return $this->emailContact;
    }

    public function setEmailContact(string $emailContact): self
    {
        $this->emailContact = $emailContact;
        return $this;
    }

    public function getEmailFromAddress(): string
    {
        if (empty($this->emailFromAddress)) {
            $senderMail = $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'];
            if (empty($senderMail)) {
                throw new \Exception('You have forgotten to set a sender email address in extension configuration or in install tool');
            }

            return $senderMail;
        }
        return $this->emailFromAddress;
    }

    public function setEmailFromAddress(string $emailFromAddress): self
    {
        $this->emailFromAddress = $emailFromAddress;
        return $this;
    }

    public function getEmailFromName(): string
    {
        if (empty($this->emailFromName)) {
            $senderName = $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromName'];
            if (empty($senderName)) {
                throw new \Exception('You have forgotten to set a sender name in extension configuration or in install tool');
            }

            return $senderName;
        }
        return $this->emailFromName;
    }

    public function setEmailFromName(string $emailFromName): self
    {
        $this->emailFromName = $emailFromName;
        return $this;
    }

    public function getAdditionalFunctionsParentCategoryUid(): int
    {
        return $this->additionalFunctionsParentCategoryUid;
    }

    public function setAdditionalFunctionsParentCategoryUid($additionalFunctionsParentCategoryUid): self
    {
        $this->additionalFunctionsParentCategoryUid = (int)$additionalFunctionsParentCategoryUid;
        return $this;
    }
}
