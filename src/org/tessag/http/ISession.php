<?php
/**
 * Created by @panyao on 2016/8/8.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\http;

/**
 * 服务器会话interface，$_SESSION
 * Interface ISession
 * @package org\tessag\http
 */
interface ISession
{

    /**
     * 获取登录的唯一token标识
     * @return string
     */
    public function getToken();

    /**
     * 获取登录的id
     * @return mixed
     */
    public function getLoginId();

    /**
     * 判断是否为匿名用，true匿名，false非匿名
     * @return bool
     */
    public function isAnonymous();

    /**
     * 获取用户信息
     * @return mixed
     */
    public function getUserInfo();

    /**
     * 把指定id加入会话
     * @param $login_id
     * @return void
     */
    public function joinLogin($login_id);

    /**
     * 退出登录
     * @return void
     */
    public function loginOut();

}