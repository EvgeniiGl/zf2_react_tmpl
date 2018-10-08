<?php

namespace Main;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {

        return array(
            'abstract_factories' => array(),
            'aliases' => array(),
            'factories' => array(),
            'invokables' => array(),
            'services' => array(),
            'shared' => array(),
        );
    }

}
