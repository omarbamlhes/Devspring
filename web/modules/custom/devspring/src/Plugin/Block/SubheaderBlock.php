<?php

declare(strict_types=1);

namespace Drupal\devspring\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\config_pages\Entity\ConfigPages;

/**
 * Provides a about block.
 *
 * @Block(
 *   id = "devspring_subheader_block",
 *   admin_label = @Translation("Subheader Block"),
 *   category = @Translation("Custom"),
 * )
 */
final class SubheaderBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
  

    $build = [
      '#theme' => 'subheader_block',
      '#items' => [],
    ];

    return $build;
  } 


}
