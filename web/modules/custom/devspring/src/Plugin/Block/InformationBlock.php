<?php

declare(strict_types=1);

namespace Drupal\devspring\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\config_pages\Entity\ConfigPages;

/**
 * Provides a information block.
 *
 * @Block(
 *   id = "devspring_information_block",
 *   admin_label = @Translation("Information Block"),
 *   category = @Translation("Custom"),
 * )
 */
final class InformationBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
  

    $build = [
      '#theme' => 'information_block',
      '#items' => [],
    ];

    return $build;
  } 


}
