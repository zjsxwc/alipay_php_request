<?php
/**
 * Created by IntelliJ IDEA.
 * User: wangchao
 * Date: 9/7/15
 * Time: 11:51 AM
 */

namespace WatcherHangzhouPayment;


class Payment {

    /**
     * @param string $name
     * @param Params $params
     * @return Request
     * @throws \Exception
     */
    public static function createRequest($name, Params $params)
    {
        $name = ucfirst(strtolower($name));
        $class = __NAMESPACE__ . "\\{$name}\\{$name}Request";

        if (!class_exists($class)) {
            throw new \Exception("Payment request {$name} is not exist!");
        }
        return new $class($params);
    }

    public static function createCloseTradeRequest($name, $options = array())
    {
        $name = ucfirst(strtolower($name));
        $class = __NAMESPACE__ . "\\{$name}\\{$name}CloseTradeRequest";

        if (!class_exists($class)) {
            throw new \Exception("Payment close trade request {$name} is not exist!");
        }
        return new $class($options);
    }

    public static function createResponse($name, $options = array())
    {
        $name = ucfirst(strtolower($name));
        $class = __NAMESPACE__ . "\\{$name}\\{$name}Response";

        if (!class_exists($class)) {
            throw new \Exception("Payment response {$name} is not exist!");
        }
        return new $class($options);
    }
}