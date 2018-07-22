<?php


namespace Drupal\subscription\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a custom_block.
 *
 * @Block(
 *   id = "subscription",
 *   admin_label = @Translation("Block Subsribe"),
 * )
 */
class Block_Subsribe extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $form = \Drupal::formBuilder()->getForm('\Drupal\subscription\Form\Subscribe');

    return $form;
  }

}