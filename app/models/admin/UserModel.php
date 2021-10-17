<?php

class UserModel extends DB
{
    public function show($email = '')
    {
        $sql = "Select * from users where email = '" . $email . "'" ;       
        return $this->fetch($sql);
    }
}
