<?php
/**
 * Created by @panyao on 2016/8/8.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace tgdm;


use tgdm\interfaces\ITable;
use tgdm\joiner\Order;
use tgdm\traits\FromTrait;
use tgdm\traits\Group;
use tgdm\traits\WhereTrait;


class YSelect
{
    use FromTrait;
    use WhereTrait;

    protected $_table;
    protected $_offset = 0;
    protected $_limit = 20;

    protected $_fields = array();
    protected $_order;
    protected $_group;

    private function __construct($table)
    {
        $this->_table = $table;
    }

    static public function form(ITable $table)
    {
        return new self($table->getName());
    }

    static public function formTable($table)
    {
        return new self($table);
    }

    public function getSql()
    {
        return "";
    }

    public function fields($field1)
    {
        $this->_fields = array();
        array_push($this->_fields, func_get_args());
        return $this;
    }

    public function fieldArray(array $field1)
    {
        $this->_fields = array();
        array_push($this->_fields, $field1);
        return $this;
    }

    public function joinOrder(Order $order)
    {
        $this->_order = $order;
        return $this;
    }

    public function joinGroup(Group $group)
    {
        $this->_group = $group;
        return $this;
    }

    public function offset($offset)
    {
        $this->_offset = $offset;
        return $this;
    }

    public function limit($limit)
    {
        $this->_limit = $limit;
        return $this;
    }

}