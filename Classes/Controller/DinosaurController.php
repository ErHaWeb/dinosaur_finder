<?php

/**
 * This file is part of the "dinosaur_finder" Extension for TYPO3 CMS.
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

declare(strict_types=1);

/**
 * Controller for dinosaur finder plugin
 */

namespace ErHaWeb\DinosaurFinder\Controller;

use ErHaWeb\DinosaurFinder\Service\DinosaurService;
use ErHaWeb\DinosaurFinder\Service\HashService;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class DinosaurController extends ActionController
{
    public function __construct(
        private readonly DinosaurService $dinosaurService
    )
    {
    }

    public function displayAction(): ResponseInterface
    {
        $id = $this->request->getAttribute('currentContentObject')->data['uid'] ?? 0;
        $this->view->assignMultiple([
            'id' => $id,
            'hash' => HashService::getHash($id),
            'languageKey' => $this->request->getAttribute('language')->getLocale()->getLanguageCode(),
            'properties' => $this->dinosaurService->getProperties(),
            'dinosaurs' => $this->dinosaurService->getRecords()
        ]);

        return $this->htmlResponse();
    }
}
