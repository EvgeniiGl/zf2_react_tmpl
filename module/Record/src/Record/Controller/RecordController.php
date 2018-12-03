<?php

namespace Record\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Record\Filter\SearchFilter;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class RecordController extends AbstractActionController {

    private $details;

    public function __construct(array $details) {
        $this->details = $details;
    }

    public function indexAction() {
        return new ViewModel();
    }

    public function fetchAction() {
        $data['records'] = $this->details['RecordTable']->fetchAll();
        $data['users'] = $this->details['RecordTable']->getUsers();
        $data['addresses'] = $this->details['RecordTable']->getAddressByid($data['records']);
        
        
        return new JsonModel($data);
    }

    public function loadAddressAction() {
        $inputFilter = new SearchFilter();
        $inputFilter->setData(array("search"=>$this->request->getQuery('str_search')));
        $data['load_addresses'] = $this->details['RecordTable']->getAddressByStrSearch($inputFilter->getValues());
        return new JsonModel($data);
    }

}
