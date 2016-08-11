<?php
/**
 * Created by @panyao on 2016/8/5.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\http;

/**
 * Controller与responseBody消息传递的中间态
 * Interface IResponseMessage
 * @package org\tessag\http
 */
interface IResponseMessage
{

    /**
     * 转换成bodyStream
     * @return mixed
     */
    public function toResponseBody();

    /**
     * 获取消息的contentType
     * @return mixed
     */
    public function getContentType();

//    public function sendRedirect($url);
}