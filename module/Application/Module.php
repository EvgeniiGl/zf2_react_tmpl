<?php

namespace Application;

use Zend\Mvc\MvcEvent;
//use Zend\Validator\AbstractValidator;
//use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module implements AutoloaderProviderInterface {

    public function onBootstrap(MvcEvent $e) {
//        $translator = $e->getApplication()->getServiceManager()->get('translator');
//        $translator->addTranslationFile(
//                'phpArray', 'vendor/zendframework/zendframework/resources/languages/ru/' .
//                'Zend_Validate.php', 'default', 'ru_RU'
//        );
//        AbstractValidator::setDefaultTranslator($translator);
//        date_default_timezone_set("Asia/Novosibirsk"); //устанавливаем временную зону
//        $eventManager = $e->getApplication()->getEventManager();
//        $moduleRouteListener = new ModuleRouteListener();
//        $moduleRouteListener->attach($eventManager);
//        $this->setPhpSettings();
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function setPhpSettings() {
//        $config = $this->getConfig();
//        if (isset($config['php_settings'])) {
//            $phpSettings = $config['php_settings'];
//            if ($phpSettings) {
//                foreach ($phpSettings as $key => $value) {
//                    ini_set($key, $value);
//                }
//            }
//        }
    }

    public function getAutoloaderConfig() {

        return array(
            'Zend\Loader\StandardAutoloader' => array(
//                'Zend\Loader\ClassMapAutoloader' => array(
//                    __DIR__ . '/autoload_classmap.php',
//                ),
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {

        return array(
//            'abstract_factories' => array(),
//            'aliases' => array(),
//            'factories' => array(),
//            'invokables' => array(),
//            'services' => array(),
//            'shared' => array(),
        );
    }

}
