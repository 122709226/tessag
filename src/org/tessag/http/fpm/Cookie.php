<?php
/**
 * Created by @panyao on 2016/7/15.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\http\fpm;

final class Cookie
{
    private $domain = "";
    private $maxAge = -1;
    private $path = "";
    private $isHttpOnly = false;

    private function __construct($name, $value)
    {

    }

    public static function on($name, $value)
    {
        return new Cookie($name, $value);
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return int
     */
    public function getMaxAge()
    {
        return $this->maxAge;
    }

    /**
     * @param int $maxAge
     */
    public function setMaxAge($maxAge)
    {
        $this->maxAge = $maxAge;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return boolean
     */
    public function isIsHttpOnly()
    {
        return $this->isHttpOnly;
    }

    /**
     * @param boolean $isHttpOnly
     */
    public function setIsHttpOnly($isHttpOnly)
    {
        $this->isHttpOnly = $isHttpOnly;
    }

}