<?php
/**
 * Created by @panyao on 2016/7/15.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\context\routing;

use org\tessag\http\IRequest;

interface IRouter
{
    public function bindNamespacePath($path);

    public function bindControllerPostfix($postfix);

    public function bindIndex($uri);

    public function getControllerClass(IRequest $request);

    public function getControllerMethod(IRequest $request);
}