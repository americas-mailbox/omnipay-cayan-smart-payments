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
        $data['MagData'] = '';
        $data['PNRef'] = '';
        $data['ExtData'] = '';
        $data['InvNum'] = 'WEB ';
        $url = $this->getEndpoint().'?'.http_build_query($data, '', '&');
        $post_string = http_build_query($data, '', '&');
        //        $response = $this->httpClient->post($url);
        // Standard payment gateway transaction
        // Use the CURL library to establish a connection,
        // submit the post, and record the response.
        $request = curl_init($this->getEndpoint().'?'); // initiate curl object
        curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
        curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
        //curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
        $response = curl_exec($request); // execute curl post and store results in $this->response
        curl_close($request); // close curl object

        return $this->createResponse($response);
    }

    protected function getBaseData()
    {
        return [
            "UserName" => $this->getUsername(),
            "Password" => $this->getPassword(),
        ];
    }

    protected function getEndpoint()
    {
        return $this->liveEndpoint;
    }

    protected function createResponse($response)
    {
        $factory = $this->getResponseFactory();

        return $this->response = (new $factory)($this, $response);
    }

    abstract protected function getResponseFactory();
}
