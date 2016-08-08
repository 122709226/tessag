<?php
/**
 * Created by @panyao on 2016/7/18.
 * @author panyao
 * @email sunny17178@163.com
 * @coding.net https://coding.net/u/pandaxia
 */

namespace org\tessag\http\fpm;;


use org\tessag\exception\NotFoundException;
use org\tessag\http\IResponse;
use Psr\Http\Message\StreamInterface;

final class HttpResponse implements IResponse
{
    private $_code = 200;
    private $_reasonPhrase;
    private $_headers = array();

    private $_stream = null;

    public function getProtocolVersion()
    {
        return "1.1";
    }

    public function withProtocolVersion($version)
    {
        // what the fuck
    }

    public function getHeaders()
    {
        return $this->_headers;
    }

    public function hasHeader($name)
    {
        return isset($this->_headers[$name]);
    }

    // 因为有hashHeader，所以这里如果没有找到就直接抛异常
    public function getHeader($name)
    {
        if ($this->hasHeader($name)) {
            return $this->_headers[$name];
        }
        throw new NotFoundException(sprintf("header name : %s not found!", $name));
    }

    public function getHeaderLine($name)
    {
        return $this->hasHeader($name) ? $this->_headers[$name] : "";
    }

    // TODO 我拒绝，这里这么返回新对象，谁尼玛没事去用已经没用的header啊？！
    public function withHeader($name, $value)
    {
        $this->_headers[$name] = $value;
        return $this;
    }

    public function withAddedHeader($name, $value)
    {
        return $this->withHeader($name, $value);
    }

    public function withoutHeader($name)
    {
        unset($this->_headers[$name]);
        return $this;
    }

    public function getBody()
    {
        return $this->_stream;
    }

    public function withBody(StreamInterface $body)
    {
        $this->_stream = $body;
        return $this;
    }

    public function getStatusCode()
    {
        return $this->_code;
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        $this->_code = $code;
        $this->_reasonPhrase = $reasonPhrase;
        return $this;
    }

    public function getReasonPhrase()
    {
        return $this->_reasonPhrase ? $this->_reasonPhrase : HttpStatus::getStatusPhrase($this->_code);
    }

}