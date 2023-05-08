<?php
namespace Drupal\custom_general;
use Drupal\Core\Session\AccountInterface;

// class CustomService {
//     public function hello(){
//         return "custom service texttt";
//     }
// }

class CustomService {


    protected $currentUser;

    public function __construct(AccountInterface $currentUser) {

        $this->currentUser = $currentUser;
    }

    public function getData() {
        return $this->currentUser->getDisplayName() . "hello";
    }


}