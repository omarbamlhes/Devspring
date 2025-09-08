<?php

declare(strict_types=1);

namespace Drupal\devspring\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\config_pages\Entity\ConfigPages;

/**
 * Provides a gen block.
 *
 * @Block(
 *   id = "devspring_gen_block",
 *   admin_label = @Translation("Gen Block"),
 *   category = @Translation("Custom"),
 * )
 */
final class GenBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $title = '';
    $description = '';
    
    $config_page = ConfigPages::config('general_settings');
    if ($config_page) {
      $title = $config_page->get('field_title_header')->value;
      $description = $config_page->get('field_body_header')->value;
      $title_about = $config_page->get('field_title_about')->value;
      $description_about = $config_page->get('field_body_about')->value;
    }
    
    $items = [
      'title' => $title,
      'description' => $description,
      'title_about' => $title_about,
      'description_about' => $description_about,
    ];
    $build = [
      '#theme' => 'gen_block',
      '#items' => $items,
    ];

    return $build;
  } 


}
