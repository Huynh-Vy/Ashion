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

    public function show()
    {
        return $this->fetchArray("SELECT * from menus order by id desc");
    }

    public function showItem($id = 0)
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

}