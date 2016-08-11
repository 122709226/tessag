<?php
/**
 * Created by @panyao on 2016/7/15.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\http;

use Psr\Http\Message\ServerRequestInterface;

interface IRequest extends ServerRequestInterface
{

    /**
     * 获取request body的参数值
     * @param $name
     * @return mixed
     */
    public function getParameter($name);

    /**
     * 获取queryString 的参数值
     * @param $name
     * @return mixed
     */
    public function getQueryParameter($name);

    /**
     * 判断是否为ajax请求, true 是ajax，false 非ajax
     * @return bool
     */
    public function isAjax();

    /**
     * 获取到登录会话,注意，非$_SESSION
     * @return ISession
     */
    public function getSession();

    /**
     * 注册登录会话
     * @param ISession $session
     * @return void
     */
    public function withSession(ISession $session);
}