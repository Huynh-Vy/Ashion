<?php

class ProductModel extends DB
{
    public function insert($data = [])
    {
        return $this->insertAllDB($data, 'products');
    }

    public function getAll($limit, $offset)
    {
        $sql = "SELECT products.*, menus.name as nameMenu 
                FROM `products` join menus 
                on products.menu_id = menus.id 
                order by products.id desc
                limit " . $limit . " offset " . $offset . "";

        return $this->query($sql);
    }

    public function numRows()
    {
        return $this->numRowDB('select id from products');
    }

    public function show($id)
    {
       return $this->fetch("select * from products where id = " . $id . " ");
    }

    public function update($data, $id)
    {
        return $this->updateAllDB($data, 'products', $id);
    }

    public function delete($id = 0)
    {
        return $this->query("DELETE from products where id = " . $id . " ");
    }
}