<?php

namespace T4webPermissions\Controller\Admin;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

class RoleAddController extends AbstractActionController {

    /**
     * @return ViewModel
     */
    public function defaultAction($form)
    {
        $flashMessenger = $this->flashMessenger();
        if ($flashMessenger->hasMessages()) {
            $messages = $flashMessenger->getMessages();
            die(var_dump(11, $messages));
        }

        $r = new RoleViewModel();
        //die(var_dump($r->getTemplate()));
        return $r;
    }

}