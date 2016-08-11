<?php
/**
 * Created by @panyao on 2016/8/5.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\traits;

trait ArrayTrait
{
    protected $_data = array();

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->_data);
    }

    public function &offsetGet($offset)
    {
        return $this->_data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $offset = count($this->_data);
            if (array_key_exists($offset, $this->_data)) {
                throw new \ErrorException(
                    sprintf("Error! [] and [%d] can not be used！Please use [],[],[],
                    or [%d] less than or equal to %d",
                    $offset, $offset, $offset - 1));
            }
        }
        $this->_data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->_data[$offset]);
    }

    public function toArray()
    {
        return $this->_data;
    }
}