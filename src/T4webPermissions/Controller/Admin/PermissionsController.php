<?php

namespace T4webPermissions\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;
use T4webBase\Domain\Service\BaseFinder;
use T4webEmployees\Employee\Service\PersonalInfoPopulate;
use T4webEmployees\Employee\Service\WorkInfoPopulate;
use T4webEmployees\Employee\Service\SocialPopulate;
use T4webEmployees\Employee\EmployeeCollection;

class PermissionsController extends AbstractActionController {

    /**
     * @var BaseFinder
     */
    private $finder;

    /**
     * @var PermissionsViewModel
     */
    private $view;

    public function __construct(
        /*BaseFinder $finder,*/
        PermissionsViewModel $view)
    {
        /*$this->finder = $finder;*/
        $this->view = $view;
    }

    /**
     * @return PermissionsViewModel
     */
    public function defaultAction()
    {
        /** @var $employees EmployeeCollection */
        /*$employees = $this->finder->findMany();

        $this->view->setEmployees($employees);*/
        return $this->view;
    }

}