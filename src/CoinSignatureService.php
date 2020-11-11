<?php
/**
 * @author Haven <chenhao@uniondrug.com>
 * @date   2020-11-11
 */
namespace Uniondrug\CoinSignature;

use Uniondrug\Framework\Services\Service;

/**
 * 资金系统接口加密验签生成工具
 * @package Uniondrug\CoinSignature
 */
class CoinSignatureService extends Service
{
    /**
     * 随机数
     */
    protected $nonce = "";
    /**
     * 时间戳
     */
    protected $timestamp = "";

    /**
     * 资金中心-加密验签
     * @param $appid
     * @param $appsecret
     * @param $data
     * @return array|bool
     */
    public function getSignature($appid, $appsecret, $data)
    {
        $result = [];
        $sign = $this->createSign([
            "appid" => $appid,
            "appsecret" => $appsecret,
            "timestamp" => $this->timestamp = time(),
            "nonce" => $this->nonce = rand(10000000, 99999999),
            "data" => json_encode($data)
        ]);
        if ($sign) {
            $result['appid'] = $appid;
            $result['nonce'] = $this->nonce;
            $result['timestamp'] = $this->timestamp;
            $result['sign'] = $sign;
        }
        return $result ? $result : false;
    }

    /**
     * 生成签名
     * @param array  $arrayData 签名数组
     * @param string $method    签名方法
     * @return boolean|string 签名值
     */
    private function createSign($arrayData, $method = "sha256")
    {
        ksort($arrayData);
        $str = "";
        foreach ($arrayData as $key => $value) {
            if (strlen($str) == 0) {
                $str .= $key."=".$value;
            } else {
                $str .= "&".$key."=".$value;
            }
        }
        return hash($method, strtolower($str));
    }
}

