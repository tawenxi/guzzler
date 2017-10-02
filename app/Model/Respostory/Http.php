<?php

namespace App\Model\Respostory;

use GuzzleHttp\Client;

/**
 * TODO:
 * - 发送sql语句.
 *
 * @接收sql语句
 * @返回sql response
 */
class Http
{
    public $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function makerequest($dq)//根据body属性发送请求
    {
        $client = new Client();
        $response = $client->request('POST', 'http://10.108.8.1:7007/Proxy',
        [
            'form_params' => [
                    'cVer' => '9.8.0',
                    'dp'=>$dq,
                ],
        ]);
        $code = $response->getStatusCode(); // 200
        $responsebody = $response->getBody();
        $responsebody = iconv('GBK', 'UTF-8', $responsebody);
        /*=============================================
        =            判断Response中是否包含错误信息          =
        =============================================*/
        if (stristr($responsebody, 'ERROR') || stristr($responsebody, '错误')) {
            echo iconv('GB2312', 'UTF-8', $dq);
            throw new \Exception("sql语句错误----$responsebody".__LINE__, 1);
        }
        /*=====  End of  判断Response中是否包含错误信息 ======*/
        return $responsebody;
    }
}
