<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Main\Controller\Main' => 'Main\Controller\MainController',
       ),
    ),
    'router' => array(
        'routes' => array(
            'main' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/main/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Main\Controller',
                        'controller' => 'Main',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
//                'child_routes' => array(
//                    'page' => array(
//                        'type' => 'segment',
//                        'options' => array(
//                            'route' => '[:page]'
//                        ),
//                    )
//                ),
            ),
        ),
    ),
);
