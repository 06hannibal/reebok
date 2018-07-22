<?php
/**
 * @file
 * Contains \Drupal\mymodule\Plugin\Block\MyBlock.
 */
namespace Drupal\copyright_block\Plugin\Block;
use Drupal\Core\Block\BlockBase;
/**
 * Provides a custom_block.
 *
 * @Block(
 *   id = "copyright_block",
 *   admin_label = @Translation("Copyright block"),
 * )
 */
class Copyright extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $year = date('Y');

    $build[] = [
      '#theme' => 'blocks_copyright',
      '#year' => $year,
    ];

    return $build;
    }

  public function getCacheMaxAge() {
    return 0;
  }
}