# 说明：
    不支持Apache多线程模式运行

# 执行过程：
    具体代码见：samples/index.php

    1. 根据预先设定好的router获取app实例

    2. app Controller处理：setControllerPreHandler, setControllerPostHandler。
        异常处理：setControllerExceptionHandler,setExceptionHandler。

    3. invoke开始执行，先根据设定的路由获取执行的Controller的class path、method

    4. controller invoke开始执行Controller相关的逻辑

        4.1 绑定Controller执行的过程handle。这里特别说明一下，controller 运行得到IResponseMessage之后，没有立即把主动权
        交托给response,而且把获取到message yield 丢给下一个handler，即：ControllerPostHandler,这里拿到message可以
        做一些预处理。

        4.2 执行handler list（代码在HttpApp.php 230行上下）
            首先执行 preHandle 如果设置了的话。特别说明：handler return false，会终止整个流程，但是不会抛出异常。
            yield false，则会直接抛出 ErrorException的错误！
            得益于协程的运行模式，我们可以很好的让代码变得更直观，例如，记录运行时间,我们可以在preHandle这样：
                setControllerPreHandler(function($request, $response){
                    $start_time = microtime(true);
                    yield true;
                    $response->withHeader("X-Run-Time", (microtime(true) - $start_time) * 1000);
                });

    5. controller 执行完毕之后，直接调用HttpApp->sent()向前端输出结果。

    6. 最后，异常处理。异常通常是一个头疼的问题。

        6.1 Controller 异常会调用 setControllerExceptionHandler() 设置的异常handle。如果异常返回true，则会被认为这个异常
        是一个消息异常。注意：Controller只会捕捉TessagException这个系统异常。

        6.2 Controller没能捕捉到或者无法处理的异常，会被抛到setExceptionHandler() 设置的异常handle来进行处理。

# 运行：
    clone 执行运行命令：
        php composer.phar install
        如果安装了composer，执行 composer install

    Apache conf （去掉#号）：
        #LoadModule rewrite_module modules/mod_rewrite.so
        #LoadModule vhost_alias_module modules/mod_vhost_alias.so
        #Include conf/extra/httpd-vhosts.conf


        listen:
            Listen 0.0.0.0:80
            Listen [::0]:80

        vhosts:
            <VirtualHost *:80>
                ServerAdmin localhost
                DocumentRoot "E:/Cloud/a2_working/workspace/a5_condingnet/tessag/"
                ServerName localhost
                ErrorLog "logs/localhost.org-error.log"
                CustomLog "logs/localhost.org-access.log" common
                <Directory "E:/Cloud/a2_working/workspace/a5_condingnet/tessag/">
                    Options Indexes FollowSymLinks
                    AllowOverride all
                    Require all granted
                </Directory>
            </VirtualHost>

#apache容器
    .htaccess 文件下已经配置好优雅链接