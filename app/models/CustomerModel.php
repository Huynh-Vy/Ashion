<?php

class CustomerModel extends DB
{
    public function storeMessage($data)
    {
    return $this->insertAllDB($data, 'customers');

    }
}