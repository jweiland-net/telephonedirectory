<?php
namespace JWeiland\Telephonedirectory\Controller;

/***************************************************************
 *  Copyright notice
 *  (c) 2013 Stefan Froemken <sfroemken@gmail.com>, jweiland.net
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @package telephonedirectory
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class InterpreterController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * languageSkillRepository
     *
     * @var \JWeiland\Telephonedirectory\Domain\Repository\LanguageSkillRepository
     * @inject
     */
    protected $languageSkillRepository;

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
        $skills = $this->languageSkillRepository->findAll();
        $this->view->assign('skills', $skills);
    }
}
