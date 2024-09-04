<?php

use ErHaWeb\DinosaurFinder\Middleware\AjaxMiddleware;

return [
    'frontend' => [
        'erhaweb/dinosaur-finder/ajax' => [
            'target' => AjaxMiddleware::class,
            'before' => [
                'typo3/cms-redirects/redirecthandler',
            ],
            'after' => [
                'typo3/cms-frontend/authentication'
            ],
        ],
    ],
];
