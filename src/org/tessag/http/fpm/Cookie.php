<?php
/**
 * Created by @panyao on 2016/7/15.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\http\fpm;

final class Cookie
{
    private $_name;
    private $_value;

    private $_domain = "";
    private $_max_age = -1;
    private $_path = "";
    private $_secure;
    private $_is_http_only = false;

    private $_expire;

    public function __construct($name, $value)
    {
        $this->_name = $name;
        $this->_value = $value;
    }

    public static function on($name, $value)
    {
        return new Cookie($name, $value);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->_domain;
    }

    /**
     * @param string $_domain
     */
    public function setDomain($_domain)
    {
        $this->_domain = $_domain;
    }

    /**
     * @return int
     */
    public function getMaxAge()
    {
        return $this->_max_age;
    }

    /**
     * @param int $_max_age
     */
    public function setMaxAge($_max_age)
    {
        $this->_max_age = $_max_age;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * @param string $_path
     */
    public function setPath($_path)
    {
        $this->_path = $_path;
    }

    /**
     * @return mixed
     */
    public function getSecure()
    {
        return $this->_secure;
    }

    /**
     */
    public function isSecure()
    {
        $this->_secure = true;
    }

    /**
     * @return boolean
     */
    public function getHttpOnly()
    {
        return $this->_is_http_only;
    }

    public function isHttpOnly()
    {
        $this->_is_http_only = true;
    }

    /**
     * @return mixed
     */
    public function getExpire()
    {
        return $this->_expire === null ?: time() + $this->_expire;
    }

    /**
     * @param mixed $expire
     */
    public function setExpire($expire)
    {
        $this->_expire += intval($expire);
    }

}