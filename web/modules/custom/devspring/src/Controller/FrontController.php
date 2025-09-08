<?php

namespace Drupal\devspring\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for the front page.
 */
class FrontController extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function content() {
    $build['content'] = [
        '#type' => 'item',
        '#markup' => $this->t(''),
      ];
    
    return $build;
  }

}
