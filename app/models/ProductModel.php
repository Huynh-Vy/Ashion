<?php

class ProductModel extends DB
{
    public function show($limit = 8) 
    {
        $sql = "SELECT id, name, price, price_sale, thumb from products 
                where active = 1 order by created_at desc limit " . $limit. "";
        
        return $this->query($sql);
    }

    public function getMenu($menuId = 0, $limit, $offset) 
    {
        $sql = "SELECT id, name, price, price_sale, thumb from products 
                where active = 1 && menu_id = " . $menuId . "
                order by sort desc limit " . $limit ." offset " . $offset . " ";
        
        return $this->query($sql);
    }

    public function numRows($menuId = 0)
    {
       return $this->numRowDB("SELECT id from products where active = 1 && menu_id = " . $menuId ." ");
    }

    public function showProduct($id = 0)
    {
        return $this->fetch("SELECT * from products where id = " . $id ." && active  = 1");
    }

    public function getRand($id = 0)
    {
        return $this->query("SELECT SELECT id, name, price, price_sale, thumb from products 
                            where active = 1 && id != " . $id . "
                            order by RAND() limit 8");
    }
}