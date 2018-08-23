<?php


namespace Drupal\purchase_return\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a custom_block.
 *
 * @Block(
 *   id = "purchasereturn",
 *   admin_label = @Translation("Block Purchase Return"),
 * )
 */
class Block_purchasereturn extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $form = \Drupal::formBuilder()->getForm('\Drupal\purchase_return\Form\Purchasereturn');

    return $form;
  }

}