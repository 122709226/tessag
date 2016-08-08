<?php
/**
 * Created by @panyao on 2016/8/8.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace base;

use org\tessag\http\ISession;
use org\tessag\http\SessionTrait;

class Session implements ISession{
    use SessionTrait;

    public function getUserInfo()
    {
        // TODO 注入db handler
    }

    protected function withLogin($token)
    {

    }

}