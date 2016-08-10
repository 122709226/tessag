<?php
/**
 * Created by @panyao on 2016/8/10.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
define("ROOT_DIR", __DIR__);            // 定义根目录
define("DEBUG", true);                  // 启动debug模式

if (!file_exists(ROOT_DIR . '/../vendor')) {
    exit('run "composer install" first' . PHP_EOL);
}
// #1 Autoload 自动载入
require ROOT_DIR . '/../vendor/autoload.php';

\org\tessag\HttpApp::registerNamespacePathV2(ROOT_DIR . '/../tests');