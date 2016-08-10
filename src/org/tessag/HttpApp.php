<?php
namespace org\tessag;

use org\tessag\exception\ClassNotFoundException;
use org\tessag\exception\TessagException;
use org\tessag\http\fpm\HttpRequest;
use org\tessag\http\fpm\HttpResponse;
use org\tessag\http\IRequest;
use org\tessag\http\IResponse;
use org\tessag\http\IResponseMessage;
use org\tessag\http\message\ViewMessage;
use org\tessag\routing\IRouter;

class HttpApp
{
    private static $app = null;

    private $controller;
    private $router;
    private $exceptionHandler;

    private function __construct(IRouter $router)
    {
        $this->router = $router;
        $this->controller = new ControllerHandler();
        $this->setControllerExceptionHandler(function (IRequest $request, IResponse $response, \Exception $ex) {

        });
        $this->setExceptionHandler(function (IRequest $request, IResponse $response, \Exception $ex) {

        });
    }

    /**
     * 执行http app逻辑
     * @throws \Exception
     */
    public function invoke()
    {
        set_error_handler(function ($err_no, $err_str, $file = null, $line = null) {
            if (error_reporting() & $err_no) {
                throw new \ErrorException($err_str, $err_no, $err_no, $file, $line);
            }
            return true;
        });

        $request = new HttpRequest();
        $response = new HttpResponse();
        try {
            $class = $this->router->getControllerClass($request);
            $method = $this->router->getControllerMethod($request);
            // 执行
            $this->controller->invoke($request, $response, $class, $method);
        } catch (\Exception $ex) {
            if (call_user_func($this->exceptionHandler, $request, $response, $ex) !== true) {
                throw $ex;
            }
        } finally {
            try {
                $this->sent($response);
            } catch (\Exception $ex) {
                if (call_user_func($this->exceptionHandler, $request, $response, $ex) !== true) {
                    throw $ex;
                }
            }
        }
    }

    public static function getInstance(IRouter $router)
    {
        if (null === self::$app) {
            self::$app = new HttpApp($router);
        }
        return self::$app;
    }

    final private function __clone()
    {
    }

    public static function setViewRoot($path)
    {
        ViewMessage::bindViewRoot($path);
    }

    public function setExceptionHandler(callable $error)
    {
        $this->exceptionHandler = $error;
    }

    public function setControllerExceptionHandler(callable $handle)
    {
        $this->controller->setExceptionHandle($handle);
    }

    public function setControllerPreHandler(callable $handle)
    {
        $this->controller->applyPreHandle($handle);
    }

    public function setControllerPostHandler(callable $handle)
    {
        $this->controller->applyPostHandle($handle);
    }

    private function sent(IResponse $response)
    {
        if (!headers_sent()) {
            $code = $response->getStatusCode();
            if ($code !== 200) {
                header(sprintf('HTTP/%s %d %s', '1.1', $code, $response->getReasonPhrase()));
            }
            foreach ($response->getHeaders() as $key => $value) {
                if (is_array($value)) {
                    $value = implode(';', $value);
                }
                header(sprintf('%s: %s', $key, $value));
            }
            // TODO writer cookie

        }
        $stream = $response->getBody();
        // 发送response body
        if ($stream && $stream->isReadable()) {
            echo $stream->getContents();
            $stream->close();
        }
    }

    /**
     * 注册命名空间
     *
     * @param $path
     */
    public static function registerNamespacePathV2($path)
    {
        spl_autoload_register(function ($classname) use ($path) {
            $filename = $path . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
            // 必须检查，否则会报出错误
            if (!file_exists($filename)) {
//                throw new \RuntimeException(sprintf('Class %s does not exist', $classname), ExceptionCode::CLASS_NOT_FOUND);
                throw new ClassNotFoundException(sprintf('Class %s does not exist', $classname));
            }
            require $filename;
        });
    }
}

interface IControllerHandler
{

    /**
     * 执行Controller业务
     * @param IRequest $request
     * @param IResponse $response
     * @param $class
     * @param $method
     * @return mixed
     */
    public function invoke(IRequest $request, IResponse $response, $class, $method);

    /**
     * 执行之前
     * @param callable $handle
     * @return mixed
     */
    public function applyPreHandle(callable $handle);

    /**
     * 控制器执行之后
     * @param callable $handle
     * @return mixed
     */
    public function applyPostHandle(callable $handle);

    /**
     * 设置异常处理handle
     * @param callable $handle
     * @return mixed
     */
    public function setExceptionHandle(callable $handle);
}

/**
 * Controller执行类
 *
 * Created by @panyao on ${DATE}.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia\
 */
class ControllerHandler implements IControllerHandler
{
    private $exception_handler;

    private $_handlers = array(
        null, null, null
    );

    public function invoke(IRequest $request, IResponse $response, $class, $method)
    {
        $this->_handlers[1] = function (IRequest $request, IResponse $response) use ($class, $method) {
            try {
                $controller = new $class();

                $controller->request = $request;
                $controller->response = $response;
                $response_message = call_user_func_array(array($controller, $method), array($request));
                if (!($response_message instanceof IResponseMessage)) {
                    throw new \ErrorException(sprintf('response message type: %s un support!', $response_message));
                }
                yield $response_message;
                $response->withHeader("Content-Type", array($response_message->getContentType(), 'charset=utf-8'));
                // 这里就已经渲染了视图了，shit
                $response->withBody($response_message->toResponseBody());
            } catch (TessagException $ex) {
                // 执行Controller 异常处理
                if (call_user_func($this->exception_handler, $request, $response, $ex) !== true) {
                    throw $ex;
                }
            }
        };

        // http://www.zhihu.com/question/26966414
        // http://php.net/manual/zh/language.generators.syntax.php
        $stack = array();
        $message = null;
        // 前一个yield值将会被传入下一个handler
        foreach ($this->_handlers as $handler) {
            if ($handler == null) {
                continue;
            }
            $generator = call_user_func_array($handler, array($request, $response, $message));

            if ($generator === false) {
                break;
            } else if ($generator instanceof \Generator) {
                $message = $generator->current();
                // yield false, 直接终止流程
                if ($message === false) {
                    throw new \ErrorException('yield 表达式返回了false，流程终止!');
                    //break;
                }
                $stack[] = $generator;
            }
        }

        while ($generator = array_pop($stack)) {
            $generator->next();
        }
    }

    public function applyPreHandle(callable $handle)
    {
        $this->_handlers[0] = $handle;
    }

    public function applyPostHandle(callable $handle)
    {
        $this->_handlers[2] = $handle;
    }

    public function setExceptionHandle(callable $handle)
    {
        $this->exception_handler = $handle;
    }
}