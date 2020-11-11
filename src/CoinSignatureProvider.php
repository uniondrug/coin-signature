<?php
/**
 * @author Haven <chenhao@uniondrug.com>
 * @date   2020-11-11
 */
namespace Uniondrug\CoinSignature;

use Phalcon\Di\ServiceProviderInterface;

class CoinSignatureProvider implements ServiceProviderInterface
{
    public function register(\Phalcon\DiInterface $di)
    {
        $di->setShared('coinSignature', function(){
            return new CoinSignature();
        });
    }
}

