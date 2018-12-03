<?php

namespace User\Controller\Factory;

use User\Controller\UserController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserControllerDetailsFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $controllerLocator)
    {

        $serviceLocator = $controllerLocator->getServiceLocator();
        $UserDetails = array();
        $UserDetails['UserTable'] = $serviceLocator->get('UserTable');
        $UserDetails['User'] = $serviceLocator->get('User');
        return new UserController($UserDetails);
    }

}
