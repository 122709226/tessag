<?php
define("ROOT_DIR", __DIR__);            // 定义根目录
define("DEBUG", true);                  // 启动debug模式

// #1 Autoload 自动载入
require ROOT_DIR . '/../vendor/autoload.php';

// #2 注册Controller使用的class 自动加载的路径, (也可以在composer.json->"autoload"->"psr-4" 节点下面配置，看个人喜好)
\org\tessag\HttpApp::registerNamespaceV2('\\', ROOT_DIR . DIRECTORY_SEPARATOR . 'simple');

// #3 设置web视图的根目录(如果纯api，这里可以无视)
\org\tessag\HttpApp::setViewRoot(ROOT_DIR . DIRECTORY_SEPARATOR . 'simple'.DIRECTORY_SEPARATOR.'views');

// #4 声明路由规则，另外还有jsonrpc可选,其它规则则需要自行拓展
$router = new \org\tessag\context\routing\router\RESTful();

// #5 获取http app 实例
$http_app = \org\tessag\HttpApp::getInstance($router);

// #6 设置Controller开始执行之前的处理函数，成功返回true
$http_app->setControllerPreHandler(function (\org\tessag\http\IRequest $request,
                                             \org\tessag\http\IResponse $response) {
    // 开始执行的时间
    $start_time = microtime(true);

    // #1 初始化会话
    $token = $request->getQueryParameter("_token");


    yield true;

    // 整个请求的执行时间
    $response->withHeader("X-Run-Time", (microtime(true) - $start_time) * 1000);
    // 视图渲染完成
    // 剩下的就是php最后一步操作，直接执行php输出页面的逻辑
    // TODO 这里可以写正常请求结束的日志
});

// #7 设置Controller执行之后
$http_app->setControllerPostHandler(function (\org\tessag\http\IRequest $request,
                                              \org\tessag\http\IResponse $response,
                                              \org\tessag\http\IResponseMessage $responseMessage) {
//                                               $responseMessage) {
});

// #8 设置Controller的异常handler
$http_app->setControllerExceptionHandler(function (\org\tessag\http\IRequest $request,
                                                   \org\tessag\http\IResponse $response, \Exception $ex) {
    if(!($ex instanceof \org\tessag\exception\TessagException)){
        return false;
    }
    $body = array(
        'status' => method_exists($ex, 'getErrorNo') ? $ex->getErrorNo() : $ex->getCode(),
        'message' => $ex->getMessage(),
        'data' => array()
    );
    if(DEBUG){
            $trace_ar = explode("#", $ex->getTraceAsString());
            unset($trace_ar[0]);
            $trace_format_arr = array();
            foreach ($trace_ar as $trace) {
                $trace_format_arr[] = '#' . $trace;
            }
            $body['data'] = array(
                'message' => $ex->getMessage(),
                'file' => $ex->getFile(),
                'traceAsString' => $trace_format_arr,
                'trace' => $ex->getTrace(),
            );
            $json_message = new \org\tessag\http\message\JSONMessage($body);

            $response->withBody($json_message->toResponseBody());
        }
    return true;
});

// #9 设置项目异常处理逻辑
$http_app->setExceptionHandler(function (\org\tessag\http\IRequest $request,
                                         \org\tessag\http\IResponse $response, \Exception $ex) {
//     什么也不做，异常原封不动跑出去

});

// #10 执行
$http_app->invoke();