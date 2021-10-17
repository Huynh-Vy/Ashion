<?php

class SliderModel extends DB
{
    public function insert($data)
    {
        return $this->insertAllDB($data, 'sliders');
    }

    public function showAll()
    {
        return $this->query("SELECT * from sliders order by id desc");
    }

    public function show($id)
    {
        return $this->fetch("SELECT * from sliders where id = " . $id . " ");
    }

    public function update($data, $id)
    {
        return $this->updateAllDB($data, 'sliders', $id);
    }

    public function delete($id)
    {
        return $this->query("DELETE from sliders where id = " . $id . "");
    }
}