<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\View\Model\ViewModel,
    Zend\View\Model\JsonModel;


class ApplicationController extends AbstractActionController{

    public function indexAction() {
     return new ViewModel();
    }

}
