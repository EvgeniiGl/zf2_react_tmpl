<?php

namespace User\Model;

class User {

    public $id;
    public $name;
    public $login;
    public $password;
    public $role;
    public $access;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->login = (isset($data['login'])) ? $data['login'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
        $this->role = (isset($data['role'])) ? $data['role'] : null;
        $this->access = (isset($data['access'])) ? $data['access'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
