<?php

namespace T4webPermissions\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use T4webPermissions\Roles\Service\Create as CreateService;

class RoleCreateController extends AbstractActionController {

    /**
     * @var CreateService
     */
    private $createService;

    /**
     * @var RoleViewModel
     */
    private $view;

    public function __construct(
        RoleViewModel $view, $form/*,
        CreateService $createService*/) {

        $this->view = $view;
        /*$this->createService = $createService*/;
    }

    public function defaultAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->flashMessenger()->addMessage('Bad request', 'general');
            return $this->view;
        }

        $params = $this->getRequest()->getPost()->toArray();

        $employee = $this->createService->create($params);

        if (!$employee) {
            $this->view->setFormData($params);
            $this->view->setErrors($this->createService->getErrors());
            $this->flashMessenger()->addMessage('You are now logged in.');
            return $this->view;
        }

        $params['employeeId'] = $employee->getId();
        $this->view->setFormData($params);

        return $this->redirect()->toRoute('admin-permissions-roles-list');
    }

}