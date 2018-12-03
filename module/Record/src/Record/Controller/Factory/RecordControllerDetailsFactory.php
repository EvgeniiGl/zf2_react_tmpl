<?php

namespace Record\Controller\Factory;

use Record\Controller\RecordController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RecordControllerDetailsFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $controllerLocator)
    {

        $serviceLocator = $controllerLocator->getServiceLocator();
        $RecordDetails = array();
        $RecordDetails['RecordTable'] = $serviceLocator->get('RecordTable');
        $RecordDetails['Record'] = $serviceLocator->get('Record');
        return new RecordController($RecordDetails);
    }

}
