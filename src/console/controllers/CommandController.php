<?php
/**
 * Translations for Craft plugin for Craft CMS 3.x
 *
 * Translations for Craft eliminates error prone and costly copy/paste workflows for launching human translated Craft CMS web content.
 *
 * @link      http://www.acclaro.com/
 * @copyright Copyright (c) 2018 Acclaro
 */

namespace acclaro\translationsforcraft\console\controllers;

use acclaro\translationsforcraft\TranslationsForCraft;

use Craft;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Command Command
 *
 * @author    Acclaro
 * @package   TranslationsForCraft
 * @since     1.0.0
 */
class CommandController extends Controller
{
    // Public Methods
    // =========================================================================

    /**
     * Handle translations-for-craft/command console commands
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $result = 'something';

        echo "Welcome to the console CommandController actionIndex() method\n";

        return $result;
    }

    /**
     * Handle translations-for-craft/command/do-something console commands
     *
     * @return mixed
     */
    public function actionDoSomething()
    {
        $result = 'something';

        echo "Welcome to the console CommandController actionDoSomething() method\n";

        return $result;
    }
}
