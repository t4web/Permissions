<?php

namespace T4webPermissions\Controller\Admin;

use Zend\View\Model\ViewModel;
use T4webEmployees\Employee\Employee;
use T4webEmployees\Employee\EmployeeCollection;
use T4webEmployees\Employee\JobTitle;

class RoleViewModel extends ViewModel {

    /**
     * @var Collection
     */
    private $employees;

    public function __construct($variables = null, $options = null)
    {
        parent::__construct($variables, $options);
        $this->template = "t4web-permissions/admin/role-add/default";
    }

    /**
     * @return EmployeeCollection
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param EmployeeCollection $employees
     */
    public function setEmployees(EmployeeCollection $employees)
    {
        $this->employees = $employees;
    }


}
