<?php
/**
 * Created by @panyao on 2016/7/15.
 * @author panyao
 * @email sunny17178@163.com
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\http;

use Psr\Http\Message\ServerRequestInterface;

interface IRequest extends ServerRequestInterface
{
    public function getParameter($name);

    public function getQueryParameter($name);
}