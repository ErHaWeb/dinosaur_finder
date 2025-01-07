<?php

namespace ErHaWeb\DinosaurFinder\Service;

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Crypto\HashService as CoreHashService;
use TYPO3\CMS\Extbase\Security\Cryptography\HashService as ExtbaseHashService;

class HashService
{
    private const KEY = 'dinosaur_finder';

    public static function getHash(int $id): string
    {
        if ((new Typo3Version())->getMajorVersion() >= 13) {
            if ($coreHashService = GeneralUtility::makeInstance(CoreHashService::class)) {
                return $coreHashService->hmac($id, self::getSecret());
            }
        } else {
            if ($extbaseHashService = GeneralUtility::makeInstance(ExtbaseHashService::class)) {
                return $extbaseHashService->generateHmac($id);
            }
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
