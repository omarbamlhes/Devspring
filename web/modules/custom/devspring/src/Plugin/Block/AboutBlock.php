<?php

declare(strict_types=1);

namespace Drupal\devspring\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\config_pages\Entity\ConfigPages;

/**
 * Provides a about block.
 *
 * @Block(
 *   id = "devspring_about_block",
 *   admin_label = @Translation("About Block"),
 *   category = @Translation("Custom"),
 * )
 */
final class AboutBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $title = '';
    $description = '';
    
    $config_page = ConfigPages::config('general_settings');
    if ($config_page) {
      $title = $config_page->get('field_title_about')->value;
      $description = $config_page->get('field_body_about')->value;
    }
    
    $items = [
      'title' => $title,
      'description' => $description,
    ];
    $build = [
      '#theme' => 'about_block',
      '#items' => $items,
    ];

    return $build;
  } 


}
