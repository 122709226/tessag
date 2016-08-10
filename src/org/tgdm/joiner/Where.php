<?php
/**
 * Created by @panyao on 2016/8/9.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace tgdm\joiner;

final class Where
{
    private $exp;
    private $values = array();
    private $_wheres = array();

    public function getValues()
    {
        return array();
    }

    public function getWhereSql()
    {
        return "";
    }

    private static function _exp($filed, $expression, $value)
    {
        $where = new Where();
        $where->exp = "( " . $filed . " " . $expression . " ? ";
        $where->values[] = $value;
        return $where;
    }

    private static function _expIn($filed, $expression, array $values)
    {
        $where = new Where();
        $where->exp = "( " . $filed . " " . $expression .
            " ( " . implode(', ', array_fill(0, count($values), '?')) . " )";

        $where->values = $values;
        return $where;
    }

    static public function equal($field, $value)
    {
        return self::_exp($field, '=', $value);
    }

    static public function eq($field, $value)
    {
        return self::equal($field, $value);
    }

    static public function notEqual($field, $value)
    {
        return self::_exp($field, '<>', $value);
    }

    static public function notEq($field, $value)
    {
        return self::notEqual($field, $value);
    }

    static public function greaterThan($field, $value)
    {
        return self::_exp($field, '>', $value);
    }

    static public function gt($field, $value)
    {
        return self::greaterThan($field, $value);
    }

    static public function lessThan($field, $value)
    {
        return self::_exp($field, '<', $value);
    }

    static public function lt($field, $value)
    {
        return self::lessThan($field, $value);
    }

    static public function greaterThanOrEqual($field, $value)
    {
        return self::_exp($field, '>=', $value);
    }

    static public function gteq($field, $value)
    {
        return self::greaterThanOrEqual($field, $value);
    }

    static public function lessThanOrEqual($field, $value)
    {
        return self::_exp($field, '<=', $value);
    }

    static public function lteq($field, $value)
    {
        return self::lessThanOrEqual($field, $value);
    }

    static public function like($field, $value)
    {
        return self::_exp($field, 'LIKE', $value);
    }

    static public function notLike($field, $value)
    {
        return self::_exp($field, 'NOT LIKE', $value);
    }

    static public function in($field, array  $values)
    {
        return self::_expIn($field, 'IN', $values);
    }

    static public function notIn($field, array  $values)
    {
        return self::_expIn($field, 'NOT IN', $values);
    }

    static public function inArgs($field, $value1)
    {
        $args = func_get_args();
        unset($args[0]);
        return self::_expIn($field, 'IN', $args);
    }

    static public function notInArgs($field, $value1)
    {
        $args = func_get_args();
        unset($args[0]);
        return self::_expIn($field, 'IN', $args);
    }

    public function andx(Where $where)
    {
        $where = array(
            'exp' => 'AND',
            'where' => $where
        );
        $this->_wheres[] = $where;
        return $this;
    }

    public function orx(Where $where)
    {
        $where = array(
            'exp' => 'OR',
            'where' => $where
        );
        $this->_wheres[] = $where;
        return $this;
    }

}