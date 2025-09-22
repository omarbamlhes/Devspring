<?php

declare(strict_types=1);

namespace Drupal\devspring\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\config_pages\Entity\ConfigPages;

/**
* Provides a footer block.
 *
 * @Block(
 *   id = "devspring_footer_block",
 *   admin_label = @Translation("Footer Block"),
 *   category = @Translation("Custom"),
 * )
 */
final class FooterBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {

    $address = '';
    $email = '';
    $number = '';
    $copyright = '';
    
    $config_page = ConfigPages::config('general_settings');
    if ($config_page) {
      $address = $config_page->get('field_address_footer')->value;
      $email = $config_page->get('field_gmail_footer')->value;
      $number = $config_page->get('field_number_footer')->value;
      $copyright = $config_page->get('field_copyright_footer')->value;
    }
    
    $items = [
      'address' => $address,
      'email' => $email,
      'number' => $number,
      'copyright' => $copyright,
    ];
    $build = [
      '#theme' => 'footer_block',
      '#items' => $items,
    ];

    return $build;
  } 


}
