<?php
/**
 * Created by @panyao on 2016/8/10.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */

namespace tgdm\traits;


use tgdm\interfaces\ITable;

trait FromTrait {
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
}