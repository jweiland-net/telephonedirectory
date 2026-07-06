<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Domain\Validator;

use JWeiland\Telephonedirectory\Configuration\ExtConf;
use JWeiland\Telephonedirectory\Domain\Model\Employee;
use TYPO3\CMS\Core\Crypto\HashService;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Mvc\ExtbaseRequestParameters;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

class EmployeeValidator extends AbstractValidator
{
    public function __construct(
        private readonly HashService $hashService,
        private readonly ExtConf $extConf,
    ) {}

    /**
     * @param Employee|mixed $value
     */
    protected function isValid(mixed $value): void
    {
        try {
            $hash = (string)$this->getExtbaseRequestParameters()?->getArgument('hash');
            if ($hash === '') {
                $this->addError('Hash for employee validation is empty', 1775811751);
            }

            if (!$this->isValidHmac($value, $hash)) {
                $this->addErrorForProperty(
                    'secret',
                    'Hash for employee is invalid',
                    1775812029,
                );
            }
        } catch (NoSuchArgumentException $e) {
            $this->addError('Hash for employee validation is missing', 1775811698);
        }
    }

    private function isValidHmac(Employee $employee, string $hash): bool
    {
        return $this->hashService->validateHmac(
            'Employee:' . $employee->getUid(),
            $this->extConf->getAdditionalSecretForHashGeneration(),
            $hash,
        );
    }

    private function getExtbaseRequestParameters(): ?ExtbaseRequestParameters
    {
        return $this->request->getAttribute('extbase');
    }
}
