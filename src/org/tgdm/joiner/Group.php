<?php
/**
 * Created by @panyao on 2016/8/9.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace tgdm\traits;

use tgdm\joiner\Where;

final class Group
{
    private $field;
    private $aggregate = array();

    private $having;

    private function __construct(array $field)
    {
        $this->field = $field;
    }

    static public function by($filed1)
    {
        return new Group(func_get_args());
    }

    public function sum($field)
    {
        $this->_aggregate($field, 'SUM', '__sum');
        return $this;
    }

    public function count($field)
    {
        $this->_aggregate($field, 'COUNT', '__count');
        return $this;
    }

    public function avg($field)
    {
        $this->_aggregate($field, 'AVG', '__avg');
        return $this;
    }

    public function max($field)
    {
        $this->_aggregate($field, 'MAX', '__max');
        return $this;
    }

    public function having(Where $where)
    {
        $this->having = $where;
        return $this;
    }

    private function _aggregate($field, $func, $as_name)
    {
        $this->aggregate[] = sprintf('%s ( %s ) AS %s', $func, $field, $as_name);
    }

}