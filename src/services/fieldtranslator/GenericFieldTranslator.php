<?php
/**
 * Translations for Craft plugin for Craft CMS 3.x
 *
 * Translations for Craft eliminates error prone and costly copy/paste workflows for launching human translated Craft CMS web content.
 *
 * @link      http://www.acclaro.com/
 * @copyright Copyright (c) 2018 Acclaro
 */

namespace acclaro\translationsforcraft\services\fieldtranslator;

use Craft;
use craft\base\Field;
use craft\base\Element;
use acclaro\translationsforcraft\services\App;
use acclaro\translationsforcraft\TranslationsForCraft;
use acclaro\translationsforcraft\services\ElementTranslator;

class GenericFieldTranslator implements TranslatableFieldInterface
{
    public function getFieldValue(ElementTranslator $elementTranslator, Element $element, Field $field)
    {
        return $element->getFieldValue($field->handle);
    }

    public function toTranslationSource(ElementTranslator $elementTranslator, Element $element, Field $field)
    {
        return $this->getFieldValue($elementTranslator, $element, $field);
    }
    
    public function toPostArrayFromTranslationTarget(ElementTranslator $elementTranslator, Element $element, Field $field, $sourceSite, $targetSite, $fieldData)
    {
        return $fieldData;
    }
    
    public function toPostArray(ElementTranslator $elementTranslator, Element $element, Field $field)
    {
        return $this->getFieldValue($elementTranslator, $element, $field);
    }
    
    public function getWordCount(ElementTranslator $elementTranslator, Element $element, Field $field)
    {
        return TranslationsForCraft::$plugin->wordCounter->getWordCount($this->getFieldValue($elementTranslator, $element, $field));
    }
}