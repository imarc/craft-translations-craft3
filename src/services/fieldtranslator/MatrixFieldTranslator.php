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

class MatrixFieldTranslator extends GenericFieldTranslator
{
    /**
     * {@inheritdoc}
     */
    public function toTranslationSource(ElementTranslator $elementTranslator, Element $element, Field $field)
    {
        $source = array();

        $blocks = $element->getFieldValue($field->handle)->all();

        if ($blocks) {
            foreach ($blocks as $block) {
                $blockSource = $elementTranslator->toTranslationSource($block);

                foreach ($blockSource as $key => $value) {
                    $key = sprintf('%s.%s.%s', $field->handle, $block->id, $key);

                    $source[$key] = $value;
                }
            }
        }

        return $source;
    }

    /**
     * {@inheritdoc}
     */
    public function toPostArray(ElementTranslator $elementTranslator, Element $element, Field $field)
    {
        $fieldHandle = $field->handle;

        $blocks = $element->getFieldValue($fieldHandle)->all();

        if (!$blocks) {
            return '';
        }

        $post = array(
            $fieldHandle => array(),
        );

        foreach ($blocks as $i => $block) {
            $post[$fieldHandle]['new'.($i+1)] = array(
                'type' => $block->getType()->handle,
                'enabled' => $block->enabled,
                'fields' => $elementTranslator->toPostArray($block),
            );
        }
        return $post;
    }

    /**
     * {@inheritdoc}
     */
    public function toPostArrayFromTranslationTarget(ElementTranslator $elementTranslator, Element $element, Field $field, $sourceSite, $targetSite, $fieldData)
    {
        $fieldHandle = $field->handle;

        $blocks = $element->getFieldValue($fieldHandle)->all();
        
        $post = array(
            $fieldHandle => array(),
        );
        
        $fieldData = array_values($fieldData);        
        
        foreach ($blocks as $i => $block) {
            $blockData = isset($fieldData[$i]) ? $fieldData[$i] : array();
            $post[$fieldHandle]['new'.($i+1)] = array(
                'type'              => $block->getType()->handle,
                'enabled'           => $block->getAttributes()['enabled'],
                'enabledForSite'    => $block->getAttributes()['enabledForSite'],
                'siteId'            => $targetSite,
                'fields'            => $elementTranslator->toPostArrayFromTranslationTarget($block, $sourceSite, $targetSite, $blockData, true),
            );
        }
        
        return $post;
    }

    /**
     * {@inheritdoc}
     */
    public function getWordCount(ElementTranslator $elementTranslator, Element $element, Field $field)
    {
        $blocks = $this->getFieldValue($elementTranslator, $element, $field)->all();

        if (!$blocks) {
            return 0;
        }

        $wordCount = 0;

        foreach ($blocks as $i => $block) {
            $wordCount += $elementTranslator->getWordCount($block);
        }

        return $wordCount;
    }
}