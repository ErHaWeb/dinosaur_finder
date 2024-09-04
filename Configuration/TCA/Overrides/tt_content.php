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

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

(static function () {
    $pluginSignature = ExtensionUtility::registerPlugin(
        'DinosaurFinder',
        'Pi1',
        'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_be.xlf:pi1_title',
        'dinosaur',
        'plugins',
        'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_be.xlf:pi1_plus_wiz_description',
    );

    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key';
})();
