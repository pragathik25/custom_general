<?php
namespace Drupal\custom_general\Controller;

use Drupal\Core\Controller\ControllerBase;

class CustomController extends ControllerBase{

    public function hello() {
        $build = [
            '#markup' => '<span>Hello World</span>',
            '#attached' => [
                'library' => [
                    'custom_general/css_lib',
                ],
            ],
        ];
        return $build;
    }
}