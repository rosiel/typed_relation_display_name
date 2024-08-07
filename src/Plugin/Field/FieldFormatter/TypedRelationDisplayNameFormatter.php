<?php

namespace Drupal\typed_relation_display_name\Plugin\Field\FieldFormatter;

use Drupal\controlled_access_terms\Plugin\Field\FieldFormatter\TypedRelationFormatter;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'TypedRelationFormatter' for display name.
 *
 * @FieldFormatter(
 *   id = "typed_relation_display_name_default",
 *   label = @Translation("Typed Relation Display Name Formatter"),
 *   field_types = {
 *     "typed_relation_display_name"
 *   }
 * )
 */
class TypedRelationDisplayNameFormatter extends TypedRelationFormatter {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);

    foreach ($items as $delta => $item) {

      // Rewrite the title of the link to be the display name.
      if (!is_null($item->get('display_name')->getValue())) {
        $elements[$delta]['#title'] = $item->get('display_name')->getValue();
      }
    }

    return $elements;
  }

}
