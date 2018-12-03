<?php

namespace User;

use User\Model\User;
use User\Model\UserTable;
use Zend\Db\ResultSet\ResultSet;
//use User\Controller\UserController;
use Zend\Db\TableGateway\TableGateway;

//use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__=> __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {

        return array(
            'abstract_factories' => array(),
            'aliases' => array(),
            'factories' => array(
                "UserTable" => function ($sm) {
                    $tableGateway = $sm->get('UserTableGateway');
                    $table = new UserTable($tableGateway);
                    return $table;
                },
                'UserTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
                'User' => function ($sm) {
                    return new User();
                },
            ),
            'invokables' => array(),
            'services' => array(),
            'shared' => array(),
        );
    }

}
