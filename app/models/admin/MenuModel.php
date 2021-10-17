<?php

class MenuModel extends DB
{
    protected $created_at;
    protected $updated_at;

    public function __construct()
    {
        # Load function __construct ben DB
        parent::__construct();

        $this->created_at = date("Y-m-d H:i:s");
        $this->updated_at = $this->created_at;
    }

    public function insert($name = '', $description = '', int $sort, $active)
    {
        $sql = "insert into menus (name, description, sort, active, created_at, updated_at) 
                            values ('" . $name. "', '" . $description. "', " .$sort. ", " .$active. ", 
                            '" . $this->created_at. "' ,'" . $this->updated_at. "') ";
        
        return $this->query($sql);
    }

    public function showAll($limit = 1, $offset = 0)
    {
        $sql = 'select * from menus  where is_delete is NULL order by id desc
               limit ' .$limit. ' offset ' .$offset. '';

        return $this->query($sql);
    }

    public function numRows()
    {
        return $this->numRowDB("select id from menus where is_delete is NULL");
    }

    public function show($id = 0)
    {
        return $this->fetch('select * from menus where id = ' .$id . '');
    } 

    public function update($id, $name = '', $description = '', int $sort, $active)
    {
        $sql = "update menus set name = '" .$name. "', description = '" . $description. "', sort = " .$sort. ", 
                                        active = " .$active. ", created_at = '" . $this->created_at."', 
                                        updated_at = '" .$this->updated_at."' where id = " . $id. "";
        
        return $this->query($sql);
    }

    public function delete($id = 0)
    {
        // return $this->query('delete menus where id = ' . $id . '');

        return $this->query('update menus set is_delete = 1 where id = ' . $id . '');
    }

    public function get()
    {
        return $this->query('select id, name from menus where is_delete is NULL && active = 1');
    }

    

}

