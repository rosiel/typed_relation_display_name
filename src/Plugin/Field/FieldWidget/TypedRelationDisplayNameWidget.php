<?php

namespace Drupal\typed_relation_display_name\Plugin\Field\FieldWidget;

use Drupal\controlled_access_terms\Plugin\Field\FieldWidget\TypedRelationWidget;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Plugin implementation of the typed relation with display name widget.
 *
 * @FieldWidget(
 *   id = "typed_relation_display_name_default",
 *   label = @Translation("Typed Relation Display Name Widget"),
 *   field_types = {
 *     "typed_relation_display_name"
 *   }
 * )
 */
class TypedRelationDisplayNameWidget extends TypedRelationWidget {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $widget = parent::formElement($items, $delta, $element, $form, $form_state);

    $item =& $items[$delta];

    $widget['display_name'] = [
      '#title' => $this->t('Display Name'),
      '#description' => $this->t("Display name is optional. If it exists, it will be displayed instead of the name of the linked entity."),
      '#type' => 'textfield',
      '#default_value' => $item->display_name ?? '',
      '#weight' => 2,
    ];

    unset($widget['target_id']['#title_display']);
    $widget['target_id']['#title'] = $this->t('Linked Entity');

    return $widget;
  }

}
