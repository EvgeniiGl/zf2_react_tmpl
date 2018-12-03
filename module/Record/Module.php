<?php

namespace Record;

use Record\Model\Record;
use Record\Model\RecordTable;
use Zend\Db\ResultSet\ResultSet;
//use Record\Controller\RecordController;
use Zend\Db\TableGateway\TableGateway;

//use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

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
            'factories' => array(
                "RecordTable" => function ($sm) {
                    $tableGateway = $sm->get('RecordTableGateway');
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new RecordTable($tableGateway, $dbAdapter);
                    return $table;
                },
                'RecordTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Record());
                    return new TableGateway('record', $dbAdapter, null, $resultSetPrototype);
                },
                'Record' => function ($sm) {
                    return new Record();
                },
            ),
            'invokables' => array(),
            'services' => array(),
            'shared' => array(),
        );
    }

}
