<?php

namespace Main\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\View\Model\ViewModel,
    Zend\View\Model\JsonModel;

class MainController  extends AbstractActionController{

    public function indexAction() {
     return new ViewModel();
    }

}
