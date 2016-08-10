<?php
/**
 * Created by @panyao on 2016/8/9.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace tgdm;

use tgdm\interfaces\ITable;
use tgdm\traits\FromTrait;
use tgdm\traits\WhereTrait;

class YUpdate
{
    use FromTrait;
    use WhereTrait;

    protected $_table;

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
        // TODO: Implement getSql() method.
    }

    public function set()
    {

    }
}