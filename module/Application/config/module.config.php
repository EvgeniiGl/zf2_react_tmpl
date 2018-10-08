<?php

namespace Application;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Main\Controller\Main',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
        ),
        'factories' => array(
//            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'controllers' => array(
        'invokables' => array(),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'layout/blank' => __DIR__ . '/../view/layout/blank.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
         ),
//        'template_path_stack' => array(
//            'application' => __DIR__ . '/../view',
//        ),
        'strategies' => array(
            'ViewJsonStrategy'
        )
    ),
    'translator' => array(
        'locale' => 'ru_RU',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'templates_docs' => array(
        'template_docx' => __DIR__ . '/../../../www/template/docx/',
    ),  
     'php_settings' => array(
         'session.name' => 'PHPSESSID',
        'session.save_path' => __DIR__ . '/../../../www/data/session/'
    )
    
    //помошник вида показывает дату в формате "02" января 2010
//    'view_helpers' => array(
//        'invokables'=> array(
//            'date_helper' => 'Application\Helper\DateFormat'  
//        )
//    ),
//.....
);
