<?php
/**
 * Created by @panyao on 2016/8/8.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */

namespace org\tessag\http;

interface ISession
{

    public function getToken();

    public function getLoginId();

    public function isAnonymous();

    public function getUserInfo();

    public function joinLogin($login_id);

    public function loginOut();

}