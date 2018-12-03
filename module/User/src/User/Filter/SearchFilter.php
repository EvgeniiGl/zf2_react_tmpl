<?php

namespace User\Filter;

use Zend\InputFilter\InputFilter;

class SearchFilter extends InputFilter
{

    public function __construct()
    {

        $this->add(array(
            'name' => 'search',
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
    }

}
