<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\ViewHelpers;

use JWeiland\Telephonedirectory\Domain\Repository\EmployeeRepository;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ViewHelper to check, if an email is unique in employee table
 */
class IsEmailUniqueViewHelper extends AbstractViewHelper
{
    /**
     * @var EmployeeRepository
     */
    protected $employeeRepository;

    /**
     * @param EmployeeRepository $employeeRepository
     */
    public function injectEmployeeRepository(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Initialize all arguments.
     */
    public function initializeArguments()
    {
        $this->registerArgument(
            'email',
            'string',
            'Sets the email address which should be checked for duplication',
            false,
            ''
        );
    }

    /**
     * Implements a ViewHelper which checks if a given email address is unique in DB
     *
     * @return bool
     */
    public function render(): bool
    {
        if (empty($this->arguments['email'])) {
            return false;
        }
        $amount = $this->employeeRepository->countByEmail($this->arguments['email']);

        return $amount === 1;
    }
}
