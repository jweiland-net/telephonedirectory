<?php
declare(strict_types=1);
namespace JWeiland\Telephonedirectory\Configuration;

/*
 * This file is part of the telephonedirectory project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\SingletonInterface;

/**
 * Class with all properties of Extensionmanager Configuration
 */
class ExtConf implements SingletonInterface
{
    /**
     * email of contact
     *
     * @var string
     */
    protected $emailContact = '';

    /**
     * email from address
     *
     * @var string
     */
    protected $emailFromAddress = '';

    /**
     * email from name
     *
     * @var string
     */
    protected $emailFromName = '';

    /**
     * @var int
     */
    protected $additionalFunctionsParentCategoryUid = 0;

    /**
     * constructor of this class
     * This method reads the global configuration and calls the setter methods
     */
    public function __construct()
    {
        // get global configuration
        $extConf = \unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['telephonedirectory']);
        if (\is_array($extConf) && \count($extConf)) {
            // call setter method foreach configuration entry
            foreach ($extConf as $key => $value) {
                $methodName = 'set' . \ucfirst($key);
                if (\method_exists($this, $methodName)) {
                    $this->$methodName($value);
                }
            }
        }
    }

    /**
     * @return string
     */
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

    /**
     * @param string $emailContact
     */
    public function setEmailContact(string $emailContact)
    {
        $this->emailContact = $emailContact;
    }

    /**
     * getter for email from address
     *
     * @throws \Exception
     * @return string
     */
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

    /**
     * setter for email from address
     *
     * @param string $emailFromAddress
     * @return void
     */
    public function setEmailFromAddress(string $emailFromAddress)
    {
        $this->emailFromAddress = $emailFromAddress;
    }

    /**
     * getter for email from name
     *
     * @throws \Exception
     * @return string
     */
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

    /**
     * setter for emailFromName
     *
     * @param string $emailFromName
     * @return void
     */
    public function setEmailFromName(string $emailFromName)
    {
        $this->emailFromName = $emailFromName;
    }

    /**
     * @return int
     */
    public function getAdditionalFunctionsParentCategoryUid(): int
    {
        return $this->additionalFunctionsParentCategoryUid;
    }

    /**
     * @param int $additionalFunctionsParentCategoryUid
     */
    public function setAdditionalFunctionsParentCategoryUid($additionalFunctionsParentCategoryUid)
    {
        $this->additionalFunctionsParentCategoryUid = (int)$additionalFunctionsParentCategoryUid;
    }
}
