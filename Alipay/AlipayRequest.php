<?php
/**
 * Created by IntelliJ IDEA.
 * User: wangchao
 * Date: 9/7/15
 * Time: 12:06 PM
 */

namespace WatcherHangzhouPayment\Alipay;

use WatcherHangzhouPayment\Request;

/**
 * Class AlipayRequest
 * @package WatcherHangzhouPayment\Alipay
 * @property AlipayRequestParams $params
 */
class AlipayRequest extends Request {

    protected $url = 'https://mapi.alipay.com/gateway.do';

    /**
     * @return array
     */
    public function form()
    {
        $form = array();
        $form['action'] = $this->url . '?_input_charset=utf-8';
        $form['method'] = 'post';
        $form['params'] = $this->convertParams();
        return $form;
    }

    /**
     * @param array $convertedParams
     * @return string
     */
    protected function signParams(array $convertedParams)
    {
        unset($convertedParams['sign_type']);
        unset($convertedParams['sign']);

        ksort($convertedParams);

        $sign = '';
        foreach ($convertedParams as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $sign .= $key . '=' . $value . '&';
        }
        $sign = substr($sign, 0, - 1);
        $sign .=$this->params->secret;

        return md5($sign);
    }

    protected function convertParams()
    {
        $converted = array();

        if ($this->getPaymentType() == 'dualfun') {
            $converted['service'] = 'trade_create_by_buyer';
        } elseif ($this->getPaymentType() == 'escow') {
            $converted['service'] = 'create_partner_trade_by_buyer';
        } else {
            $converted['service'] = 'create_direct_pay_by_user';
        }

        $converted['partner'] = $this->params->key;
        $converted['payment_type'] = 1;
        $converted['_input_charset'] = 'utf-8';
        $converted['sign_type'] = 'MD5';
        $converted['out_trade_no'] = $this->params->orderSn;
        $converted['subject'] = $this->filterText($this->params->title);
        $converted['seller_id'] = $this->params->key;

        if (in_array($this->getPaymentType(), array('dualfun', 'escow'))) {
            $converted['price'] = $this->params->amount;
            $converted['quantity'] = 1;
            $converted['logistics_type'] = 'POST';
            $converted['logistics_fee'] = '0.00';
            $converted['logistics_payment'] = 'BUYER_PAY';
        } else {
            $converted['total_fee'] = $this->params->amount;
        }

        $converted['notify_url'] = $this->params->notifyUrl;
        $converted['return_url'] = $this->params->returnUrl;
        $converted['show_url'] = $this->params->showUrl;

        $converted['body'] = $this->params->summary;

        $converted['sign'] = $this->signParams($converted);

        return $converted;
    }

    /**
     * @param string $text
     * @return string
     */
    protected function filterText($text)
    {
        return str_replace(array('#', '%', '&', '+'), array('＃', '％', '＆', '＋'), $text);
    }

    /**
     * @return string
     */
    private function getPaymentType()
    {
        return $this->params->type?:'direct';
    }
}