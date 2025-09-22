<?php

declare(strict_types=1);

namespace Drupal\devspring\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\config_pages\Entity\ConfigPages;

/**
 * Provides a ready block.
 *
 * @Block(
 *   id = "devspring_ready_block",
 *   admin_label = @Translation("Ready Block"),
 *   category = @Translation("Custom"),
 * )
 */
final class ReadyBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
  

    $build = [
      '#theme' => 'ready_block',
      '#items' => [],
    ];

    return $build;
  } 


}
