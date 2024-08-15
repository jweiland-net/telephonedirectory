<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Controller;

use JWeiland\Telephonedirectory\Traits\InjectLanguageSkillRepositoryTrait;
use Psr\Http\Message\ResponseInterface;

/**
 * Controller to list language skills
 */
class InterpreterController extends AbstractController
{
    use InjectLanguageSkillRepositoryTrait;

    public function initializeAction(): void
    {
        // if this value was not set, then it will be filled with 0
        // but that is not good, because UriBuilder accepts 0 as pid,
        // so it's better to set it to null
        if (empty($this->settings['pidOfDetailPage'])) {
            $this->settings['pidOfDetailPage'] = null;
        }
    }

    public function initializeListAction(): void
    {
        $this->initializeControllerAction();
    }

    public function listAction(): ResponseInterface
    {
        $this->postProcessAndAssignFluidVariables([
            'skills' => $this->languageSkillRepository->findAllWithEmployeeRelation(),
        ]);

        return $this->htmlResponse();
    }
}
