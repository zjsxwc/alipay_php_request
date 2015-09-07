<?php
/**
 * Created by IntelliJ IDEA.
 * User: wangchao
 * Date: 9/7/15
 * Time: 11:57 AM
 */

namespace WatcherHangzhouPayment\Alipay;

use WatcherHangzhouPayment\Params;

class AlipayRequestParams extends Params {

    /**
     * @var string $key
     */
    public $key;

    /**
     * @var string $secret
     */
    public $secret;

    /**
     * @var string $type 'dualfun'|'escow'|'direct'
     */
    public $type = 'direct';


    /**
     * @var string $returnUrl
     */
    public $returnUrl;

    /**
     * @var string $notifyUrl
     */
    public $notifyUrl;

    /**
     * @var string $showUrl
     */
    public $showUrl;

    /**
     * @var string $orderSn
     */
    public $orderSn;

    /**
     * @var string $title
     */
    public $title;

    /**
     * @var string $summary
     */
    public $summary = '';

    /**
     * @var double $amount
     */
    public $amount = 0.00;
}