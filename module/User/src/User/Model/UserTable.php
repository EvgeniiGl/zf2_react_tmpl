<?php

namespace User\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($search)
    {
        $sqlSelect = $this->tableGateway->getSql()->select();
        $sqlSelect->columns(array(
            "id",
            "login",
            "name",
            "role",
            "access"));
        $this->search($search, $sqlSelect);
        $resultSet = $this->tableGateway->selectWith($sqlSelect);
        return $resultSet;
    }

    public function saveUser($user)
    {
        $data = $user->getArrayCopy();
        if (empty($data['id'])) {
            unset($data['id']);
            $this->tableGateway->insert($data);
        } else {
            $this->tableGateway->update($data, array('id' => $data['id']));
        }
    }

    public function deleteUser(int $id)
    {
        $this->tableGateway->delete(array("id" => $id));
    }

    public function changeAccess(int $id, bool $access)
    {
        $this->tableGateway->update(array("access" => $access), array('id' => $id));
    }

    public function search($search, $sqlSelect)
    {
        if (empty($search)) {
            return;
        }
        $parts = explode(" ", $search['search']);
        foreach ($parts as $value) {
            $sqlSelect->where->NEST->AND->like('name', '%' . $value . '%')->UNNEST;
        }
    }
}
