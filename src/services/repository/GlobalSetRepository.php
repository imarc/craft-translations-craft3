<?php
/**
 * Translations for Craft plugin for Craft CMS 3.x
 *
 * Translations for Craft eliminates error prone and costly copy/paste workflows for launching human translated Craft CMS web content.
 *
 * @link      http://www.acclaro.com/
 * @copyright Copyright (c) 2018 Acclaro
 */

namespace acclaro\translationsforcraft\services\repository;

use Craft;
use craft\elements\GlobalSet;
use craft\base\ElementInterface;
use acclaro\translationsforcraft\TranslationsForCraft;

class GlobalSetRepository
{
    public function getAllSets()
    {
        return Craft::$app->globals->getAllSets();
    }

    public function getSetById($globalSetId, $site = null)
    {
        return Craft::$app->globals->getSetById($globalSetId, $site);
    }

    public function getSetByHandle($globalSetHandle, $siteHandle = null)
    {
        if ($siteHandle && is_string($siteHandle)) {
            $siteHandle = Craft::$app->sites->getSiteByHandle($siteHandle)->id;
        }

        return Craft::$app->globals->getSetByHandle($globalSetHandle, $siteHandle);
    }

    public function saveSet(GlobalSet $globalSet)
    {
        $success = Craft::$app->elements->saveElement($globalSet);
        if (!$success) {
            Craft::error('Couldn’t save the Global Set "'.$globalSet->title.'"', __METHOD__);
        }
    }
}