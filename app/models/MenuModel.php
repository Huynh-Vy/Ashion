<?php

class MenuModel extends DB
{
    public function show($id = 0)
    {
        $sql = "SELECT * from menus where id = " . $id ." && active = 1 && is_delete is NULL";

        return $this->fetch($sql);
    }
}   