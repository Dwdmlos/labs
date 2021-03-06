<?php
defined('SYS_ENTRY') or die('Access Denied!');


class Common_Data
{
    protected $_type = "";
    
    public function __construct($type)
    {
        $this->_type = "itemx_$type";
    }

    public function getFeed($where = array(), $order = array(), $limit = 10, $offset = 0)
    {
        try {
			$_entry = Common_Db::getInstance(array('name' => $this->_type, 'primary' => 'gid'));
	        $feed = $_entry->getList($where, $order, $limit, $offset);
	    } catch (Exception $e) {
	    	throw $e;
	    }

        return $feed;
    }
    
	public function getEntry($entryid)
	{
		try {
			$_entry = Common_Db::getInstance(Common_Data_Db::$entry);
	        $entry = $_entry->getById($entryid);

            $_field = new Common_Data_Field();
            $fields = $_field->getFields($entry);
            $entry = array_merge($entry, $fields);

	    } catch (Exception $e) {
	    	throw $e;
	    }
	    
	    return $entry;
	}
}
