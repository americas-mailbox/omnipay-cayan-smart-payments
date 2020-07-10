<?php

namespace Omnipay\SmartPayments\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * Abstract Request
 *
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    protected $liveEndpoint = 'https://ps1.merchantware.net/smartpayments/transact.asmx/ProcessCreditCard';
    protected $testEndpoint = 'https://api-test.example.com';

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function sendData($data)
    {
        $data['InvNum'] = 'WEB ';
        $url = $this->getEndpoint().'?'.http_build_query($data, '', '&');
        $response = $this->httpClient->request(
            'GET',
            $url
        );
        $body = (string) $response->getBody();

        return $this->createResponse($body);
    }

    protected function getBaseData()
    {
        return [
            'Street'     => '',
            'CardNum'    => '',
            'ExpDate'    => '',
            'NameOnCard' => '',
            'CVNum'      => '',
            'Zip'        => '',
            'ExtData'    => '',
            'MagData'    => '',
            "Password"   => $this->getPassword(),
            'PNRef'      => '',
            "UserName"   => $this->getUsername(),
        ];
    }

    protected function getEndpoint()
    {
        return $this->liveEndpoint;
    }

    protected function createResponse($response)
    {
        $factory = $this->getResponseFactory();

        return $this->response = (new $factory)->handle($this, $response);
    }

    abstract protected function getResponseFactory();
}
