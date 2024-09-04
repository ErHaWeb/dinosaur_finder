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

namespace ErHaWeb\DinosaurFinder\Middleware;

use ErHaWeb\DinosaurFinder\Service\DinosaurService;
use ErHaWeb\DinosaurFinder\Service\HashService;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\JsonResponse;

readonly class AjaxMiddleware implements MiddlewareInterface
{
    public function __construct(
        private DinosaurService $dinosaurService
    )
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->getRequestTarget() === '/tx_dinosaurfinder') {
            $inputJSON = file_get_contents('php://input');

            try {
                $data = json_decode($inputJSON, TRUE, 512, JSON_THROW_ON_ERROR);
            } catch (JsonException) {
                return $handler->handle($request);
            }

            if (!HashService::validateHash((int)$data['id'], $data['hash'])) {
                throw new \UnexpectedValueException('Invalid hash');
            }

            $constraints = $data['constraints'] ?? [];
            $languageKey = $data['languageKey'] ?? '';

            $response = [
                'constraints' => $constraints,
                'properties' => $this->dinosaurService->getRenderedPropertiesByConstraints($constraints, $languageKey),
                'dinosaurs' => $this->dinosaurService->getRenderedRecordsByConstraints($constraints, $languageKey)
            ];

            return new JsonResponse($response);
        }
        return $handler->handle($request);
    }
}
