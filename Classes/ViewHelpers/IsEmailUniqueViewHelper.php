<?php
declare(strict_types = 1);
namespace JWeiland\Telephonedirectory\ViewHelpers;

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
        if (empty($email)) {
            return false;
        }
        $amount = $this->employeeRepository->countByEmail($email);

        return $amount === 1;
    }
}
