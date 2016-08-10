<?php
/**
 * Created by @panyao on 2016/8/9.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace tgdm\joiner;

final class Order
{
    private $exp;

    static public function by()
    {
        return new Order();
    }

    public function desc($field1)
    {
        $this->exp = implode(', ', func_get_args()) . ' DESC';
        return $this;
    }

    public function asc($field1)
    {
        $this->exp = implode(', ', func_get_args()) . ' ASC';
        return $this;
    }

    public function mixed($field1)
    {
        $this->exp = 'FIELD ' . implode(', ', func_get_args());
        return $this;
    }

}