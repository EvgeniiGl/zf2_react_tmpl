<?php

namespace Record\Model;

class Record
{

    public $id;
    public $num;
    public $creator_id;
    public $time_create;
    public $type;
    public $theme;
    public $time_sent;
    public $maker_id;
    public $time_take;
    public $time_done;
    public $closer_id;
    public $theme_end;

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->num = (isset($data['num'])) ? $data['num'] : null;
        $this->creator_id = (isset($data['creator_id'])) ? $data['creator_id'] : null;
        $this->time_create = (isset($data['time_create'])) ? $data['time_create'] : null;
        $this->type = (isset($data['type'])) ? $data['type'] : null;
        $this->theme = (isset($data['theme'])) ? $data['theme'] : null;
        $this->time_sent = (isset($data['time_sent'])) ? $data['time_sent'] : null;
        $this->maker_id = (isset($data['maker_id'])) ? $data['maker_id'] : null;
        $this->time_take = (isset($data['time_take'])) ? $data['time_take'] : null;
        $this->time_done = (isset($data['time_done'])) ? $data['time_done'] : null;
        $this->closer_id = (isset($data['closer_id'])) ? $data['closer_id'] : null;
        $this->theme_end = (isset($data['theme_end'])) ? $data['theme_end'] : null;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}
