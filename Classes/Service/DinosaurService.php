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

namespace ErHaWeb\DinosaurFinder\Service;

use Doctrine\DBAL\Exception;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Fluid\View\StandaloneView;

readonly class DinosaurService
{
    public const TABLENAME = 'tx_dinosaurfinder_dinosaur';
    public const PROPERTIES = ['diet', 'size', 'weight', 'era', 'region', 'discovery_year', 'discoverer'];

    public const NAME_FIELD = 'name';

    public const GENERAL_FIELDS = ['uid', 'slug'];

    public function __construct(
        private ConnectionPool $connectionPool,
        private StandaloneView $view
    )
    {
        $this->view->setPartialRootPaths(['EXT:dinosaur_finder/Resources/Private/Partials']);
    }

    public function getProperties(): array
    {
        return $this->getPropertiesByConstraints([]);
    }

    public function getRenderedPropertiesByConstraints(array $constraints, $languageKey): string
    {
        $properties = $this->getPropertiesByConstraints($constraints);
        if (count($properties) > 0) {
            $this->view->assignMultiple([
                'languageKey' => $languageKey,
                'constraints' => $constraints,
                'properties' => $properties
            ]);
            $this->view->setTemplateSource('{f:render(partial: \'Properties\', arguments: \'{constraints:constraints,languageKey:languageKey,properties:properties}\')}');
            return $this->view->render();
        }
        return '';
    }

    public function getPropertiesByConstraints(array $constraints): array
    {
        $Properties = [];
        foreach (self::PROPERTIES as $property) {
            $Properties[$property] = $this->getPropertyValuesByConstraints($property, $constraints);
        }
        return $Properties;
    }

    public function getPropertyValuesByConstraints(string $property, array $constraints): array
    {
        $values = [];
        $rawValues = $this->getRecords([$property], $constraints, [$property]);
        foreach ($rawValues as $rawValue) {
            $values[] = $rawValue[$property];
        }
        return $values;
    }

    public function getRenderedRecordsByConstraints(array $constraints, $languageKey): string
    {
        $dinosaurs = $this->getRecordsByConstraints($constraints);
        if (count($dinosaurs) > 0) {
            $this->view->assignMultiple([
                'languageKey' => $languageKey,
                'constraints' => $constraints,
                'dinosaurs' => $dinosaurs
            ]);
            $this->view->setTemplateSource('{f:render(partial: \'Records\', arguments: \'{constraints:constraints,languageKey:languageKey,dinosaurs:dinosaurs}\')}');
            return $this->view->render();
        }
        return '';
    }

    public function getRecordsByConstraints(array $constraints): array
    {
        $select = array_merge([self::NAME_FIELD], self::PROPERTIES);
        return $this->getRecords($select, $constraints);
    }

    public function getRecords(array $select = [], array $constraints = [], array $groupBy = []): array
    {
        if (!$select) {
            $select = array_merge(self::GENERAL_FIELDS, [self::NAME_FIELD], self::PROPERTIES);
        }

        $queryBuilder = $this->connectionPool->getQueryBuilderForTable(self::TABLENAME);
        $queryBuilder->select(...$select);
        $queryBuilder->from(self::TABLENAME);

        if ($constraints) {
            $where = [];
            foreach ($constraints as $key => $value) {
                if (str_ends_with($key, '_min')) {
                    $where[] = $queryBuilder->expr()->gte(rtrim($key, '_min'), $queryBuilder->createNamedParameter($value, Connection::PARAM_STR));
                } elseif (str_ends_with($key, '_max')) {
                    $where[] = $queryBuilder->expr()->lte(rtrim($key, '_max'), $queryBuilder->createNamedParameter($value, Connection::PARAM_STR));
                } else {
                    $where[] = $queryBuilder->expr()->eq($key, $queryBuilder->createNamedParameter($value, Connection::PARAM_STR));
                }
            }
            $queryBuilder->where(...$where);
        }

        if ($groupBy) {
            $queryBuilder->groupBy(...$groupBy);
            $queryBuilder->orderBy(...$groupBy);
        } else {
            $queryBuilder->orderBy(self::NAME_FIELD);
        }

        $queryBuilder->executeQuery();

        try {
            return $queryBuilder->fetchAllAssociative();
        } catch (Exception) {
            return [];
        }
    }
}
