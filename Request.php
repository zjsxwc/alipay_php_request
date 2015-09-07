<?php
/**
 * Created by IntelliJ IDEA.
 * User: wangchao
 * Date: 9/7/15
 * Time: 12:06 PM
 */

namespace WatcherHangzhouPayment;


abstract class Request {
    /**
     * @var Params $params
     */
    protected $params;

    public function __construct(Params $params)
    {
        $this->params = $params;
    }

    public function setParams(Params $params)
    {
        $this->params = $params;
        return $this;
    }

    abstract public function form();

    abstract protected function signParams(array $convertedParams);
}