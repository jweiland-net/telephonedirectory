<?php
declare(strict_types=1);
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
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

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
     * Injects employee repository
     *
     * @param EmployeeRepository $employeeRepository
     */
    public function injectEmployeeRepository(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * implements a vievHelper which checks if a given email address is unique in DB
     *
     * @param string $email
     * @return bool
     */
    public function render($email = ''): bool
    {
        if (empty($email)) {
            return false;
        }
        $amount = $this->employeeRepository->countByEmail($email);

        return $amount === 1;
    }
}
