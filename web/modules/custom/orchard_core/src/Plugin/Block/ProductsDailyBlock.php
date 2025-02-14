<?php
namespace Drupal\orchard_core\Plugin\Block;

use Drupal\Core\Url;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a Products Daily Block
 * 
 * @Block(
 *   id = "products_daily_block",
 *   admin_label = @Translation("Products daily block"),
 *   category = @Translation("Custom")
 * )
 */
class ProductsDailyBlock extends BlockBase implements ContainerFactoryPluginInterface {

    /**
     * EntityTypeManager service.
     *
     * @var \Drupal\Core\Entity\EntityTypeManagerInterface
     */
    protected $entityTypeManager;

    /**
     * Constructor
     *
     * @param array $configuration
     *   Config
     * @param string $plugin_id
     *   Plugin ID
     * @param mixed $plugin_definition
     *   Plugin definition
     * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
     *   Entity Type Manager service
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
        $this->entityTypeManager = $entity_type_manager;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->get('entity_type.manager')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function build(): array {
        // Clear page cache
        \Drupal::service('page_cache_kill_switch')->trigger();
        // Get products of the day
        $daily_products = $this->entityTypeManager->getStorage('node')->getQuery()
            ->condition('type', 'products')
            ->condition('field_product_of_the_day', 1)
            ->accessCheck(FALSE)
            ->execute();

        $product_info = [];
        
        // Get product information
        if(!empty($daily_products)) {
            $random_product = array_rand($daily_products);
            $node = $this->entityTypeManager->getStorage('node')->load($daily_products[$random_product]);
            $product_info['name'] = $node->getTitle();
            $product_info['summary'] = $node->get('field_description')->value;
            $image_uri = $node->get('field_product_image')->entity->getFileUri();
            $product_info['image'] = $node->get('field_product_image')->entity->createFileUrl();
            
            $build['#content'] = $node;
        }

        
        $build['#theme'] = 'products_daily_block';
        $build['#cache']['max-age'] = 0;
        $build['#attached']['library'][] = 'orchard_core/card';
        $build['#product'] = $product_info;

        return $build;
    }
}
