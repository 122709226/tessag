<?php
/**
 * Created by @panyao on 2016/7/15.
 * @author panyao
 * @email sunny17178@163.com
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\context\routing;

use org\tessag\http\IRequest;
use org\tessag\http\IResponse;
use org\tessag\webflow\context\response\IStream;

interface IRouter
{
    public function bindNamespacePath($path);

    public function bindControllerPostfix($postfix);

    public function bindIndex($uri);

    public function getControllerClass(IRequest $request);

    public function getControllerMethod(IRequest $request);
}