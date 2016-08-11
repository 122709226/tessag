<?php
/**
 * Created by @panyao on 2016/8/8.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\http;

trait SessionTrait
{
    protected $_token;
    protected $_login_id;

    public function __construct($token = '')
    {
        $this->_token = $token;
        $this->withLogin($token);
    }

    public function getToken()
    {
        return $this->_token;
    }

    public function getLoginId()
    {
        return $this->_login_id;
    }

    public function isAnonymous()
    {
        return !boolval($this->_login_id);
    }

    abstract protected function withLogin($token);

}