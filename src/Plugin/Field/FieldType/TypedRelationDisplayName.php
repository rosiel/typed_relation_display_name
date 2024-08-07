<?php

namespace Drupal\typed_relation_display_name\Plugin\Field\FieldType;

use Drupal\controlled_access_terms\Plugin\Field\FieldType\TypedRelation;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Implements a Typed Relation field with optional display name.
 *
 * @FieldType(
 *   id = "typed_relation_display_name",
 *   label = @Translation("Typed Relation with Display Name"),
 *   module = "typed_relation_display_name",
 *   category = "typed_relation_display_name",
 *   description = @Translation("A reference field with a configurable type selector and an optional display name."),
 *   default_formatter = "typed_relation_display_name_default",
 *   default_widget = "typed_relation_display_name_default",
 *   list_class = "\Drupal\Core\Field\EntityReferenceFieldItemList",
 * )
 */
class TypedRelationDisplayName extends TypedRelation {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $schema = parent::schema($field_definition);
    $schema['columns']['display_name'] = [
      'type' => 'text',
      'size' => 'small',
      'not null' => FALSE,
    ];

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = parent::propertyDefinitions($field_definition);
    $properties['display_name'] = DataDefinition::create('string')
      ->setLabel(t('Display Name'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return ['display_name' => []] + parent::defaultFieldSettings();
  }

  /**
   * Callback for settings form.
   *
   * @param array $element
   *   An associative array containing the properties and children of the
   *   generic form element.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form for the form this element belongs to.
   *
   * @see \Drupal\Core\Render\Element\FormElement::processPattern()
   */
  public static function validateValues(array $element, FormStateInterface $form_state) {
    $values = static::extractPipedValues($element['#value']);

    if (!is_array($values)) {
      $form_state->setError($element, t('Allowed values list: invalid input.'));
    }
    else {
      // We may want to validate key values in the future...
      $form_state->setValueForElement($element, $values);
    }
  }

}
