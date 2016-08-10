<?php
/**
 * Created by @panyao on 2016/8/9.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace tgdm\traits;

use tgdm\joiner\Where;

trait WhereTrait
{
    protected $_where;

    abstract public function getSql();

    public function joinWhere(Where $where)
    {
        $this->_where = $where;
        return $this;
    }

    public function appendWhere(Where $where)
    {
        return $this->appendWhereAnd($where);
    }

    public function appendWhereAnd(Where $where)
    {
        if ($this->_where === null) {
            $this->_where = $where;
        } else {
            $this->_where->andx($where);
        }
        return $this;
    }

    public function appendWhereOr(Where $where)
    {
        if ($this->_where === null) {
            $this->_where = $where;
        } else {
            $this->_where->orx($where);
        }
        return $this;
    }

    public function getWhereValues()
    {
        return $this->_where === null ? array() : $this->_where->getValues();
    }

    public function __toString()
    {
        return $this->getSql();
    }
}