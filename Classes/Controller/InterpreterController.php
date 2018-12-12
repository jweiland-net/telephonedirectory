<?php
declare(strict_types=1);
namespace JWeiland\Telephonedirectory\Controller;

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
use JWeiland\Telephonedirectory\Domain\Repository\LanguageSkillRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class InterpreterController
 */
class InterpreterController extends ActionController
{
    /**
     * @var LanguageSkillRepository
     */
    protected $languageSkillRepository;

    /**
     * inject languageSkillRepository
     *
     * @param  LanguageSkillRepository $languageSkillRepository
     * @return void
     */
    public function injectLanguageSkillRepository(LanguageSkillRepository $languageSkillRepository)
    {
        $this->languageSkillRepository = $languageSkillRepository;
    }

    /**
     * preprocessing of all actions
     *
     * @return void
     */
    public function initializeAction()
    {
        // if this value was not set, then it will be filled with 0
        // but that is not good, because UriBuilder accepts 0 as pid, so it's better to set it to NULL
        if (empty($this->settings['pidOfDetailPage'])) {
            $this->settings['pidOfDetailPage'] = null;
        }
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $skills = $this->languageSkillRepository->findAllWithEmployeeRelation();
        $this->view->assign('skills', $skills);
    }
}
