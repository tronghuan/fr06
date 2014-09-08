<?php

class categories {

    protected $_id;
    protected $_name;
    protected $_parentID;
    protected $_level;
    protected $_number_products;

    public function __construct($_id, $_name, $_parentID = 0)
    {
        $this->_id = $_id != NULL ? $_id : 0;
        $this->_name = $_name;
        $this->_parentID = $_parentID != NULL ? $_parentID : 0;
        $this->_level = -1;
        $this->_number_products = 0;
    }
    public function getID()
    {
        return $this->_id;
    }
    public function getName()
    {
        return $this->_name;
    }
    public function getParentID()
    {
        return $this->_parentID;
    }

    public function setID($id)
    {
        $this->_id = $id != NULL ? $id : 0;
    }
    public function setName($name)
    {
        $this->_name = $name;
    }
    public function setParentID($parentID)
    {
        $this->_parentID = $parentID != NULL ? $_parentID : 0;
    }
    public function getLevel()
    {
        return $this->_level;
    }
    public function setLevel($level)
    {
        $this->_level = $level;
    }
    public function setNums($num)
    {
        $this->_number_products = $num;
    }
    public function getNums()
    {
        return $this->_number_products;
    }
    public function addNums($num)
    {
        $this->_number_products += $num;
    }
}