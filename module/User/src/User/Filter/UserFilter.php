<?php

namespace User\Filter;

use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter
{

    public function __construct()
    {

        $this->add(array(
            'name' => 'id',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'Digits',
                ),
            ),
        ));
        $this->add(array(
            'name' => 'name',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StripTags',
                ),
                array(
                    'name' => 'StringTrim',
                ),
            ),
        ));
        $this->add(array(
            'name' => 'login',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StripTags',
                ),
                array(
                    'name' => 'StringTrim',
                ),
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StripTags',
                ),
                array(
                    'name' => 'StringTrim',
                ),
            ),
        ));
        $this->add(array(
            'name' => 'role',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StripTags',
                ),
                array(
                    'name' => 'StringTrim',
                ),
            ),
        ));
        $this->add(array(
            'name' => 'access',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'Digits',
                ),
            ),
        ));
    }

}
