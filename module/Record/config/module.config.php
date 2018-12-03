<?php
return array(
    'controllers' => array(
        'factories' => array(
            'Record' => 'Record\Controller\Factory\RecordControllerDetailsFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'records' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/records/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Record\Controller',
                        'controller' => 'Record',
                        'action' => 'index',
                    ),
                ),
                 'may_terminate' => true,
                 'child_routes' => array(
                     'action' => array(
                         'type' => 'Segment',
                         'options' => array(
                             'route' => '[:action]',
                             'constraints' => array(
                                 'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                             ),
                             'defaults' => array(
                                 'controller' => 'Record',
                                 'action' => 'index',
                             ),
                         ),
                     ),
                 ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Record' => __DIR__ . '/../view',
        ),
    ),
);
