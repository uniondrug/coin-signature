<?php
/**
 * @author Haven <chenhao@uniondrug.com>
 * @date   2020-11-11
 */
namespace Uniondrug\CoinSignature;

use Phalcon\Di\ServiceProviderInterface;

class SignatureServiceProvider implements ServiceProviderInterface
{
    public function register(\Phalcon\DiInterface $di)
    {
        $di->set('coinSignatureService', function(){
            return new SignatureService();
        });
    }
}

