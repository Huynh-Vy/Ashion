<?php

class CartModel extends DB
{
    public function getProduct($id = '')
    {
        return $this->query('SELECT id, name, price, price_sale, thumb from products 
                            where active = 1 && id IN (' . $id . ')');
    }
    
    public function storeCustomer($data)
    {
        return $this->insertAllDB($data, 'customer');
    }

    public function customerLastId()
    {
        return $this->getLastId();
    }

    public function storeCart($data)
    {
        return $this->insertAllDB($data, 'cart');
    }
}