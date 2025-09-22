<?php

declare(strict_types=1);

namespace Drupal\devspring\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a related block.
 *
 * @Block(
 *   id = "devspring_related_block",
 *   admin_label = @Translation("Related Block"),
 *   category = @Translation("Custom"),
 * )
 */
final class RelatedBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * Constructs a new RelatedBlock instance.
   *
   * @param array $configuration
   *   The plugin configuration.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The route match.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, RouteMatchInterface $route_match) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
    $this->routeMatch = $route_match;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('current_route_match')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $services = [];
    
    // Get the current node from route if available.
    $current_node = $this->routeMatch->getParameter('node');
    
    // Query to get 3 service nodes.
    $node_storage = $this->entityTypeManager->getStorage('node');
    $query = $node_storage->getQuery()
      ->condition('type', 'service')
      ->condition('status', 1)
      ->range(0, 3)
      ->sort('created', 'DESC')
      ->accessCheck(TRUE);
    
    // Exclude current node if we're on a node page.
    if ($current_node && $current_node->getEntityTypeId() === 'node') {
      $query->condition('nid', $current_node->id(), '!=');
    }
    
    $nids = $query->execute();
    
    if (!empty($nids)) {
      $nodes = $node_storage->loadMultiple($nids);
      
      foreach ($nodes as $node) {
        $services[] = [
          'title' => $node->label(),
          'url' => $node->toUrl()->toString(),
          'id' => $node->id(),
          'node' => $node,
        ];
      }
    }

    $build = [
      '#theme' => 'related_block',
      '#items' => $services,
      '#cache' => [
        'tags' => ['node_list:service'],
        'contexts' => ['url.path'],
      ],
    ];

    return $build;
  }

}
