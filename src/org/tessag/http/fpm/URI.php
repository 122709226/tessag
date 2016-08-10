<?php
/**
 * Created by @panyao on 2016/8/4.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */

namespace org\tessag\http\fpm;
;


use Psr\Http\Message\UriInterface;

class URI implements UriInterface
{
    private $path;

    public function __construct()
    {
        $this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function getScheme()
    {
        return $_SERVER['REQUEST_SCHEME'];
    }

    public function getAuthority()
    {

    }

    public function getUserInfo()
    {

    }

    public function getHost()
    {
        return $_SERVER['HTTP_HOST'];
    }

    public function getPort()
    {
        return $_SERVER['SERVER_PORT'];
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getExtension()
    {
        pathinfo($this->getPath(), PATHINFO_EXTENSION);
    }

    public function getQuery()
    {
        return $_GET;
    }

    public function getFragment()
    {

    }

    public function withScheme($scheme)
    {

    }

    public function withUserInfo($user, $password = null)
    {

    }

    public function withHost($host)
    {

    }

    public function withPort($port)
    {

    }

    public function withPath($path)
    {

    }

    public function withQuery($query)
    {

    }

    public function withFragment($fragment)
    {

    }

    public function __toString()
    {
        return "";
    }
}