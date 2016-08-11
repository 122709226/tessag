<?php
/**
 * Created by @panyao on 2016/7/15.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\routing;

use org\tessag\http\IRequest;

/**
 * 路由interface
 * Interface IRouter
 * @package org\tessag\routing
 */
interface IRouter
{
    /**
     * 绑定明明空间地址
     * @param $path
     * @return void
     */
    public function bindNamespacePath($path);

    /**
     * 绑定Controller后缀，比如FooAction
     * @param $postfix
     * @return void
     */
    public function bindControllerPostfix($postfix);

    /**
     * 绑定首页地址
     * @param $uri
     * @return void
     */
    public function bindIndexURI($uri);

    /**
     * 获取目标Controller的class path
     * @param IRequest $request
     * @return string
     */
    public function getControllerClass(IRequest $request);

    /**
     * 获取目标Controller的method
     * @param IRequest $request
     * @return string
     */
    public function getControllerMethod(IRequest $request);
}