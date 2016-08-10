<?php
/**
 * Created by @panyao on 2016/8/8.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace base;

use org\tessag\http\ISession;
use org\tessag\http\SessionTrait;

class Session implements ISession
{
    use SessionTrait;

    public function getUserInfo()
    {
        return array(
            'user_id' => $this->_login_id,
            'user_name' => 'root',
        );
    }

    protected function withLogin($token)
    {
        session_start();
        if (isset($_SESSION['_token']) && $token = $_SESSION['_token']) {
            $this->_login_id = explode('|', $token)[1];
            $this->_token = $token;
        }
    }

    public function joinLogin($login_id)
    {
        $token = sha1(microtime(true) . '||' . $login_id) . '|' . $login_id;
        $_SESSION['_token'] = $token;
        return $token;
    }

    public function loginOut()
    {
        unset($_SESSION['_token']);
    }


}