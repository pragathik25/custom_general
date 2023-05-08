<?php

 namespace Drupal\custom_general\Plugin\Block;

 use Drupal\Core\Block\BlockBase;
 use Drupal\Core\Session\AccountInterface;
 use Drupal\Core\Access\AccessResult;
 use Drupal\Core\Form\FormStateInterface;
 use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
 use Symfony\Component\DependencyInjection\ContainerInterface;
 use Drupal\Core\Routing\RouteMatchInterface;
 /**
  * Provides simple block for d4drupal.
  * @Block (
  * id = "custom_block_plugin",
  * admin_label = "custom_block"
  * )
  */

  class CustomBlock extends BlockBase implements ContainerFactoryPluginInterface {

     /**
   * The route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

    /**
     * @param array $configuration
     * @param string $plugin_id
     * @param mixed $plugin_definition
     * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
     *   The current route match.
     * */

    public function __construct(array $configuration, $plugin_id, $plugin_definition, RouteMatchInterface $route) {
      parent::__construct($configuration, $plugin_id, $plugin_definition);
      $this->route = $route;
    }


    /**
     * {@inheritdoc}
     */

    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
      return new static(
        $configuration,
        $plugin_id,
        $plugin_definition,
        $container->get('current_route_match')
      );
    }

    /**
     * {@inheritdoc}
     */
    public function build() {
      $hexcode = $this->configuration['hexcode'];
      $element = [
        '#theme' => "block_plugin_template",
        '#text' =>  "welcome to the site!!!",
        '#hexcode' => $this->configuration['hexcode'],
      ];
        return $element;
    }

    /**
     * {@inheritdoc}
     */

    protected function blockAccess(AccountInterface $account) {
      return AccessResult::allowedIfHasPermission($account, "d4drupal block access");
    }

    /**
     * {@inheritdoc}
     */

    public function defaultConfiguration() {
      return [
        'hexcode' => "",
      ];
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
      $form['hexcode'] = [
        '#type' => 'textfield',
        '#title' => 'Hexcode',
        '#default_value' => $this->configuration['hexcode'],
      ];
      return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
      $this->configuration['hexcode'] = $form_state->getValue('hexcode');
    }

}