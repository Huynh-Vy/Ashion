<?php

class SliderModel extends DB
{
    public function showAll()
    {
        $sql = "SELECT * from sliders where active = 1 order by sort asc";

        return $this->query($sql);
    }
}

