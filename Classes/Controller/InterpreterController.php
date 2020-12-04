<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/telephonedirectory.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Telephonedirectory\Controller;

use JWeiland\Telephonedirectory\Domain\Repository\LanguageSkillRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller to list language skills
 */
class InterpreterController extends ActionController
{
    /**
     * @var LanguageSkillRepository
     */
    protected $languageSkillRepository;

    /**
     * @param  LanguageSkillRepository $languageSkillRepository
     */
    public function injectLanguageSkillRepository(LanguageSkillRepository $languageSkillRepository): void
    {
        $this->languageSkillRepository = $languageSkillRepository;
    }

    public function initializeAction(): void
    {
        // if this value was not set, then it will be filled with 0
        // but that is not good, because UriBuilder accepts 0 as pid, so it's better to set it to null
        if (empty($this->settings['pidOfDetailPage'])) {
            $this->settings['pidOfDetailPage'] = null;
        }
    }

    public function listAction(): void
    {
        $skills = $this->languageSkillRepository->findAllWithEmployeeRelation();
        $this->view->assign('skills', $skills);
    }
}
