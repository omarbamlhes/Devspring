<?php

declare(strict_types=1);

namespace Drupal\devspring\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\config_pages\Entity\ConfigPages;

/**
 * Provides a opinion block.
 *
 * @Block(
 *   id = "devspring_opinion_block",
 *   admin_label = @Translation("Opinion Block"),
 *   category = @Translation("Custom"),
 * )
 */
final class OpinionBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
  

    $build = [
      '#theme' => 'opinion_block',
      '#items' => [],
    ];

    return $build;
  } 


}
