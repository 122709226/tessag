<?php
/**
 * Created by @panyao on 2016/7/18.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\http\fpm;

use org\tessag\http\IRequest;
use org\tessag\http\ISession;
use org\tessag\http\streams\ResourceStream;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

final class HttpRequest implements IRequest
{
    private $_uri;
    private $_headers;
    private $_session;

    public function __construct()
    {
        $this->_uri = new URI();

        // 截取所有的http头
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') !== false) {
                $this->_headers[str_replace('_', '-', substr($key, 5))] = $value;
            }
        }
    }

    public function getProtocolVersion()
    {
        return '1.1';
    }

    public function withProtocolVersion($version)
    {

    }

    public function getParameter($name)
    {
        $params = $this->getParsedBody();
        return isset($params[$name]) ? $params[$name] : '';
    }

    public function getQueryParameter($name)
    {
        $params = $this->getQueryParams();
        return isset($params[$name]) ? $params[$name] : '';
    }

    public function isAjax()
    {
        if (strpos($this->getHeader('accept'), 'application/json') !== false) {
            return true;
        }

        if (strpos($this->getHeader('X-Requested-With'), 'XMLHttpRequest') !== false) {
            return true;
        }

        return false;
    }

    public function getSession()
    {
        return $this->_session;
    }

    public function withSession(ISession $session)
    {
        $this->_session = $session;
    }


    public function getHeaders()
    {

    }

    public function hasHeader($name)
    {
        $headers = $this->getHeaders();
        return isset($headers[$name]);
    }

    public function getHeader($name)
    {
        $headers = $this->getHeaders();
        return isset($headers[$name]) ? $headers[$name] : '';
    }

    public function getHeaderLine($name)
    {
        // TODO: Implement getHeaderLine() method.
    }

    public function withHeader($name, $value)
    {

    }

    public function withAddedHeader($name, $value)
    {
        throw new \ErrorException('what the fuck?!');
    }

    public function withoutHeader($name)
    {
        throw new \ErrorException('what the fuck?!');
    }

    public function getBody()
    {
        return new ResourceStream(fopen('php://input', 'r'));
    }

    public function withBody(StreamInterface $body)
    {
        throw new \ErrorException('what the fuck?!');
    }

    public function getRequestTarget()
    {
        // TODO: Implement getRequestTarget() method.
    }

    public function withRequestTarget($requestTarget)
    {
        // TODO: Implement withRequestTarget() method.
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function withMethod($method)
    {
        throw new \ErrorException('what the fuck?!');
    }

    public function getUri()
    {
        // REDIRECT_URL
        return $this->_uri;
    }

    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        throw new \ErrorException('what the fuck?!');
    }

    public function getServerParams()
    {
        return $_SERVER;
    }

    public function getCookieParams()
    {
		return $_COOKIE;
    }

    public function withCookieParams(array $cookies)
    {
		throw new \ErrorException('what the fuck?!');
    }

    public function getQueryParams()
    {
        return $this->_uri->getQuery();
    }

    public function withQueryParams(array $query)
    {
        throw new \ErrorException('what the fuck?!');
    }

    public function getUploadedFiles()
    {
        // TODO: Implement getUploadedFiles() method.
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
        throw new \ErrorException('what the fuck?!');
    }

    public function getParsedBody()
    {
        return $_POST;
    }

    public function withParsedBody($data)
    {
        // TODO: Implement withParsedBody() method.
    }

    public function getAttributes()
    {
        // TODO: Implement getAttributes() method.
    }

    public function getAttribute($name, $default = null)
    {
        // TODO: Implement getAttribute() method.
    }

    public function withAttribute($name, $value)
    {
        // TODO: Implement withAttribute() method.
    }

    public function withoutAttribute($name)
    {
        // TODO: Implement withoutAttribute() method.
    }

}