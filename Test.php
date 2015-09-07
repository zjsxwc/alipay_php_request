<?php
/**
 * Created by IntelliJ IDEA.
 * User: wangchao
 * Date: 9/7/15
 * Time: 1:35 PM
 */

namespace WatcherHangzhouPayment;


class Test {
    public function testAliPayRequest()
    {
        $params = new Alipay\AlipayRequestParams();
        $params->key = 'xxx';
        $params->secret = 'xxx';
        $params->type = 'direct';

        $params->orderSn = 'alipay_sn_dsfwe24sde24rfwesf43fe';
        $params->title = 'title';
        $params->summary = '';
        $params->amount = 0.01;//'[amount_for_goods_id]' im going to charge


        $params->returnUrl = 'https://mydomain/paycenter/return/alipay'; // after user pays, alipay redirect user broswer to
        $params->notifyUrl = 'https://mydomain/paycenter/notify/alipay';//after user pays, alipay server notify my server
        $params->showUrl = 'https://mydomain/goods/[goods_id]'; //my link for the goods to display


        $request = Payment::createRequest('Alipay', $params);
        $htmlForm = $request->form();

        $inputHtml = '';
        foreach ($htmlForm['params'] as $key => $value) {
            $inputHtml .= "<input type=\"hidden\" name=\"{$key}\" value=\"{$value}\">";
        }
        $html = <<<EOF
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Jumping to alipay gateway...</title>
<body>

  <form action="{$htmlForm['action']}"  method="{$htmlForm['method']}" name="form">
    {$inputHtml}
  </form>

  <script>
    document.all.form.submit();
  </script>

</body>
</html>
EOF;

        echo $html;
        die;
    }
}
