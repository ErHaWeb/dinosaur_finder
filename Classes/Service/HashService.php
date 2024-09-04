<?php

namespace ErHaWeb\DinosaurFinder\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Crypto\HashService as CoreHashService;

class HashService
{
    private const KEY = 'dinosaur_finder';

    public static function getHash(int $id): string
    {
        if ($coreHashService = GeneralUtility::makeInstance(CoreHashService::class)) {
            return $coreHashService->hmac($id, self::getSecret());
        }
        return '';
    }

    public static function validateHash(int $id, string $hash): bool
    {
        if ($id === 0 || empty($hash)) {
            return false;
        }

        return self::getHash($id) === $hash;
    }

    private static function getSecret(): string
    {
        return self::KEY . '_' . date('d.m.Y');
    }
}
