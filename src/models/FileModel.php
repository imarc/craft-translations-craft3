<?php
/**
 * Translations for Craft plugin for Craft CMS 3.x
 *
 * Translations for Craft eliminates error prone and costly copy/paste workflows for launching human translated Craft CMS web content.
 *
 * @link      http://www.acclaro.com/
 * @copyright Copyright (c) 2018 Acclaro
 */

namespace acclaro\translationsforcraft\models;

use acclaro\translationsforcraft\TranslationsForCraft;
use acclaro\translationsforcraft\services\App;


use Craft;
use craft\base\Model;
use yii\validators\NumberValidator;
use craft\validators\SiteIdValidator;
use craft\validators\StringValidator;
use craft\validators\UniqueValidator;
use craft\validators\DateTimeValidator;

/**
 * @author    Acclaro
 * @package   TranslationsForCraft
 * @since     1.0.0
 */
class FileModel extends Model
{

    public $id;
    
    public $orderId;
    
    public $elementId;
    
    public $draftId;
    
    public $sourceSite;
    
    public $targetSite;
    
    public $status;
    
    public $wordCount;
    
    public $source;
    
    public $target;
    
    public $previewUrl;
    
    public $serviceFileId;
    
    public $dateUpdated;

    public function init()
    {
        parent::init();

        $this->status = $this->status ? $this->status : 'new';
        $this->sourceSite = $this->sourceSite ? $this->sourceSite : '';
        $this->targetSite = $this->targetSite ? $this->targetSite : '';
    }

    public function rules()
    {
        return [
            [['orderId', 'elementId', 'draftId', 'sourceSite', 'targetSite'], 'required'],
            [['sourceSite', 'targetSite'], SiteIdValidator::class],
            ['wordCount', NumberValidator::class],
            [['dateCreated', 'dateUpdated'], DateTimeValidator::class],
        ];
    }

    public function getStatusLabel()
    {
        switch ($this->status) {
            case 'new':
            case 'preview':
            case 'in progress':
                return 'In progress';
            case 'complete':
                return 'Ready to publish';
            case 'canceled':
                return 'Canceled';
            case 'published':
                return 'Published';
        }
    }
    
    public function getStatusColor()
    {
        switch ($this->status) {
            case 'new':
            case 'preview':
            case 'in progress':
                return 'orange';
            case 'complete':
                return 'blue';
            case 'canceled':
                return 'red';
            case 'published':
                return 'green';
            default:
                return '';
        }
    }
}