<?php

namespace Record\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;

class RecordTable {

    protected $tableGateway;
    protected $sql;

    public function __construct(TableGateway $tableGateway, Adapter $dbAdapter) {
        $this->tableGateway = $tableGateway;
        $this->dbAdapter = $dbAdapter;
        $this->sql = new Sql($this->dbAdapter);
    }

    public function fetchAll($search = null) {
        $sqlSelect = $this->sql->select('record');
        $sqlSelect->columns(array(
            "id",
            "num",
            "creator_id",
            "time_create",
            "type",
            "theme",
            "time_sent",
            "maker_id",
            "time_take",
            "time_done",
            "closer_id",
            "theme_end",
        ));
        $sqlSelect->join('record_address', 'record_id = record.id', array(
            'addresses_id' => new \Zend\Db\Sql\Expression("GROUP_CONCAT(address_id SEPARATOR ',')"
            )), 'left')->group('record.id');
        $this->search($search, $sqlSelect);
        $statement = $this->sql->prepareStatementForSqlObject($sqlSelect);
        $result = $statement->execute();
        $resultSet = new ResultSet;
        $resultSet->initialize($result);

        return $resultSet->toArray();
    }

    public function search($search, $sqlSelect) {
        if (empty($search)) {
            return;
        }
        $parts = explode(" ", $search['search']);
        foreach ($parts as $value) {
            $sqlSelect->where->NEST->AND->like('name', '%' . $value . '%')->UNNEST;
        }
    }

    public function getUsers() {
        $sqlSelect = $this->sql->select("user");
        $sqlSelect->columns(array(
            "id",
            "name",
            "role",
            'access'
        ));
//        $sqlSelect->where(array("access" => "1"));
        $statement = $this->sql->prepareStatementForSqlObject($sqlSelect);
        $result = $statement->execute();
        $resultSet = new ResultSet;
        $resultSet->initialize($result);
        foreach ($resultSet->toArray() as $value) {
            $data[$value['id']] = $value;
        }
        return $data;
    }

    public function getAddressById($records) {
        foreach ($records as $record) {
            $strAddressId[] = $record['id'];
        }
        $sqlSelect = $this->sql->select("address");
        $sqlSelect->columns(array(
            "id",
            "region",
            "city",
            "locality",
            "first_street",
            "street",
            "house",
            "entrance",
            "num_lift",
            "reg_num",
            "serial_num",
        ));
        $sqlSelect->where->in("id", array(new \Zend\Db\Sql\Expression(
                    "(SELECT address_id FROM record_address WHERE record_id"
                    . " IN (" . implode(',', $strAddressId) . "))")));


        $statement = $this->sql->prepareStatementForSqlObject($sqlSelect);
        $result = $statement->execute();
        $resultSet = new ResultSet;
        $resultSet->initialize($result);
        foreach ($resultSet->toArray() as $value) {
            $data[$value['id']] = $value;
        }
        return $data;
    }

    public function getAddressByStrSearch($search) {
        $arrSearch = explode(" ", $search['search']);
        $sqlSelect = $this->sql->select("address");
        $sqlSelect->columns(array(
            "id",
            "region",
            "city",
            "locality",
            "first_street",
            "street",
            "house",
            "entrance",
            "num_lift",
            "reg_num",
            "serial_num",
        ));
        foreach ($arrSearch as $search) {
            $sqlSelect->where->NEST->AND->like('region', '%' . $search . '%')
                    ->OR->like('city', '%' . $search . '%')
                    ->OR->like('street', '%' . $search . '%')
                    ->OR->like('locality', '%' . $search . '%')
                    ->OR->like('first_street', '%' . $search . '%')
                    ->OR->like('street', '%' . $search . '%')
                    ->OR->like('house', '%' . $search . '%')
                    ->OR->like('entrance', '%' . $search . '%')
                    ->OR->like('num_lift', '%' . $search . '%')
                    ->OR->like('reg_num', '%' . $search . '%')
                    ->OR->like('serial_num', '%' . $search . '%')
                    ->UNNEST;
        }
        $sqlSelect->limit(20);
        $statement = $this->sql->prepareStatementForSqlObject($sqlSelect);
        $result = $statement->execute();
        if (!$result->count()) {
            foreach ($arrSearch as $search) {
                $sqlSelect->where->OR->like('region', '%' . $search . '%')
                        ->OR->like('city', '%' . $search . '%')
                        ->OR->like('street', '%' . $search . '%')
                        ->OR->like('locality', '%' . $search . '%')
                        ->OR->like('first_street', '%' . $search . '%')
                        ->OR->like('street', '%' . $search . '%')
                        ->OR->like('house', '%' . $search . '%')
                        ->OR->like('entrance', '%' . $search . '%')
                        ->OR->like('num_lift', '%' . $search . '%')
                        ->OR->like('reg_num', '%' . $search . '%')
                        ->OR->like('serial_num', '%' . $search . '%')
                        ;
            }
            $sqlSelect->limit(20);
            $statement = $this->sql->prepareStatementForSqlObject($sqlSelect);
            $result = $statement->execute();
        }
        $resultSet = new ResultSet;
        $resultSet->initialize($result);
//        die(print_r($resultSet->count()));

        $data = [];
        foreach ($resultSet->toArray() as $value) {
            $data[$value['id']] = $value;
        }
        return $data;
    }

}
