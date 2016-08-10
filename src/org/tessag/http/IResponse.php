<?php

/**
 * Created by @panyao on 2016/7/15.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\http;

use org\tessag\http\fpm\Cookie;
use Psr\Http\Message\ResponseInterface;

interface IResponse extends ResponseInterface
{

    public function withCookie(Cookie $cookie);

    public function getCookies();

}