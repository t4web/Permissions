<?php

return array(

    'zfc_rbac' => [
        'role_provider' => [
            'ZfcRbac\Role\InMemoryRoleProvider' => [
                'admin' => [
                    'children'    => ['member'],
                    'permissions' => ['delete']
                ],
                'member' => [
                    'permissions' => ['edit']
                ]
            ]
        ]
    ],

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'display_exceptions' => true,
        'display_not_found_reason' => true,
    ),

    'router' => array(
        'routes' => array(
            'admin-permissions-roles-list' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/admin/permissions/roles',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webPermissions\Controller\Admin',
                        'controller'    => 'List',
                        'action'        => 'default',
                    ),
                ),
            ),
            'admin-permissions-roles-add' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/admin/permissions/role/add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webPermissions\Controller\Admin',
                        'controller'    => 'List',
                        'action'        => 'default',
                    ),
                ),
            ),
            'admin-permissions-roles-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/permissions/role/:id/edit',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webPermissions\Controller\Admin',
                        'controller'    => 'List',
                        'action'        => 'default',
                    ),
                ),
            ),
            'admin-permissions-roles-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/permissions/role/:id/delete',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webPermissions\Controller\Admin',
                        'controller'    => 'List',
                        'action'        => 'default',
                    ),
                ),
            ),
            'admin-permissions-roles-permissions' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/permissions/role/:id/permissions',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webPermissions\Controller\Admin',
                        'controller'    => 'List',
                        'action'        => 'default',
                    ),
                ),
            ),
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'permissions-init' => array(
                    'options' => array(
                        'route'    => 'permissions init',
                        'defaults' => array(
                            '__NAMESPACE__' => 'T4webPermissions\Controller\Console',
                            'controller' => 'Init',
                            'action'     => 'run'
                        )
                    )
                ),
            )
        )
    ),

    'db' => array(
        'tables' => array(
            't4webpermissions-roles' => array(
                'name' => 'roles',
                'columnsAsAttributesMap' => array(
                    'id' => 'id',
                    'name' => 'name',
                ),
            ),
        ),
    ),

    'criteries' => array(
        'Role' => array(
            'empty' => array('table' => 'roles'),
        ),
    ),
);
