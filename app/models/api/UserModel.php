<?php

class UserModel extends DB
{
    public function checkToken($token = '')
    {
        $sql = "SELECT * from users 
                        where token = '" . $token . "' && token_exp > " . time() . " " ;

        return $this->fetch($sql);
    }

    public function show($email = '')
    {
        $sql = "Select * from users where email = '" . $email . "'" ;       
        return $this->fetch($sql);
    }

    public function updateToken($token, $exp, $id)
    {
        return $this->query("UPDATE users 
                            set token = '" . $token . "', token_exp = $exp 
                            where id = $id ");
    }

}   