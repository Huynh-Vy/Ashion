<?php

class CartModel extends DB
{
    public function get($limit, $offset)
    {
        return $this->query("SELECT * from customer order by is_view asc 
                            limit " . $limit . " offset " . $offset ."");
    }

    public function numRows()
    {
        return $this->numRowDB("SELECT id from customer");
    }

    public function show($id = 0)
    {
        return $this->fetch("SELECT * from customer where id = $id");
    }

    public function getCart($customerId = 0)
    {
        return $this->query("SELECT * from cart where customer_id = $customerId");
    }

    public function updateCustomer($id = 0)
    {
        return $this->query("UPDATE customer set is_view = 1 where id = $id");
    }

    public function delete($id = 0) 
    {
        /*
            ALTER TABLE cart
            ADD CONSTRAINT fk_cart_customer
            FOREIGN KEY (customer_id) 
            REFERENCES customers (id)
            ON DELETE CASCADE;
        */

        return $this->query("DELETE from customer where id = $id");
        // $this->query("DELETE from cart where customer_id = $id");

    }
}