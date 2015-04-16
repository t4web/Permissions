<?php
namespace T4webPermissions;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\Controller\ControllerManager;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\EventManager\EventInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ServiceProviderInterface,
                        ControllerProviderInterface, ConsoleUsageProviderInterface
{

    public function getConfig($env = null)
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConsoleUsage(ConsoleAdapterInterface $console)
    {
        return array(
            'permissions init' => 'Initialize module',
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'T4webPermissions\Identity\Identity' => function($sm) {
                    return new Identity\Identity(
                        $sm->get('T4webAuthentication\Service')
                    );
                },

                'Zend\Authentication\AuthenticationService' => function($sm) {
                    return $sm->get('T4webPermissions\Identity\Identity');
                }
            ),

            'invokables' => array(
                'T4webPermissions\Controller\Admin\RolesViewModel' => 'T4webPermissions\Controller\Admin\RolesViewModel',
                'T4webPermissions\Controller\Admin\RoleViewModel' => 'T4webPermissions\Controller\Admin\RoleViewModel',
                'T4webPermissions\Controller\Admin\PermissionsViewModel' => 'T4webPermissions\Controller\Admin\PermissionsViewModel',
            ),
        );
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'T4webPermissions\Controller\Console\Init' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();

                    return new Controller\Console\InitController(
                        $sl->get('Zend\Db\Adapter\Adapter')
                    );
                },

                'T4webPermissions\Controller\Admin\Roles' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new Controller\Admin\RolesController(
                        /*$sl->get('T4webPermissions\Employee\Service\Finder'),*/
                        $sl->get('T4webPermissions\Controller\Admin\RolesViewModel')
                    );
                },

                'T4webPermissions\Controller\Admin\RoleCreate' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new Controller\Admin\RoleCreateController(
                        /*$sl->get('T4webPermissions\Employee\Service\Finder'),*/
                        $sl->get('T4webPermissions\Controller\Admin\RoleViewModel')
                    );
                },

                'T4webPermissions\Controller\Admin\Permissions' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new Controller\Admin\PermissionsController(
                        /*$sl->get('T4webPermissions\Employee\Service\Finder'),*/
                        $sl->get('T4webPermissions\Controller\Admin\PermissionsViewModel')
                    );
                },
            )
        );
    }
}
